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
    public function dashboard()
    {
        $user = Auth::user();
        $tickets = Ticket::where('id_user', $user->id)
            ->get();

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
}