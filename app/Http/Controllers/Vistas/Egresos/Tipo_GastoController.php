<?php

namespace App\Http\Controllers\Vistas\Egresos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Gasto;
use App\Tipo_de_gasto;

class Tipo_GastoController extends Controller
{

function __construct()
{
    $this->middleware('auth');
}

  public function periodo(Request $request, $periodo)
  {
    $array = explode('-', $periodo);
    $filtro =DB::table('reg_gastos')
        ->select('gastos.gasto','tipos_de_gastos.tipo',DB::raw('sum(reg_gastos.importe) as importe'))
        ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
        ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
        ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
        ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
        ->groupBy('gastos.gasto','tipos_de_gastos.tipo')
         ->get();

     return response()->json(["data"=> $filtro->toArray()]);

     }

 public function index()
 {
   $periodos =DB::table('reg_gastos')
       ->select(DB::raw("distinct (concat(year(fecha), '-', month(fecha))) as fecha"))
       ->orderby('fecha','ASC')
        ->get();

   $tipos =DB::table('reg_gastos')
       ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
       ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
       ->select('tipos_de_gastos.tipo','tipos_de_gastos.id')
       ->groupBy('tipos_de_gastos.tipo','tipos_de_gastos.id')
        ->get();

    $filtro =DB::table('reg_gastos')
        ->select('gastos.gasto','tipos_de_gastos.tipo',DB::raw('sum(reg_gastos.importe) as importe'))
        ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
        ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
        // ->where(DB::raw('year(reg_gastos.fecha)'), DB::raw(concat(YEAR(CURDATE()),'-',MONTH(CURDATE()))))
        ->groupBy('gastos.gasto','tipos_de_gastos.tipo')
         ->get();


     return view('vistas.egresos.tipo-gasto', ['periodos' => $periodos,'tipos' => $tipos,'filtro' => $filtro]);

 }
}
