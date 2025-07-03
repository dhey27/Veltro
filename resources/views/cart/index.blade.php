@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">🛒 Keranjang Belanja</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Ukuran</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php
                                $total = $item['price'] * $item['quantity'];
                                $grandTotal += $total;
                            @endphp
                            <tr>
                                <td class="text-start">
                                    @if($item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}" width="60" class="mb-1 rounded shadow-sm">
                                    @endif
                                    <br>
                                    {{ $item['name'] }}
                                </td>
                                <td>{{ $item['size'] }}</td>
                                <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus produk ini dari keranjang?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-light fw-bold">
                            <td colspan="4" class="text-end">Total</td>
                            <td>Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-end">
                <a href="{{ url('/checkout') }}" class="btn btn-success">Lanjut ke Checkout</a>
            </div>
        @else
            <div class="alert alert-warning text-center mt-4">
                Keranjang masih kosong.
            </div>
        @endif
    </div>
@endsection