<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
  protected $table = 'gastos';
  protected $fillable = ['gasto','tipo_de_gasto_id'];

  //Relacion
  public function tipo_de_gasto() {
        return $this->belongsTo('App\Tipo_de_gasto'); // Le indicamos que se va relacionar con el atributo id
    }


}
