@extends('layouts.master')
@section('title', 'Tambah Data Penjualan')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Tambah Data Penjualan</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('penjualan.store') }}" method="POST" id="penjualanForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="produk_id" class="form-label">Produk</label>
                                    <select name="produk_id" id="produk_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih Produk</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->merek->nama_merek }} - {{ $produk->jenis }} - {{ $produk->warna }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_pembelian" class="form-label">Jumlah Pembelian</label>
                                    <input type="number" name="jumlah_pembelian" id="jumlah_pembelian" class="form-control" min="1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="text" name="total_harga" id="total_harga" class="form-control" readonly>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const produkSelect = document.getElementById('produk_id');
    const jumlahInput = document.getElementById('jumlah_pembelian');
    const totalHargaInput = document.getElementById('total_harga');

    function updateTotalHarga() {
        const selectedOption = produkSelect.options[produkSelect.selectedIndex];
        const hargaSatuan = selectedOption ? parseFloat(selectedOption.getAttribute('data-harga')) : 0;
        const jumlah = parseInt(jumlahInput.value) || 0;
        const total = hargaSatuan * jumlah;
        totalHargaInput.value = total ? total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) : '';
    }

    produkSelect.addEventListener('change', updateTotalHarga);
    jumlahInput.addEventListener('input', updateTotalHarga);
});
</script>
@endsection
