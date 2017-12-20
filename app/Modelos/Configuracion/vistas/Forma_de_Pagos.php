<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Forma_de_Pagos extends Model
{
    protected $table = 'forma_de_pagos';
   	protected $fillable = ['user_id','nombre','disponibilidad_id'];

  //Relacion
    public function user() {
          return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id
      }
  //Relacion
  public function disponibilidad() {
        return $this->belongsTo('App\Disponibilidad'); // Le indicamos que se va relacionar con el atributo id
    }
}

