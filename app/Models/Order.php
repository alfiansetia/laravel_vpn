<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'        => 'integer',
        'user_id'   => 'integer',
        'bank_id'   => 'integer',
        'total'     => 'integer',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
