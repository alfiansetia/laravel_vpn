<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'        => 'integer',
        'vpn_id'    => 'integer',
        'dst'       => 'integer',
        'to'        => 'integer',
    ];

    public function vpn()
    {
        return $this->belongsTo(Vpn::class);
    }
}
