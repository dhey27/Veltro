<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class UserOrderController extends Controller
{
    /**
     * Menampilkan semua pesanan milik user yang sedang login.
     */
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        // ✅ Arahkan ke view yang benar
        return view('user.orders.index', compact('orders'));
    }
}
