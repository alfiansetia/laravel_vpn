<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute($value)
    {
        if ($value && file_exists(storage_path('app/images/invoice/' . $value))) {
            return storage_path('app/images/invoice/' . $value);
        } else {
            return url('images/default/invoice.png');
        }
    }
}
