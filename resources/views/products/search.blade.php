@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Hasil Pencarian untuk: <em>"{{ $keyword }}"</em></h1>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                                style="height: 220px; object-fit: cover;">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="card-text mb-2">Ukuran: {{ $product->size ?? '-' }}</p>

                            @if($product->stock <= 0)
                                <span class="badge bg-danger">Stok Habis</span>
                            @else
                                <p class="card-text">Stok: {{ $product->stock }}</p>
                                <form action="{{ route('cart.add', $product->id) }}" method="GET">
                                    @csrf
                                    <button class="btn btn-sm btn-primary w-100 mt-auto">+ Keranjang</button>
                                </form>
                            @endif

                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-sm btn-outline-secondary w-100 mt-2">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Tidak ditemukan produk dengan kata kunci "<strong>{{ $keyword }}</strong>".
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection