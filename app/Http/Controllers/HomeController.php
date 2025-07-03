<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama (home) dengan produk terbaru.
     */
    public function index()
    {
        // ✅ Ambil 8 produk terbaru
        $latestProducts = Product::latest()->take(8)->get();

        // ✅ Kirim data ke view home.blade.php
        return view('home', compact('latestProducts'));
    }
}
