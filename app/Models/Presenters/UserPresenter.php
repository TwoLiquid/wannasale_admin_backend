<?php

namespace App\Models\Presenters;

use Hash;

trait UserPresenter
{
    public function setPasswordAttribute($value) : void
    {
        $this->attributes['password'] = ($value !== null ? Hash::make($value) : null);
    }
}