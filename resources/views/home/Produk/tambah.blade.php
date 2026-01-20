@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Tambah Data Produk</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="merek_id" class="form-label">Merek</label>
                                    <select name="merek_id" id="merek_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih Merek</option>
                                        @foreach($mereks as $merek)
                                            <option value="{{ $merek->id }}">{{ $merek->nama_merek }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis</label>
                                    <input type="text" name="jenis" id="jenis" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="warna" class="form-label">Warna</label>
                                    <input type="text" name="warna" id="warna" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" name="stok" id="stok" class="form-control" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control" min="0" step="0.01" required>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
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
