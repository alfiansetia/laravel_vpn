<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'order_id'  => 'integer',
        'amount'    => 'integer',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
