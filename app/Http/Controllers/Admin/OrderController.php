<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * ✅ Menampilkan semua pesanan dengan filter pencarian dan status
     */
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'items'])->latest();

        // 🔍 Filter berdasarkan nama pemesan
        if ($request->filled('search')) {
            $orders->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // 📋 Filter berdasarkan status pesanan
        if ($request->filled('status')) {
            $orders->where('status', $request->status);
        }

        // 📄 Pagination dan query string tetap
        $orders = $orders->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * ✅ Menampilkan detail pesanan
     */
    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * ✅ Mengubah status pesanan secara manual oleh admin
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,dibayar,dikirim,selesai',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * ✅ Menyetujui bukti transfer (ubah status ke "dibayar")
     */
    public function approvePayment(Order $order)
    {
        if (!$order->payment_proof) {
            return back()->with('error', 'Bukti transfer belum diunggah.');
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan ini tidak bisa disetujui karena statusnya bukan "pending".');
        }

        $order->update([
            'status' => 'dibayar',
        ]);

        return back()->with('success', 'Pembayaran disetujui. Status pesanan diubah menjadi "dibayar".');
    }

    /**
     * ❌ Menolak bukti transfer (hapus bukti dan kosongkan kolom)
     */
    public function rejectPayment(Order $order)
    {
        if (!$order->payment_proof) {
            return back()->with('error', 'Tidak ada bukti transfer untuk ditolak.');
        }

        // Hapus file bukti transfer dari storage
        Storage::delete('public/' . $order->payment_proof);

        // Kosongkan kolom bukti transfer tanpa mengubah status
        $order->update([
            'payment_proof' => null,
        ]);

        return back()->with('success', 'Bukti transfer berhasil ditolak dan dihapus.');
    }

    /**
     * 🗑️ Menghapus pesanan beserta item-itemnya
     */
    public function destroy(Order $order)
    {
        // Hapus item-item terkait (relasi foreign key)
        $order->items()->delete();

        // Hapus file bukti transfer jika ada
        if ($order->payment_proof) {
            Storage::delete('public/' . $order->payment_proof);
        }

        // Hapus pesanan utama
        $order->delete();

        return back()->with('success', 'Pesanan berhasil dihapus.');
    }



}
