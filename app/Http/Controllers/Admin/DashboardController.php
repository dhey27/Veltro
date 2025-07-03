<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * 📊 Menampilkan dashboard admin dengan statistik produk dan pesanan.
     */
    public function index()
    {
        // Statistik Produk
        $totalProducts = Product::count();
        $outOfStock = Product::where('stock', '<=', 0)->count();

        // Statistik Pesanan
        $totalOrders = Order::count();
        $unpaidOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::whereIn('status', ['dibayar', 'dikirim', 'selesai'])->sum('total_price');

        // Jumlah pesanan berdasarkan status
        $statusCounts = [
            'pending' => Order::where('status', 'pending')->count(),
            'dibayar' => Order::where('status', 'dibayar')->count(),
            'dikirim' => Order::where('status', 'dikirim')->count(),
            'selesai' => Order::where('status', 'selesai')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalProducts',
            'outOfStock',
            'totalOrders',
            'unpaidOrders',
            'totalRevenue',
            'statusCounts'
        ));
    }

    /**
     * 📈 Menampilkan laporan penjualan harian.
     */
    public function report()
    {
        $report = DB::table('orders')
            ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah_pesanan, SUM(total_price) as total_pendapatan')
            ->whereIn('status', ['dibayar', 'dikirim', 'selesai'])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.report', compact('report'));
    }
}
