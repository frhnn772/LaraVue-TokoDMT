<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produk';
    protected $table = 'produk';
    protected $fillable = ['id_produk','produk','deskripsi','harga','kategori'];

}
