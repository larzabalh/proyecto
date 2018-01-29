<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class efectivo extends Model
{
   protected $table = 'efectivos';
	protected $guarded = [];
	 
	protected $dates = ['fecha'];

	//Relacion
  	public function user() {
        return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id
    }
}
