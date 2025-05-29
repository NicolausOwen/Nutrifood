<?php

namespace App\Http\Controllers;

use App\Models\TicketStok;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function cekstock(Request $request)
    {
        $data = TicketStok::findOrFail($request->type);
        $stock = $data->stock;
        
        return response()->json(['stock'=> $stock]);
    }
}
