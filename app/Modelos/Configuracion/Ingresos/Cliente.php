<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facturador;
use Carbon\Carbon;

class Cliente extends Model
{
  protected $table = 'clientes';
  protected $guarded = [];
  protected $dates = ['created_at','updated_at'];
  


  public function facturador() {
        return $this->belongsTo('App\Facturador'); // Le indicamos que se va relacionar con el atributo id
    }

  public function liquidador() {
        return $this->belongsTo('App\Liquidador'); // Le indicamos que se va relacionar con el atributo id
    }

  public function cobrador() {
        return $this->belongsTo('App\Cobrador'); // Le indicamos que se va relacionar con el atributo id
    }

  public function disponibilidad() {
        return $this->belongsTo('App\Disponibilidad'); // Le indicamos que se va relacionar con el atributo id
    }



}
