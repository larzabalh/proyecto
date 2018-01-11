<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cta_cte_disponibilidades extends Model
{
   	protected $table = 'cta_cte_disponibilidades';
	protected $guarded = [];
	 
	protected $dates = ['fecha'];

	//Relacion
  	public function user() {
        return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id
    }


    public function cliente() {
          return $this->belongsTo(Cliente::class); // Le indicamos que se va relacionar con el atributo id
      }

    public function disponibilidad() {
          return $this->belongsTo(Disponibilidad::class); // Le indicamos que se va relacionar con el atributo id
      }

    public function id_CtaCteCliente() {
          return $this->belongsTo(CtaCteCliente::class); // Le indicamos que se va relacionar con el atributo id
      }

    public function id_concepto() {
          return $this->belongsTo(View_Conceptos::class); // Le indicamos que se va relacionar con el atributo id
      }

      
}
