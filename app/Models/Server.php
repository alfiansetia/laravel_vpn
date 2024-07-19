<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'        => 'integer',
    ];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['ip'])) {
            $query->where('ip', 'like', '%' . $filters['ip'] . '%');
        }
        if (isset($filters['domain'])) {
            $query->where('domain', 'like', '%' . $filters['domain'] . '%');
        }
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }
        if (isset($filters['is_available'])) {
            $query->where('is_available', $filters['is_available']);
        }
    }

    protected $hidden = [
        'password',
    ];

    public function vpn()
    {
        return $this->hasMany(Vpn::class);
    }
}
