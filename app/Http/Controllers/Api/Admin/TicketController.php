<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{

    public function index()
    {
        $ticket = Ticket::all();

        return ResponseFormatter::success($ticket, 'List Tiket Berhasil Di Ambil');
    }


    public function store(TicketRequest $request)
    {

        $image = $request->file('image')->store('ticket', 'public');

        $ticket = Ticket::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $image,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        if ($ticket) {
            return ResponseFormatter::success($ticket, 'Tiket Berhasi Ditambahkan');
        } else {
            return ResponseFormatter::error(null, 'Tiket Gagal Ditambahkan', 500);
        }
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        return ResponseFormatter::success($ticket, 'Detail Tiket Berhasil Diambil');
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($request->file('image')) {
            $image = $request->file('image')->store('ticket', 'public');
        } else {
            $image = $ticket->image;
        }

        $ticket->update([
            'title' => $request->title ?? $ticket->title,
            'slug' => Str::slug($request->title) ?? $ticket->slug,
            'image' => $image,
            'description' => $request->description ?? $ticket->description,
            'status' => $request->status ?? $ticket->status,
            'price' => $request->price ?? $ticket->price,
        ]);

        if ($ticket) {
            return ResponseFormatter::success($ticket, 'Ticket Berhasil Di Update');
        } else {
            return ResponseFormatter::error(null, 'Tiket Gagal Diupdate', 500);
        }
    }


    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id)->delete();

        return ResponseFormatter::success($ticket, 'Tiket Berhasil Dihapus');
    }
}
