@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">📦 Detail Produk</h2>

        <div class="card shadow-sm">
            <div class="row g-0">
                <div class="col-md-4 text-center p-3">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded"
                            alt="{{ $product->name }}">
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <p class="card-text"><strong>Stok:</strong> {{ $product->stock }}</p>
                        <p class="card-text"><strong>Ukuran:</strong> {{ $product->size }}</p>
                        <p class="card-text"><strong>Deskripsi:</strong><br>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-4">⬅ Kembali</a>
    </div>
@endsection