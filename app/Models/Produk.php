<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'jenis_id', // Gunakan jenis_id
        'foto',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id', 'id');
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }
}