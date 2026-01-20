@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Penjualan</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $penjualan->tanggal) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="produk_id">Nama Produk</label>
                                    <select name="produk_id" id="produk_id" class="form-control" required>
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->id }}" {{ old('produk_id', $penjualan->produk_id) == $produk->id ? 'selected' : '' }}>
                                                {{ $produk->merek->nama_merek ?? 'Tidak ada merek' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jenis_produk">Jenis Produk</label>
                                    <input type="text" name="jenis_produk" id="jenis_produk" class="form-control" value="{{ old('jenis_produk', $penjualan->jenis_produk) }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="warna_produk">Warna Produk</label>
                                    <input type="text" name="warna_produk" id="warna_produk" class="form-control" value="{{ old('warna_produk', $penjualan->warna_produk) }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jumlah_pembelian">Jumlah Pembelian</label>
                                    <input type="number" name="jumlah_pembelian" id="jumlah_pembelian" class="form-control" min="1" value="{{ old('jumlah_pembelian', $penjualan->jumlah_pembelian) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="harga_satuan">Harga Satuan</label>
                                    <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" min="0" value="{{ old('harga_satuan', $penjualan->harga_satuan) }}" readonly>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
    </section>
</div>
@endsection
