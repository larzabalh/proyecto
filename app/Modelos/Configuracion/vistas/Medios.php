<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medios extends Model
{
    protected $table = 'medios';
  protected $fillable = ['nombre','user_id'];

//Relacion
    public function user() {
          return $this->belongsTo('App\User'); // Le indicamos que se va relacionar con el atributo id
      }

  
}
