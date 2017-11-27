<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reg_Gasto extends Model
{

  protected $table = 'reg_gastos';
  protected $guarded = [];
  protected $dates = ['fecha'];
  //Relacion
  public function gasto() {
        return $this->belongsTo(Gasto::class); // Le indicamos que se va relacionar con el atributo id
    }

  public function tipo_de_gasto() {
        return $this->belongsTo(Tipo_de_gasto::class); // Le indicamos que se va relacionar con el atributo id
    }

public function scopeGasto($query,$gasto){
          if(trim($gasto)!=""){
          $query->where("gasto_id","LIKE","$gasto");
          }
}

public function scopePeriodos($query)
{
        return $query->orderBy('fecha','ASC');
}

public function scopeTipo($query,$tipo){
          if(trim($tipo)!=""){
          $query->where("tipo_de_gasto_id","LIKE","%$tipo%");
          }
}

public function scopeImporte($query,$importe){
          if(trim($importe)!=""){
          $query->where("importe","LIKE","%$importe%");
          }
}

}
