<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $fillable = [
        'nama_merek',
        'logo',
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'merek_id');
    }
}
