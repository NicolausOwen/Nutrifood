<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'ticket_id',
        'payment_proof',
        'created_at',
        'verification_payment',
        'verification_at',
    ];
}
