<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $orders = Order::where('user_id', $user->id)
            ->get();

        $orderGroups = $orders->groupBy('type')->map(function ($group) {
            return [
                'type' => $group->first()->type,
                'count' => $group->count(),
                'status' => $group->first()->verification_payment == 'True' ? 'Active' : 'Pending',
                'purchase_date' => $group->first()->purchase_date,
                'orders' => $group
            ];
        });

        return view('user.dashboard', compact('user', 'orders', 'orderGroups'));
    }

    public function dashboard2()
    {
        $user = Auth::user();
        $tickets = Ticket::where('id_user', $user->id)
            ->get();

        $ticketGroups = $tickets->groupBy('type')->map(function ($group) {
            return [
                'type' => $group->first()->type,
                'count' => $group->count(),
                'purchase_date' => $group->first()->purchase_date,
                'tickets' => $group
            ];
        });

        return view('user.dashboard-ticket', compact('user', 'tickets', 'ticketGroups'));
    }
}