<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'tanggal',
        'produk_id',
        'nama_produk',
        'jenis_produk',
        'warna_produk',
        'jumlah_pembelian',
        'harga_satuan',
        'total_harga',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
