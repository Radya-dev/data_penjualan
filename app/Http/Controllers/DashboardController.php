<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Merek;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenjualan = Penjualan::count();
        $totalProduk = Produk::count();
        $totalMerek = Merek::count();

        $totalPemasukan = Penjualan::sum('total_harga');

        $penjualanTerbaru = Penjualan::with('produk.merek')
            ->orderBy('tanggal', 'desc')
            ->limit(10)
            ->get();

        return view('home.dashboard', compact(
            'totalPenjualan',
            'totalProduk',
            'totalMerek',
            'totalPemasukan',
            'penjualanTerbaru'
        ));
    }
}
