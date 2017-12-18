<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forma_pago extends Model
{
	protected $table = 'fora_pagos';
	protected $fillable = ['user_id','nombre','disponibilidad_id'];

	//Relacion
    public function user() {
          return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id

	public function disponibilidad() {
        return $this->belongsTo('App\Disponibilidad'); // Le indicamos que se va relacionar con el atributo id
    }

}
