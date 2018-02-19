<?php

namespace Palma;

use Illuminate\Database\Eloquent\Model;

class Cargagandola extends Model
{
    protected $table = "cargagandola";
    protected $fillable = ['peso_neto','finale','id_gandola','peso_mermado', 'peso_real'];
}
