<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastosMensuales extends Model
{
   protected $table = 'gastos_mensuales';
  protected $guarded = [];
  protected $dates = ['fecha'];

//Relacion
  public function user() {
        return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id
    }

  //Relacion
  public function gasto() {
        return $this->belongsTo(Gasto::class); // Le indicamos que se va relacionar con el atributo id
    }

  public function forma_de_pagos() {
        return $this->belongsTo(Forma_de_Pagos::class); // Le indicamos que se va relacionar con el atributo id
    }
}
