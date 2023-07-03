<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pembeli';
    protected $table = 'pembeli';
    protected $fillable = ['id_pembeli','nama_pembeli','id_produk','jumlah_beli'];
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}