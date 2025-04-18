<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'checkup',
        'makan',
        'used',
        'qr_code',
    ];
}
