<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'        => 'integer',
        'vpn_id'    => 'integer',
        'user_id'   => 'integer',
        'bank_id'   => 'integer',
        'total'     => 'integer',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vpn()
    {
        return $this->belongsTo(Vpn::class);
    }

    public function getImageAttribute($value)
    {
        if ($value && file_exists(public_path('images/invoice/' . $value))) {
            return asset('images/invoice/' . $value);
        } else {
            return asset('images/default/noimage.jpg');
        }
    }
}
