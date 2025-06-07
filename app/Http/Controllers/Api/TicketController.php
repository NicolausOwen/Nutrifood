<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Models\TicketStok;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json(['tickets' => $tickets]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'type' => 'required',
        ]);

        $userId = $request->id_user;

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $lastTicket = DB::table('tickets')
            ->select('id')
            ->orderByDesc('id')
            ->first();

        if ($lastTicket) {
            $lastNumber = intval(str_replace('Ticket-', '', $lastTicket->id));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '301';
        }

        $orderid = "Ticket-" . $newNumber;

        $qrCodeString = Str::uuid()->toString();

        $makanbool = false;
        if ($request->type == 'general') {
            $makanbool = true;
        }

        $ticket = Ticket::create([
            'id' => $orderid,
            'id_user' => $userId,
            'checkup' => false,
            'makan' => $makanbool,
            'masuk' => false,
            'name' => $request->name,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'asal' => $request->asal,
            'nama_komunitas' => $request->nama_komunitas,
            'type' => $request->type,
            'qr_code' => $qrCodeString,
            'purchase_date' => Carbon::now(),
        ]);

        $query = DB::table('ticket_stock')
                ->where('type', $request->type);

        $query->decrement('stock');

        app(EmailController::class)->sendEmail($ticket);

        return response()->json(['tickets' => $ticket, 'qr' => 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=' . $qrCodeString]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id',
            'checkup' => 'required|boolean',
            'makan' => 'required|boolean',
            'masuk' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

        return redirect()->route('tickets.show', $ticket->id)
            ->with('success', 'Ticket updated successfully');
    }

    public function validateTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required|string',
            'target' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid QR code'
            ], 400);
        }

        $ticket = Ticket::where('qr_code', $request->qr_code)->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        $target = $request->target;
        if ($ticket->$target == 1) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket ' . $target . ' already used'
            ], 400);
        }
        $ticket->update([$target => true]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket validated successfully',
            'ticket' => $ticket
        ]);
    }
}