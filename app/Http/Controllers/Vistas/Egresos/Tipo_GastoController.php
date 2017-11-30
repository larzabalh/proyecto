<?php

namespace App\Http\Controllers\Vistas\Egresos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Gasto;
use App\Tipo_de_gasto;

class Tipo_GastoController extends Controller
{
  public function select_gasto(Request $request, $id)
  {

    $gastos =DB::table('reg_gastos')
        ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
        ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
        ->where('gastos.tipo_de_gasto_id','=',$id)
        ->select('gastos.gasto','gastos.id')
        ->groupBy('gastos.gasto','gastos.id')
         ->get();

     return response()->json($gastos);

     }


public function suma_importe(Request $request, $id)
{

$suma =DB::table('reg_gastos')
   ->select(DB::raw('sum(reg_gastos.importe) as importe'),'gastos.gasto','gastos.id','tipos_de_gastos.tipo','tipos_de_gastos.id')
   ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
   ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
   ->where('gastos.id','=',$id)
   ->groupBy('gastos.gasto','gastos.id','tipos_de_gastos.tipo','tipos_de_gastos.id')
    ->first();

return response()->json($suma);

}




 public function index()
 {

   $tipos =DB::table('reg_gastos')
       ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
       ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
       ->select('tipos_de_gastos.tipo','tipos_de_gastos.id')
       ->groupBy('tipos_de_gastos.tipo','tipos_de_gastos.id')
        ->get();

   // $gastos = Gasto::all();
   // dd($gastos);



     return view('vistas.egresos.tipo-gasto', ['tipos' => $tipos]);

 }
}
