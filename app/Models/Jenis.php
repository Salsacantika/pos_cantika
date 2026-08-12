<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';
    protected $fillable = ['user_id', 'nama_jenis'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Ubah dari Jenis::class menjadi Produk::class
    public function produk()
    {
        return $this->hasMany(Produk::class, 'jenis_id');
    }
}