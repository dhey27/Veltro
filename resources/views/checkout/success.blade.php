@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="mb-4 text-success">✅ Checkout Berhasil!</h2>

        <p class="lead">Terima kasih telah memesan di <strong>Veltro</strong>.</p>
        <p class="lead">ID Pesanan Anda: <strong>#{{ $order->id }}</strong></p>

        {{-- 💰 Info Pembayaran --}}
        <div class="alert alert-info mx-auto mt-4" style="max-width: 450px;">
            <h5 class="mb-3">Silakan transfer ke rekening berikut:</h5>
            <p><strong>Bank:</strong> BCA Virtual Account</p>
            <p><strong>No. Rekening:</strong> 1234567890</p>
            <p><strong>Atas Nama:</strong>Veltro Indonesia</p>
            <hr>
            <p><strong>Total yang harus dibayar:</strong></p>
            <h4 class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h4>
        </div>

        {{-- 📦 Detail Pemesan --}}
        <div class="card mt-4 shadow-sm mx-auto text-start" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title mb-3">🧾 Informasi Pemesan</h5>
                <p><strong>Nama:</strong> {{ $order->name }}</p>
                <p><strong>Alamat:</strong> {{ $order->address }}</p>
                <p><strong>Telepon:</strong> {{ $order->phone }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            </div>
        </div>

        {{-- 📤 Tombol Upload Bukti --}}
        <a href="{{ route('payment.upload.form', $order->id) }}" class="btn btn-warning mt-4">
            📤 Upload Bukti Transfer
        </a>

        {{-- 📄 Link Riwayat & 🔙 Belanja Lagi --}}
        <div class="mt-4 d-flex justify-content-center gap-2 flex-wrap">
            <a href="{{ route('order.history') }}" class="btn btn-primary">
                📄 Lihat Riwayat Pesanan
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                🔙 Kembali Belanja
            </a>
        </div>
    </div>
@endsection