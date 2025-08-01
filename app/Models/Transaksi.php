<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'user_id', 'film_id', 'jumlah_tiket', 'total_harga',
        'order_id', 'payment_url', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function film() {
        return $this->belongsTo(Film::class);
    }
}
