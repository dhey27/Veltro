@csrf

{{-- ✅ Nama Produk --}}
<div class="mb-3">
    <label for="name" class="form-label">Nama Produk</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $product->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- ✅ Harga Produk --}}
<div class="mb-3">
    <label for="price" class="form-label">Harga (Rp)</label>
    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
        value="{{ old('price', $product->price ?? '') }}" required>
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- ✅ Stok Produk (Field Baru yang Ditambahkan) --}}
<div class="mb-3">
    <label for="stock" class="form-label">Stok</label>
    <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror"
        value="{{ old('stock', $product->stock ?? 0) }}" required>
    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- ✅ Ukuran Produk --}}
<div class="mb-3">
    <label for="size" class="form-label">Ukuran</label>
    <input type="text" name="size" id="size" class="form-control @error('size') is-invalid @enderror"
        placeholder="Contoh: 39 / 40 / All Size" value="{{ old('size', $product->size ?? '') }}">
    @error('size')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- ✅ Deskripsi Produk --}}
<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
        rows="4">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- ✅ Gambar Produk --}}
<div class="mb-3">
    <label for="image" class="form-label">Gambar Produk</label>
    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
    <div class="form-text">Format gambar: jpg, png, jpeg. Maks: 2MB.</div>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- ✅ Preview gambar lama (hanya jika edit) --}}
    @if (!empty($product->image))
        <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mt-2 rounded" alt="Gambar Produk">
    @endif
</div>