<?php

namespace Palma;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users ()
    {
        return $this->belongsToMany('Palma\user')->withTimestamps();
    }
}
