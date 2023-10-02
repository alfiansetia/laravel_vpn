<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [
        'username',
        'password',
    ];

    public function vpn()
    {
        return $this->hasMany(Vpn::class);
    }
}
