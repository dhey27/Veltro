@extends('layouts.app')

@section('content')
    {{-- 🖼️ Hero Banner --}}
    <div class="container-fluid px-0 mb-5">
        <div class="position-relative">
            <img src="{{ asset('images/banner.jpg') }}" alt="Banner" class="img-fluid w-100"
                style="max-height: 450px; object-fit: cover;">
            <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
                <h1 class="display-5 fw-bold">Temukan Gaya Terbaikmu</h1>
                <p class="lead">Sepatu Premium | Desain Modern | Harga Terjangkau</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary px-4 py-2">Belanja Sekarang</a>
            </div>
        </div>
    </div>

    {{-- 🆕 Produk Terbaru --}}
    <div class="container">
        <h3 class="mb-4 fw-semibold">🆕 Produk Terbaru</h3>
        <div class="row g-4">
            @forelse($latestProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        {{-- Gambar --}}
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/no-image.png') }}"
                                class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1 fw-semibold">
                                <a href="{{ route('products.show', $product->id) }}" class="text-dark text-decoration-none">
                                    {{ $product->name }}
                                </a>
                            </h6>
                            <p class="text-muted small mb-1">Ukuran: {{ $product->size ?? '-' }}</p>
                            <p class="fw-bold text-primary mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                            @if($product->stock <= 0)
                                <span class="badge bg-danger mb-2">Stok Habis</span>
                            @else
                                <span class="badge bg-success mb-2">Ready Stock</span>
                                {{-- Tombol --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="GET" class="mt-auto">
                                    <button class="btn btn-sm btn-outline-primary w-100">+ Keranjang</button>
                                </form>
                            @endif

                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-light mt-2 w-100 border">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada produk tersedia saat ini.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- 🔗 Lihat Semua Produk --}}
        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark px-4 py-2">
                Lihat Semua Produk
            </a>
        </div>
    </div>
@endsection