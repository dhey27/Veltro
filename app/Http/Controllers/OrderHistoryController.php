<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    // ✅ User harus login untuk melihat riwayatnya
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ✅ Menampilkan semua pesanan milik user saat ini
    public function index()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->get();

        return view('orders.history', compact('orders'));
    }
}
