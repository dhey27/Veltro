@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">📊 Dashboard Admin</h2>

        <div class="row g-4">
            {{-- 📦 Total Produk --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Produk</h6>
                        <h3 class="fw-bold">{{ $totalProducts }}</h3>
                    </div>
                </div>
            </div>

            {{-- ❌ Stok Habis --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <h6 class="text-danger">Stok Habis</h6>
                        <h3 class="fw-bold text-danger">{{ $outOfStock }}</h3>
                    </div>
                </div>
            </div>

            {{-- 🧾 Total Pesanan --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Pesanan</h6>
                        <h3 class="fw-bold">{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>

            {{-- 💸 Belum Dibayar --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <h6 class="text-warning">Belum Dibayar</h6>
                        <h3 class="fw-bold text-warning">{{ $unpaidOrders }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card border-info">
                    <div class="card-body">
                        <h5 class="text-center">Status Pesanan</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">Pending
                                <span>{{ $statusCounts['pending'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">Dibayar
                                <span>{{ $statusCounts['dibayar'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">Dikirim
                                <span>{{ $statusCounts['dikirim'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">Selesai
                                <span>{{ $statusCounts['selesai'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- 💰 Total Revenue --}}
            <div class="col-md-6">
                <div class="card border-success text-center">
                    <div class="card-body">
                        <h5 class="text-success">Total Pendapatan</h5>
                        <h3 class="fw-bold text-success">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🔗 Link ke Daftar Pesanan --}}
        <div class="mt-4 text-center">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary">
                📄 Lihat Semua Pesanan
            </a>
        </div>
    </div>
@endsection