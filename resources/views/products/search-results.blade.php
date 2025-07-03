@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- 🔥 Judul Halaman --}}
        <h2 class="mb-4">🔥 Produk Terlaris</h2>

        {{-- 📦 Daftar Produk --}}
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        {{-- ✅ Gambar Produk --}}
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/no-image.png') }}"
                                class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">
                        </a>

                        {{-- ✅ Informasi Produk --}}
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title mb-1">
                                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <p class="text-muted mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p><small>Ukuran: {{ $product->size ?? '-' }}</small></p>

                            {{-- ✅ Status Stok --}}
                            @if($product->stock <= 0)
                                <span class="badge bg-danger mb-2">Stok Habis</span>
                            @else
                                <p class="mb-2">Stok: {{ $product->stock }}</p>

                                {{-- ✅ Tombol Tambah ke Keranjang --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="GET" class="mt-auto">
                                    @csrf
                                    <button class="btn btn-sm btn-primary w-100">+ Tambah ke Keranjang</button>
                                </form>
                            @endif

                            {{-- ✅ Tombol Detail --}}
                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-sm btn-outline-secondary w-100 mt-2">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada produk terlaris saat ini.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- 🔙 Tombol Kembali --}}
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                ← Kembali ke Semua Produk
            </a>
        </div>
    </div>
@endsection