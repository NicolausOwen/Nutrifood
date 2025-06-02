<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'id_user',
        'checkup',
        'makan',
        'masuk',
        'type',
        'qr_code',
        'purchase_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
