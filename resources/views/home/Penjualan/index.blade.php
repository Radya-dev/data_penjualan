@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Data Penjualan</h3>
                            <div>
                                <a href="{{ route('penjualan.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </a>
                               
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0 text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Produk</th>
                                            <th>Jenis Produk</th>
                                            <th>Warna Produk</th>
                                            <th>Jumlah Pembelian</th>
                                            <th>Harga Satuan</th>
                                            <th>Total Harga</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($penjualans as $penjualan)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ $penjualan->produk ? $penjualan->produk->merek->nama_merek : $penjualan->nama_produk }}</td>
                                            <td>{{ $penjualan->produk ? $penjualan->produk->jenis : $penjualan->jenis_produk }}</td>
                                            <td>{{ $penjualan->produk ? $penjualan->produk->warna : $penjualan->warna_produk }}</td>
                                            <td>{{ $penjualan->jumlah_pembelian }}</td>
                                            <td>Rp {{ number_format($penjualan->harga_satuan, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('penjualan.laporan') }}" target="_blank" class="btn btn-success btn-sm ms-2">
                                                    <i class="fas fa-print"></i> Cetak Laporan
                                                </a>
                                                <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Data penjualan tidak tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if(method_exists($penjualans, 'links'))
                        <div class="card-footer">
                            {{ $penjualans->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
