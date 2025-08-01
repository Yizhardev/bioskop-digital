<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;

class MidtransController extends Controller
{

    public function callback(Request $request){
    $serverKey = config('midtrans.server_key');
    $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    if ($hashed != $request->signature_key) {
        return response()->json(['message' => 'Invalid signature'], 403);
    }


    $transaksi = Transaksi::where('order_id', $request->order_id)->first();

    if (!$transaksi) {
        return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
    }


    if ($request->transaction_status == 'settlement') {
        $transaksi->status = 'sukses';
    } elseif ($request->transaction_status == 'pending') {
        $transaksi->status = 'pending';
    } elseif ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
        $transaksi->status = 'gagal';
    }

    $transaksi->save();

    return response()->json(['message' => 'Notifikasi diproses']);
    }
}
