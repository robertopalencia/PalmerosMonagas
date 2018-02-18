<?php

namespace Palma;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $table = "control";
    protected $fillable = ['ubicacion','id_gandola'];
}
