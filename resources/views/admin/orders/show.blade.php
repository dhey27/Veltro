@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-center">📄 Detail Pesanan #{{ $order->id }}</h2>

        {{-- Informasi Pemesan --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Informasi Pemesan</div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                <p><strong>Status:</strong>
                    <span class="badge bg-secondary text-capitalize">
                        {{ $order->status }}
                    </span>
                </p>
            </div>
        </div>

        {{-- Item Pesanan --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Item Pesanan</div>
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="table-light fw-bold">
                            <td colspan="3">Total Harga</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bukti Transfer --}}
        @if ($order->payment_proof)
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">Bukti Transfer</div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Transfer" class="img-fluid mb-3"
                        style="max-width: 400px;">
                    <div>
                        {{-- Tombol Approve --}}
                        <form action="{{ route('admin.orders.approve.payment', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success" onclick="return confirm('Setujui pembayaran ini?')">✔
                                Setujui</button>
                        </form>

                        {{-- Tombol Reject --}}
                        <form action="{{ route('admin.orders.reject.payment', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger" onclick="return confirm('Tolak bukti pembayaran ini?')">✖
                                Tolak</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> Belum ada bukti transfer yang diunggah.
            </div>
        @endif

        {{-- Ubah Status Manual --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Ubah Status Pesanan</div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update.status', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="dibayar" {{ $order->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary">💾 Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">⬅ Kembali ke Daftar Pesanan</a>
    </div>
@endsection