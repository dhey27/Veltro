@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">🧾 Riwayat Pesanan Saya</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- Cek jika tidak ada pesanan --}}
    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            Anda belum memiliki pesanan.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Bukti Transfer</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $colors = [
                                        'pending' => 'secondary',
                                        'dibayar' => 'info',
                                        'dikirim' => 'warning',
                                        'selesai' => 'success',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $colors[$order->status] ?? 'secondary' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($order->payment_proof)
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank"
                                       class="btn btn-sm btn-success">Lihat</a>
                                @else
                                    <span class="text-danger">Belum diunggah</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($order->status === 'pending' && !$order->payment_proof)
                                    <a href="{{ route('payment.upload.form', $order->id) }}"
                                       class="btn btn-sm btn-warning">Upload Bukti</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
