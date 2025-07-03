@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- ✅ Tampilkan pesan error jika ada --}}
        @if(session('error'))
            <div class="alert alert-warning text-center">
                {{ session('error') }}
            </div>
        @endif

        {{-- ✅ Judul Halaman --}}
        <h1 class="mb-4">Koleksi Sepatu Veltro</h1>

        {{-- 🔍 Form Filter Ukuran & Harga --}}
        <form method="GET" action="{{ route('products.index') }}" class="row g-3 mb-4">
            {{-- Ukuran --}}
            <div class="col-md-3">
                <select name="size" class="form-select">
                    <option value="">-- Pilih Ukuran --</option>
                    @foreach(range(36, 46) as $size)
                        <option value="{{ $size }}" {{ request('size') == $size ? 'selected' : '' }}>
                            Ukuran {{ $size }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Harga Minimum --}}
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="Min Harga"
                    value="{{ request('min_price') }}">
            </div>

            {{-- Harga Maksimum --}}
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="Max Harga"
                    value="{{ request('max_price') }}">
            </div>

            {{-- Tombol Filter --}}
            <div class="col-md-3">
                <button type="submit" class="btn btn-outline-primary">Filter</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        {{-- ✅ Daftar Produk --}}
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
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">
                                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                                    {{ $product->name }}
                                </a>
                            </h5>

                            <p class="text-muted mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="mb-2"><small>Ukuran: {{ $product->size ?? '-' }}</small></p>

                            {{-- ✅ Status Stok --}}
                            @if ($product->stock <= 0)
                                <span class="badge bg-danger mb-2">Stok Habis</span>
                            @else
                                <p class="card-text mb-2">Stok: {{ $product->stock }}</p>

                                {{-- ✅ Tombol Tambah ke Keranjang --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="GET">
                                    @csrf
                                    <button class="btn btn-sm btn-primary w-100">+ Tambah ke Keranjang</button>
                                </form>
                            @endif

                            {{-- ✅ Tombol Lihat Detail --}}
                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-sm btn-outline-secondary w-100 mt-2">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                {{-- ❗ Jika Tidak Ada Produk --}}
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada produk tersedia saat ini.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- ✅ Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
@endsection