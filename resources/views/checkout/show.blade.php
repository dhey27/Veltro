@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">🧾 Checkout</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada kesalahan input:<br>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(count($cartItems))
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                            <td><strong>Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- ✅ Formulir Checkout --}}
            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', auth()->user()->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" class="form-control" required>{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>

                <button type="submit" class="btn btn-success">🛒 Lanjutkan Pesanan</button>
            </form>
        @else
            <div class="alert alert-info">
                Keranjang Anda kosong. <a href="{{ route('products.index') }}">Lihat Produk</a>
            </div>
        @endif
    </div>
@endsection