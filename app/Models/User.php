<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'avatar',
        'last_login_at',
        'last_login_ip',
        'email_verified_at',
        'status',
        'gender',
        'instagram',
        'facebook',
        'linkedin',
        'github'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id'                => 'integer',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function vpn()
    {
        return $this->hasMany(Vpn::class);
    }

    public function getAvatarAttribute($value)
    {
        if ($value && file_exists(public_path('/images/avatar/' . $value))) {
            return url('/images/avatar/' . $value);
        } else {
            return url('/images/default/avatar-' . $this->gender . '.png');
        }
    }

    public function is_verified()
    {
        return $this->email_verified_at != null ? 'verified' : 'unverified';
    }

    public function notifications()
    {
        return $this->hasMany(NotificationUser::class);
    }

    public function notification_unreads()
    {
        return $this->hasMany(NotificationUser::class)->where('is_read', 'no');
    }

    public function complete()
    {
        if (
            empty($this->address) || empty($this->phone) || empty($this->phone) || empty($this->instagram)
            || empty($this->facebook) || empty($this->linkedin) || empty($this->github)
        ) {
            return true;
        } else {
            return false;
        }
    }
}
