<?php

namespace App;

use App\Http\Controllers\Auth\MustVerifyEmail;
use App\Http\Controllers\Auth\MustVerifyPhone;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use MustVerifyPhone;
    use MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number',
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

    public function oauth()
    {
        return $this->hasOne('App\SocialAuth');
    }
    public function emailVerification()
    {
        return $this->hasOne(EmailVerification::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }
        return $this->roles()->syncWithoutDetaching($role);
    }
}
