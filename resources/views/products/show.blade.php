@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- 🔠 Judul Produk --}}
        <h2 class="mb-4">{{ $product->name }}</h2>

        <div class="row">
            {{-- 🎞️ Carousel Gambar Produk --}}
            <div class="col-md-6 mb-4">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        {{-- ✅ Gambar Utama --}}
                        <div class="carousel-item active">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/no-image.png') }}"
                                class="d-block w-100 rounded shadow-sm" alt="{{ $product->name }}"
                                style="height: 400px; object-fit: cover;">
                        </div>

                        {{-- 🔁 Tambahkan gambar tambahan di sini jika diperlukan --}}
                        {{-- <div class="carousel-item">
                            <img src="{{ asset('storage/images/sample.jpg') }}" class="d-block w-100" alt="...">
                        </div> --}}
                    </div>

                    {{-- Navigasi Carousel --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            {{-- 🛍️ Detail Produk --}}
            <div class="col-md-6">
                <h4 class="fw-bold">{{ $product->name }}</h4>
                <p class="text-muted">Ukuran: {{ $product->size ?? '-' }}</p>
                <p class="fs-5">Harga: <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>

                {{-- 📦 Stok --}}
                @if ($product->stock > 0)
                    <p>Stok tersedia: <strong>{{ $product->stock }}</strong></p>
                @else
                    <span class="badge bg-danger mb-3">Stok Habis</span>
                @endif

                {{-- 📝 Deskripsi --}}
                <div class="mt-3">
                    <h5>Deskripsi:</h5>
                    <p>{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>

                {{-- 🛒 Tambah ke Keranjang --}}
                @if ($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="GET" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">
                            + Tambah ke Keranjang
                        </button>
                    </form>
                @endif

                {{-- 🔙 Tombol Kembali --}}
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-4 w-100">
                    ← Kembali ke Halaman Sebelumnya
                </a>
            </div>
        </div>

        {{-- 🔄 Produk Serupa --}}
        @if($similarProducts->count() > 0)
            <div class="mt-5">
                <h4 class="mb-3">👟 Produk Serupa (Ukuran {{ $product->size }})</h4>
                <div class="row">
                    @foreach($similarProducts as $item)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <a href="{{ route('products.show', $item->id) }}">
                                    <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('storage/no-image.png') }}"
                                        class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $item->name }}">
                                </a>
                                <div class="card-body text-center">
                                    <h6 class="card-title mb-1">
                                        <a href="{{ route('products.show', $item->id) }}" class="text-dark text-decoration-none">
                                            {{ $item->name }}
                                        </a>
                                    </h6>
                                    <p class="text-muted mb-1">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('products.show', $item->id) }}" class="btn btn-sm btn-outline-secondary mt-2">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection