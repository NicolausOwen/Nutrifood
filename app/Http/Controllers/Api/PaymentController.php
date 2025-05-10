<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        if(!Auth::id()){
            return response()->json([
                'status' => 'error',
                'message' => 'Harap masuk atau buat akun terlebih dahulu!'
            ], 405);
        }
        if (!$request->hasFile('payment_proof')) {
            return response()->json([
                'status' => 'error',
                'message' => 'No file uploaded'
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'payment_proof' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $lastPayment = DB::table('payments')
        ->select('id')
        ->orderByDesc('id')
        ->first();

        if ($lastPayment) {
            $lastNumber = intval(str_replace('Payment-', '', $lastPayment->id));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $paymentid = "Payment-" . $newNumber;

        try {
            if (!$request->hasFile('payment_proof')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No file uploaded'
                ], 400);
            }

            $file = $request->file('payment_proof');

            if (!$file->isValid()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File upload failed'
                ], 400);
            }

            $filename = $paymentid . '_' . time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('payment_proofs', $filename, 'public');

            $payment = Payment::create([
                'id' => $paymentid,
                'user_id' => Auth::id(),
                'payment_proof' => $path,
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Payment made succesfully',
                'payment' => $payment
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error saat membuat payment. ' . $e->getMessage()
            ], 500);
        }
    }
}