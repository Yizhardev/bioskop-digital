<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;
    protected $table = 'tentang';
    protected $fillable = ['judul_tentang', 'isi_tentang', 'nomor_tentang', 'image_tentang', 'image1'];
}
