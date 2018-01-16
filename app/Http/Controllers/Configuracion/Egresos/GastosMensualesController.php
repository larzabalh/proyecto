<?php

namespace App\Http\Controllers;

use App\GastosMensuales;
use Illuminate\Http\Request;
use DB;
use App\Forma_de_Pagos;
use App\Gasto;
use App\cta_cte_disponibilidades;

class GastosMensualesController extends Controller
{
    function __construct()
  {
      $this->middleware('auth');
  }
    /**

     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response     */
    public function index()
    {

      $gasto =DB::table('gastos')
          ->select('gastos.*')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->where('gastos.user_id',"=",auth()->user()->id )
          ->get();

      $forma_pagos =DB::table('forma_de_pagos')
          ->select(DB::raw("distinct(concat(medios.nombre,'-',forma_de_pagos.nombre))as forma_pagos"),'forma_de_pagos.*')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'forma_de_pagos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->orderBy('forma_pagos','ASC')
          ->get();



        return view('configuracion.egresos.gastos_mensuales')
        ->with('gasto', $gasto)
        ->with('forma_pagos', $forma_pagos);

    }

    public function listar($gasto_filtro=null)
    {

      $gasto_filtro = ($gasto_filtro==0) ? $gasto_filtro=null : $gasto_filtro;
      
      $gastos_mensuales =DB::table('gastos_mensuales')
          ->select(
            /*DB::raw("concat(tipos_de_gastos.tipo,'-',gastos.gasto)as concepto"),*/
            DB::raw("concat(medios.nombre,'-',forma_de_pagos.nombre)as caja"),
            'tipos_de_gastos.tipo','gastos.gasto','gastos_mensuales.id','gastos_mensuales.gasto_id','gastos_mensuales.forma_de_pagos_id','gastos_mensuales.importe','gastos_mensuales.comentario')
          ->join('gastos', 'gastos_mensuales.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'gastos_mensuales.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where(DB::raw('gastos_mensuales.forma_de_pagos_id'),'LIKE',$gasto_filtro)
          ->get();

        return response()->json(["data"=>$gastos_mensuales->toArray()]);
    }

    public function store(Request $request)
    {
      $gastos_mensuales = new GastosMensuales([
        'gasto_id' => $request->input('gasto_id'),
        'forma_de_pagos_id' => $request->input('forma_de_pagos_id'),
        'importe' => $request->input('importe'),
        'comentario' => $request->input('comentario'),
        'user_id' => auth()->user()->id,
      ]);
      $gastos_mensuales->save();


      return response()->json(["data"=> $gastos_mensuales->toArray()]);
    }

    public function editar(Request $request, $id)
    {
      $gastos_mensuales = GastosMensuales::find($id);
      $gastos_mensuales->gasto_id =  $request['gasto_id'];
      $gastos_mensuales->forma_de_pagos_id =  $request['forma_de_pagos_id'];
      $gastos_mensuales->importe =  $request['importe'];
      $gastos_mensuales->comentario =  $request['comentario'];

      $gastos_mensuales->save();

      return response()->json(["data" => $gastos_mensuales]);
    }

    public function eliminar($id)
    {
      $gastos_mensuales = GastosMensuales::find($id);
      $gastos_mensuales->delete();
      return response()->json(["data" => $gastos_mensuales]);
    }

    public function eliminar_masivos($ids)

    {
      //Force array
      // $ids = is_array($ids) ? $ids : array($ids);

        foreach ($ids as $id) {
          // dd($key);
          $gastos_mensuales = GastosMensuales::find($id);
          $gastos_mensuales->delete();
      }
        return response()->json(["data" => 'borrados']);
    }

    public function selectCuentas($id)
    {

        $gastos_mensuales =DB::table('disponibilidades')
          ->select('disponibilidades.id','disponibilidades.nombre','disponibilidades.medio_id','medios.nombre as medio_nombre','users.name')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'disponibilidades.user_id', '=', 'users.id')
          ->where(DB::raw('medios.id'),'=',$id)
          ->where(DB::raw('users.id'),auth()->user()->id )
           ->get();

        return response()->json(["data"=> $gastos_mensuales->toArray()]);
    }

}
