<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forma_pago extends Model
{
  protected $table = 'forma_pagos';
  protected $guarded = [];


  public function disponibilidad() {
        return $this->belongsTo('App\Disponibilidad'); // Le indicamos que se va relacionar con el atributo id
    }

}
