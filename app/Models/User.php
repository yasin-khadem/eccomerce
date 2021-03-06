<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'profile'
    ];
    protected $appends = [
        'type', 'profile_src'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    public function getTypeAttribute()
    {
        return $this->is_admin ? 'ادمین'
            : 'کاربر عادی';
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function getProfileSrcAttribute()
    {
        return $this->profile ? "/profile/{$this->profile}" : "/profile/avatar.png";
    }
    public function sendPasswordResetNotification($token)
    {
        $user = $this;
        $this->notify(new ResetPasswordNotification($token, $user));
    }
    public function scopeSearchByUrl(Builder $builder)
    {
        if (request()->search) {
            $builder->where('email', 'LIKE', '%' . request()->search . '%')
                ->orWhere('name', 'LIKE', '%' . request()->search . '%');
        }
        return $builder;
    }
}
