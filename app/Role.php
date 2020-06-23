<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $guarded = [];

    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    public function assignAbility($ability)
    {
        return $this->abilities()->syncWithoutDetaching($ability);
    }
}
