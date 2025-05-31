<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function bikinorder(Request $request)
    {
        $user = Auth::user();
        $userId = $user ? $user->id : null;

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User harus login terlebih dahulu!',
                'debug' => [
                    'auth_check' => Auth::check(),
                    'has_session' => !empty(session()->getId())
                ]
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $lastTicket = DB::table('orders')
                ->select('id')
                ->orderByDesc('id')
                ->first();

            if ($lastTicket) {
                $lastNumber = intval(str_replace('Order-', '', $lastTicket->id));
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            $orderid = "Order-" . $newNumber;

            $order = Order::create([
                'id' => $orderid,
                'user_id' => $userId,
                'type' => $request->type,
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat',
                'order_id' => $order->id,
                'order' => $order
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat order: ' . $e->getMessage()
            ], 500);
        }
    }
}