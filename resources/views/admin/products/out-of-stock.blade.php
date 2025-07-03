@extends('layouts.admin')

@section('title', 'Produk Stok Habis')

@section('content')
    <div class="container">
        {{-- 🔴 Judul --}}
        <h2 class="mb-4 text-danger">🔴 Daftar Produk yang Stoknya Habis</h2>

        @if($products->isEmpty())
            <div class="alert alert-success text-center">
                Semua produk saat ini memiliki stok.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-danger text-center">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Ukuran</th>
                            <th>Stok</th>
                            <th>Terakhir Diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="text-center">
                                <td style="width: 80px;">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/no-image.png') }}"
                                        alt="{{ $product->name }}" class="img-fluid rounded"
                                        style="height: 60px; object-fit: cover;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->size ?? '-' }}</td>
                                <td><span class="badge bg-danger">Stok Habis</span></td>
                                <td>{{ $product->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                        ✏️ Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- 🔙 Tombol Kembali --}}
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                ← Kembali ke Semua Produk
            </a>
        </div>
    </div>
@endsection