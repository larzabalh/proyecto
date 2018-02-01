<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
   protected $table = 'cheques';
	protected $guarded = [];
	 
	protected $dates = ['fecha','fecha_cobrar'];

	//Relacion
  	public function user() {
        return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id
    }

    public function cliente() {
          return $this->belongsTo(Cliente::class); // Le indicamos que se va relacionar con el atributo id
      }
}
