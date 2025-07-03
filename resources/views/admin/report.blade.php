@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">📈 Laporan Penjualan Harian</h2>

        @if($report->count())
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow-sm">
                    <thead class="table-dark text-center">
                        <tr>
                            <th style="width: 25%">Tanggal</th>
                            <th style="width: 25%">Jumlah Pesanan</th>
                            <th style="width: 50%">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report as $row)
                            <tr class="text-center">
                                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                                <td>{{ $row->jumlah_pesanan }}</td>
                                <td class="text-success fw-semibold">
                                    Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                Belum ada data laporan untuk ditampilkan.
            </div>
        @endif
    </div>
@endsection