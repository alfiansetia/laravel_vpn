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
        'number'    => 'integer',
        'due_date'  => 'integer',
        'credit'    => 'integer',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction_items()
    {
        return $this->hasMany(Transaction::class);
    }
}
