<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresosMensuales extends Model
{
  protected $table = 'ingresos_mensuales';
  protected $guarded = [];
  protected $dates = ['fecha'];
  //Relacionp
  public function periodo() {
        return $this->belongsTo(Periodo::class); // Le indicamos que se va relacionar con el atributo id
    }

    public function cliente() {
          return $this->belongsTo(Cliente::class); // Le indicamos que se va relacionar con el atributo id
      }
}
