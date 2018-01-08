<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CtaCteCliente extends Model
{
	protected $table = 'cta_cte_clientes';
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

    public function id_cta_cte_disponibilidad() {
          return $this->belongsTo(cta_cte_disponibilidades::class); // Le indicamos que se va relacionar con el atributo id
      }
}
