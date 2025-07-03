@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Produk Sepatu</h1>

        {{-- ✅ Tampilkan pesan error validasi --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Ups!</strong> Ada beberapa kesalahan:<br>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ✅ Form Edit Produk --}}
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ✅ Form reusable --}}
            @include('admin.products.form')

            {{-- ✅ Tombol Submit --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update Produk</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection