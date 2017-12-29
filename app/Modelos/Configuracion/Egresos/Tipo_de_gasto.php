<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_de_gasto extends Model
{
  protected $table = 'tipos_de_gastos';
  protected $fillable = ['tipo','user_id'];

//Relacion
    public function user() {
          return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id
      }

  // Relación
          public function gastos()
          {
              return $this->hasMany('App\Gasto');
          }

}
