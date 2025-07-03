<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $cart = session('cart', []);
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('checkout.show', [
            'cartItems' => $cart,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:10|max:500',
            'phone' => 'required|string|regex:/^[0-9+\-\s]+$/|min:8|max:20',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.regex' => 'Format nomor telepon tidak valid.',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        DB::beginTransaction();

        try {
            foreach ($cart as $item) {
                $productId = $item['product_id'] ?? null; // ✅ Gunakan product_id dengan aman
                $product = Product::find($productId);

                if (!$product) {
                    return redirect()->route('cart.index')->with('error', "Produk tidak ditemukan.");
                }

                if ($item['quantity'] > $product->stock) {
                    return redirect()->route('cart.index')->with('error', "Stok produk '{$product->name}' tidak mencukupi. Tersedia: {$product->stock}");
                }
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'status' => 'pending',
                'total_price' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            ]);

            foreach ($cart as $item) {
                $productId = $item['product_id'] ?? null;
                $product = Product::find($productId);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'quantity' => $item['quantity'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            session()->forget('cart');
            DB::commit();

            return redirect()->route('checkout.success', $order->id)->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('myorders.index')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        return view('checkout.success', compact('order'));
    }

    public function uploadForm(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('myorders.index')->with('error', 'Akses ditolak.');
        }

        return view('checkout.upload', compact('order'));
    }

    public function uploadSubmit(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('myorders.index')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('myorders.index')->with('error', 'Bukti hanya dapat diunggah jika status masih "pending".');
        }

        $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'payment_proof.required' => 'File bukti transfer wajib diunggah.',
            'payment_proof.mimes' => 'Format file harus JPG, PNG, atau PDF.',
            'payment_proof.max' => 'Ukuran file maksimal 2MB.',
        ]);

        if ($request->hasFile('payment_proof')) {
            if ($order->payment_proof && Storage::disk('public')->exists($order->payment_proof)) {
                Storage::disk('public')->delete($order->payment_proof);
            }

            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $order->update(['payment_proof' => $path]);
        }

        return redirect()->route('myorders.index')->with('success', 'Bukti transfer berhasil diunggah.');
    }
}
