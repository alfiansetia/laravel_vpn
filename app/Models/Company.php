<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'        => 'integer',
    ];

    public function getLogoLightAttribute($value)
    {
        if ($value && file_exists(public_path('images/logo/' . $value))) {
            return url('images/logo/' . $value);
        } else {
            return url('images/default/logo2.svg');
        }
    }

    public function getLogoDarkAttribute($value)
    {
        if ($value && file_exists(public_path('images/logo/' . $value))) {
            return url('images/logo/' . $value);
        } else {
            return url('images/default/logo.svg');
        }
    }
}
