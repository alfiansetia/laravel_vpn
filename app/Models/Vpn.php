<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Vpn extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'        => 'integer',
        'user_id'   => 'integer',
        'server_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function port()
    {
        return $this->hasMany((Port::class));
    }

    public function is_expired()
    {
        if ($this->expired) {
            $expiredDate = Carbon::createFromFormat('Y-m-d', $this->expired);
            $today = Carbon::now();
            if ($expiredDate->lessThanOrEqualTo($today)) {
                return true;
            }
        }
        return false;
    }
}
