@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Produk Baru</h1>

        {{-- ✅ Menampilkan Pesan Validasi --}}
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

        {{-- ✅ Form Tambah Produk --}}
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            {{-- ✅ Gunakan partial form agar bisa dipakai juga di edit.blade.php --}}
            @include('admin.products.form')

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Simpan Produk</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection