<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    //
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
