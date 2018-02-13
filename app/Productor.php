<?php

namespace Palma;

use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    protected $table = "productor";
    protected $fillable = ['nombre','cedula','rif','finca','cuenta','direccion'];
   
}
