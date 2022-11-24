<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BookTicketController extends Controller
{
    public function store(Ticket $ticket, Request $request)
    {
        $price = $ticket->price * $request->people;

        $service = $price * 0.1;

        $transaction = Transaction::create([
            'ticket_id' => $ticket->id,
            'user_id' => $request->user()->id,
            'transaction_code' => 'TRX' . mt_rand(10000, 99999) . mt_rand(100, 999),
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'people' => $request->people,
            'service' => $service,
            'transaction_total' => $price + $service,
            'transaction_status' => 'PENDING',
        ]);

        return ResponseFormatter::success([
            'transaction' => $transaction
        ], 'Transaksi Berhasil, Silahkan Lanjutkan Pembayaran');
    }
}
