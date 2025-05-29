<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketStok extends Model
{
    use HasFactory;

    protected $table = 'ticket_stock';
    protected $primaryKey = 'type';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'type',
        'stok'
    ];
}
