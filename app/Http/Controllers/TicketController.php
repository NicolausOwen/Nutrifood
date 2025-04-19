<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function indexapi()
    {
        $tickets = Ticket::all();
        return response()->json(['tickets' => $tickets]);
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $orderid = "Ticket-" . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -5);
        $qrCodeString = Str::uuid()->toString();

        $ticket = Ticket::create([
            'id' => $orderid,
            'id_user' => $request->id_user,
            'checkup' => false,
            'makan' => false,
            'used' => false,
            'qr_code' => $qrCodeString,
        ]);

        return response()->json(['tickets' => $ticket]);
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
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

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully');
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

    public function myTickets()
    {
        $tickets = Ticket::where('id_user', Auth::id())->get();
        return view('tickets.my-tickets', compact('tickets'));
    }

    public function generateQrCode($id)
    {
        $ticket = Ticket::findOrFail($id);
        $qrCode = QrCode::size(300)->generate($ticket->qr_code);

        return view('tickets.qrcode', compact('ticket', 'qrCode'));
    }
}