@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
    <div class="container-sm px-4">
        <h2 class="mb-4 text-center">📤 Upload Bukti Pembayaran</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Nomor Pesanan:</strong> #{{ $order->id }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                @if ($order->payment_proof)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bukti yang sudah diupload:</label>
                        <br>
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank"
                            class="btn btn-sm btn-outline-secondary">
                            Lihat Bukti
                        </a>
                    </div>
                @endif

                <form action="{{ route('payment.upload.submit', $order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Upload Bukti Transfer (JPG, PNG, PDF)</label>
                        <input type="file" class="form-control @error('payment_proof') is-invalid @enderror"
                            id="payment_proof" name="payment_proof" required>

                        @error('payment_proof')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Upload Bukti</button>
                </form>
            </div>
        </div>
    </div>
@endsection