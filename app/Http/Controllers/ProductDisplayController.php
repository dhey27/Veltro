<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductDisplayController extends Controller
{
    // ✅ Tampilkan semua produk (dengan filter dan pagination)
    public function index(Request $request)
    {
        $query = Product::query();

        // ✅ Filter berdasarkan ukuran
        if ($request->filled('size')) {
            $query->where('size', $request->input('size'));
        }

        // ✅ Filter berdasarkan harga minimum
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        // ✅ Filter berdasarkan harga maksimum
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // ✅ Ambil produk terbaru dengan pagination
        $products = $query->latest()->paginate(8);

        return view('products.index', compact('products'));
    }

    // ✅ Tampilkan detail produk + Produk Serupa
    public function show(Product $product)
    {
        // ✅ Ambil produk serupa berdasarkan ukuran yang sama, acak, max 4
        $similarProducts = Product::where('id', '!=', $product->id)
            ->where('size', $product->size)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'similarProducts'));
    }

    // ✅ Pencarian Produk
    public function search(Request $request)
    {
        $query = trim($request->input('q'));

        // ✅ Validasi input kosong
        if (empty($query)) {
            return redirect()->route('products.index')
                ->with('error', '⚠️ Masukkan kata kunci untuk pencarian.');
        }

        // ✅ Pencarian berdasarkan nama produk dengan pagination
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('products.search-results', compact('products', 'query'));
    }

    // ✅ Produk Terlaris berdasarkan jumlah order_items
    public function bestSellers()
    {
        $products = \App\Models\Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->paginate(8); // ✅ gunakan paginate, bukan get atau take

        return view('products.best_sellers', compact('products'));
    }




}
