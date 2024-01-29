<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'        => 'integer',
    ];

    public function details()
    {
        return $this->hasMany(NotificationUser::class);
    }
}
