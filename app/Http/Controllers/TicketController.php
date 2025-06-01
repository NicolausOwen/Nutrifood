<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tickets = [];

        for ($i = 0; $i < $request->quantity; $i++) {
            $ticketId = 'Ticket-' . str_pad(rand(1, 9999), 3, '0', STR_PAD_LEFT);

            // Generate QR Code (simple string for now)
            $qrCodeString = strtolower(substr(md5($ticketId . time()), 0, 32));

            $ticket = Ticket::create([
                'id' => $ticketId,
                'id_user' => Auth::id(),
                'type' => $request->type,
                'checkup' => 0,
                'makan' => 0,
                'masuk' => 0,
                'qr_code' => $qrCodeString,
                'purchase_date' => now(),
            ]);

            $tickets[] = $ticket;
        }

        return redirect()->route('dashboard')
            ->with('success', 'Tiket berhasil dibeli! Total: ' . count($tickets) . ' tiket');
    }

    public function show($id)
    {
        $ticket = Ticket::with('user')->findOrFail($id);

        // Check if user owns this ticket or is admin
        if ($ticket->id_user !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access to ticket');
        }

        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);

        // Only admin can edit tickets
        if (!Auth::user()->is_admin) {
            abort(403, 'Only admin can edit tickets');
        }

        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        // Only admin can update tickets
        if (!Auth::user()->is_admin) {
            abort(403, 'Only admin can update tickets');
        }

        $validator = Validator::make($request->all(), [
            'checkup' => 'boolean',
            'makan' => 'boolean',
            'masuk' => 'boolean',
            'type' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ticket->update($request->only(['checkup', 'makan', 'masuk', 'type']));

        return redirect()->route('tickets.show', $ticket->id)
            ->with('success', 'Tiket berhasil diupdate');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        // Only admin can delete tickets
        if (!Auth::user()->is_admin) {
            abort(403, 'Only admin can delete tickets');
        }

        // Delete QR code file
        if ($ticket->qr_code && Storage::disk('public')->exists($ticket->qr_code)) {
            Storage::disk('public')->delete($ticket->qr_code);
        }

        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil dihapus');
    }

    public function myTickets()
    {
        $tickets = Ticket::where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('tickets'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $tickets = Ticket::where('id_user', $user->id)
            ->get();

        // Group tickets by type and count
        $ticketGroups = $tickets->groupBy('type')->map(function ($group) {
            return [
                'type' => $group->first()->type,
                'count' => $group->count(),
                'created_at' => $group->first()->created_at,
                'tickets' => $group
            ];
        });

        return view('user.dashboard', compact('user', 'tickets', 'ticketGroups'));
    }

    public function buyTicket()
    {
        return view('tickets.buy');
    }
}