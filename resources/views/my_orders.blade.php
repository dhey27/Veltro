@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Riwayat Pesanan Saya</h2>

        @if($orders->count())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Item</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach($order->items as $item)
                                            <li>{{ $item->product_name }} (x{{ $item->quantity }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if($order->payment_proof)
                                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank"
                                            class="btn btn-sm btn-primary">Lihat</a>
                                    @else
                                        <span class="text-danger">Belum ada</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Belum ada pesanan.</p>
        @endif
    </div>
@endsection