@extends('layouts.app')

@section('title', 'Riwayat Semua Pesanan')

@section('content')
    <div class="container-sm px-4">
        <h2 class="mb-4 text-center">📜 Riwayat Semua Pesanan</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada data pesanan.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle shadow-sm">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nama User</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Bukti Transfer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-center">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    @if ($order->status === 'pending')
                                        <span class="badge bg-warning text-dark">Belum Dibayar</span>
                                    @elseif ($order->status === 'dibayar')
                                        <span class="badge bg-info text-dark">Dibayar</span>
                                    @elseif ($order->status === 'dikirim')
                                        <span class="badge bg-primary">Dikirim</span>
                                    @elseif ($order->status === 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->payment_proof)
                                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank"
                                            class="btn btn-sm btn-outline-secondary">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">Belum Upload</span>
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