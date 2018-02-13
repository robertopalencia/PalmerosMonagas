<?php

namespace Palma;

use Illuminate\Database\Eloquent\Model;

class Gandola extends Model
{
    protected $table = "gandola";
     public function gandola()
    {
        return $this->belongsTo('Palma\Gandola', 'id_gandola');
    }
}
