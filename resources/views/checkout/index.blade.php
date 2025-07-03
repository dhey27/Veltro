@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Checkout</h1>

        {{-- ✅ Notifikasi Error Validasi (Langkah 21.2) --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- ✅ Notifikasi Error dari Session (misalnya keranjang kosong) --}}
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- ✅ FORM CHECKOUT --}}
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            {{-- ✅ Input Nama (dengan old input) --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            {{-- ✅ Input Alamat (dengan old input) --}}
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Lengkap</label>
                <textarea name="address" id="address" class="form-control" required>{{ old('address') }}</textarea>
            </div>

            {{-- ✅ Input No. HP (dengan old input) --}}
            <div class="mb-3">
                <label for="phone" class="form-label">No. Telepon / WA</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Proses Pesanan</button>
        </form>
    </div>
@endsection