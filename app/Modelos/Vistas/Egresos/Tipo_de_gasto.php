<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_de_gasto extends Model
{
  protected $table = 'tipos_de_gastos';
  protected $guarded = [];


  // Relación
          public function gastos()
          {
              return $this->hasMany('App\Gasto');
          }

}
