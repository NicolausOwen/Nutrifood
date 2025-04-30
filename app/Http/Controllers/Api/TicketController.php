<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Validator;

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
            'id_user' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $lastTicket = DB::table('tickets')
        ->select('id')
        ->orderByDesc('id')
        ->first();

        if ($lastTicket) {
            $lastNumber = intval(str_replace('Ticket-', '', $lastTicket->id));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $orderid = "Ticket-" . $newNumber;

        $qrCodeString = Str::uuid()->toString();

        $ticket = Ticket::create([
            'id' => $orderid,
            'id_user' => $request->id_user,
            'checkup' => false,
            'makan' => false,
            'used' => false,
            'qr_code' => $qrCodeString,
        ]);

        app(EmailController::class)->sendEmail($ticket);

        return response()->json(['tickets' => $ticket, 'qr' => 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=' . $qrCodeString]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id',
            'checkup' => 'required|boolean',
            'makan' => 'required|boolean',
            'used' => 'required|boolean',
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
        if ($ticket->$target) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket already used'
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