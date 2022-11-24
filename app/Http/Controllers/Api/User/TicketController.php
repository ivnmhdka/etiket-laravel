<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Ticket;


class TicketController extends Controller
{

    public function index()
    {
        $ticket = Ticket::all();

        return ResponseFormatter::success($ticket, 'Data Ticket Berhasil Diambil');
    }

    public function show(Ticket $ticket)
    {
        return ResponseFormatter::success($ticket, 'Detail Tiket Berhasil Diambil');
    }
}
