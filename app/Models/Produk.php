<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'gambar',
        'merek_id',
        'jenis',
        'warna',
        'stok',
        'harga',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'produk_id');
    }

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'merek_id');
    }
}
