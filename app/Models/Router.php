<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'        => 'integer',
        'user_id'   => 'integer',
    ];

    protected $hidden = [
        'password',
    ];

    public function port()
    {
        return $this->belongsTo(Port::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
