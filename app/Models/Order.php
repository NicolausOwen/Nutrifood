<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'ticket_id',
        'type',
        'name',
        'umur',
        'jenis_kelamin',
        'ukuran_baju',
        'asal',
        'nama_komunitas',
        'purchase_date',
        'verification_payment',
        'verification_at',
    ];
}
