<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Ticket $ticket)
    {
        $user = $ticket->user;

        if (!$user || !$user->email) {
            return 'User atau email tidak ditemukan.';
        }

        Mail::to($user->email)->send(new SendEmail($ticket));

        return "Email telah dikirim ke {$user->email}!";
    }
}