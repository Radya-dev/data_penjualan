@extends('layouts.master')
@section('title','Dashboard')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Penjualan</p>
                        <h5 class="font-weight-bolder mb-0">
                            {{ $totalPenjualan }}
                        </h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; line-height: 50px;">
                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Produk</p>
                        <h5 class="font-weight-bolder mb-0">
                            {{ $totalProduk }}
                        </h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle" style="width: 50px; height: 50px; line-height: 50px;">
                        <i class="ni ni-box-2 text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Merek</p>
                        <h5 class="font-weight-bolder mb-0">
                            {{ $totalMerek }}
                        </h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle" style="width: 50px; height: 50px; line-height: 50px;">
                        <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pemasukan</p>
                        <h5 class="font-weight-bolder mb-0">
                            Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                        </h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle" style="width: 50px; height: 50px; line-height: 50px;">
                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Penjualan Terakhir</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Produk</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Pembelian</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualanTerbaru as $penjualan)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $penjualan->tanggal }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $penjualan->produk->merek->nama_merek ?? 'Tidak ada merek' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $penjualan->jumlah_pembelian }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
