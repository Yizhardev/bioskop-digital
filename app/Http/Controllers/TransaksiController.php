<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Film;
use Midtrans\Config;
use Barryvdh\DomPDF\PDF;
use App\Models\Transaksi;
use Midtrans\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{

public function create($id)
{
    $film = Film::findOrFail($id);
    return view('member.beliFilm', compact('film'));
}

 public function bayar(Request $request, $id)
{
     $request->validate([
        'jumlah_tiket' => 'required|integer|min:1'
    ]);

    $film = Film::findOrFail($id);
    $user = Auth::user();
    $hargaPerTiket = 50000;

    $jumlah = $request->jumlah_tiket;
    $total = $jumlah * $hargaPerTiket;
    $order_id = 'TIKET-' . strtoupper(Str::random(8));

    // Simpan ke DB
    $transaction = Transaksi::create([
        'user_id' => $user->id,
        'film_id' => $film->id,
        'jumlah_tiket' => $jumlah,
        'total_harga' => $total,
        'order_id' => $order_id,
        'status' => 'pending'
    ]);

    // Konfigurasi Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
    \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

    $params = [
        'transaction_details' => [
            'order_id' => $order_id,
            'gross_amount' => $total,
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
        ],
        'enabled_payments' => ['gopay', 'bank_transfer', 'shopeepay'],
        'callbacks' => [
            'finish' => route('member.transaksi.konfirmasi', $order_id),
        ],
    ];

    $snap = \Midtrans\Snap::getSnapToken($params);
    return response()->json(['snap_token' => $snap]);
}

public function etiket()
{
    $user = Auth::user();

    // Ambil transaksi terakhir user (atau bisa semua histori kalau kamu mau)
    $transaksi = Transaksi::with('film')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->first(); // atau ->get() kalau mau tampilkan semua transaksi

    if (!$transaksi) {
        return redirect()->route('member.dashboard')->with('error', 'Belum ada transaksi.');
    }

    return view('member.etiket', compact('transaksi'));
}

public function history()
{
    $user = Auth::user();
    $transaksi = Transaksi::with('film')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('member.history', compact('transaksi'));
    }
public function unduhTiket($id)
{
    $transaksi = Transaksi::with('film')->where('user_id', Auth::id())->findOrFail($id);
    $pdf = app('dompdf.wrapper')->loadView('member.unduhTiket', compact('transaksi'));
    return $pdf->download('tiket-' . $transaksi->order_id . '.pdf');
}

public function konfirmasi($order_id)
{
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');

    $status = Transaction::status($order_id);

    $transaksi = Transaksi::where('order_id', $order_id)->firstOrFail();

    // Update status transaksi berdasarkan respon Midtrans
    if ($status->transaction_status === 'settlement' || $status->transaction_status === 'capture') {
        $transaksi->status = 'success';
        $transaksi->save();

        return redirect()->route('member.etiket')->with('success', 'Pembayaran berhasil!');
    } elseif ($status->transaction_status === 'pending') {
        return redirect()->route('member.dashboard')->with('info', 'Pembayaran belum selesai.');
    } else {
        $transaksi->status = 'gagal';
        $transaksi->save();

        return redirect()->route('member.dashboard')->with('error', 'Pembayaran gagal.');
    }
}
}
