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
        function __construct()
        {
            $this->middleware('auth');
        }

  public function select_tipo(Request $request, $id, $periodo)
  {
    $array = explode('-', $periodo);

    $filtro =DB::table('reg_gastos')
        ->select('gastos.gasto',DB::raw('round(sum(reg_gastos.importe),2) as importe'))
        ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
        ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
        ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
        ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
        ->where('gastos.tipo_de_gasto_id','=',$id)
        ->groupBy('gastos.gasto')
         ->get();



    return response()->json(["data"=> $filtro->toArray()]);

     }


   public function index()
   {

       $periodos =DB::table('reg_gastos')
           ->select(DB::raw("distinct (concat(year(fecha), '-', month(fecha))) as fecha"))
           ->orderby('fecha','ASC')
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
