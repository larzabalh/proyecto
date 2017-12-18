<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{

  protected $table = 'disponibilidades';
   protected $fillable = ['user_id','nombre','debe','haber','comentario','medio_id'];

  //Relacion
    public function user() {
          return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id
      }
  //Relacion
  public function medio() {
        return $this->belongsTo('App\Medios'); // Le indicamos que se va relacionar con el atributo id
    }
}
