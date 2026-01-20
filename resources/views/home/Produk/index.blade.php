@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Data Produk</h3>
                            <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Merek</th>
                                        <th>Jenis</th>
                                        <th>Warna</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produks as $produk)
                                    <tr>
                                        <td>
                                            @if($produk->gambar)
                                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" style="width: 60px; height: auto;">
                                            @else
                                            <span>Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ $produk->merek->nama_merek }}</td>
                                        <td>{{ $produk->jenis }}</td>
                                        <td>{{ $produk->warna }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td>{{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline-block;">
                                                 @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if($produks->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Data produk tidak tersedia.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </section> 
</div>
@endsection
