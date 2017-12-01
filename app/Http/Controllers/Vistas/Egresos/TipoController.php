<?php

namespace App\Http\Controllers\Vistas\Egresos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use App\Gasto;
use App\Tipo_de_gasto;

class TipoController extends Controller
{
  public function select_tipo(Request $request, $id, $periodo)
  {
    $array = explode('-', $periodo);

    $filtro =DB::table('reg_gastos')
        ->select('gastos.gasto',DB::raw('sum(reg_gastos.importe) as importe'))
        ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
        ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
        ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
        ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
        ->where('gastos.tipo_de_gasto_id','=',$id)
        ->groupBy('gastos.gasto')
         ->get();

     return response()->json($filtro);

     }


  public function suma_importe(Request $request, $id)
  {

      $suma =DB::table('reg_gastos')
         ->select(DB::raw('sum(reg_gastos.importe) as importe'),'gastos.gasto','gastos.id','tipos_de_gastos.tipo','tipos_de_gastos.id')
         ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
         ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
         ->where('gastos.id','=',$id)
         ->groupBy('gastos.gasto','gastos.id','tipos_de_gastos.tipo','tipos_de_gastos.id')
          ->get();

      return response()->json($suma);

  }

   public function index()
   {

       $periodos =DB::table('reg_gastos')
           ->select(DB::raw("distinct (concat(year(fecha), '-', month(fecha))) as fecha"))
            ->get();

            // $periodos =DB::table('periodos')
            //     ->select('periodo')
            //      ->get();

            $tipos =DB::table('reg_gastos')
                ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
                ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
                ->select('tipos_de_gastos.id','tipos_de_gastos.tipo')
                ->groupBy('tipos_de_gastos.tipo','tipos_de_gastos.id')
                 ->get();

            // dd($tipos);



         return view('vistas.egresos.tipo', ['periodos' => $periodos,'tipos' => $tipos]);

   }
}
