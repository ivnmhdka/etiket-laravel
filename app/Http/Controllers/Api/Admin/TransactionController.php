<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transaction = Transaction::with(['ticket'])->get();

        return ResponseFormatter::success(
            $transaction,
            'Data List Transaction Berhasil Diambil'
        );
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $data = Transaction::findOrFail($id);
        $payment = Payment::where('transaction_id', $id)->first();

        return ResponseFormatter::success([
            'transaction' => $data,
            'payment' => $payment
        ], 'Data Transaction Berhasil Diambil');
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id)->update(['transaction_status' => 'SUCCESSFUL']);

        return ResponseFormatter::success($transaction, 'Transaksi Berhasil Di Update, Pembayaran Sukses');
    }


    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id)->delete();

        return ResponseFormatter::success($transaction, 'Transaksi Berhasil Di Hapus');
    }

    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id)->update(['transaction_status' => 'FAILED']);

        return ResponseFormatter::success($transaction, 'Transaksi Berhasil Di Batalkan');
    }
}
