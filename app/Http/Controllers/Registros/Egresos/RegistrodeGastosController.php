<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Reg_Gasto;
use App\Forma_de_Pagos;
use App\Gasto;

class RegistrodeGastosController extends Controller
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

      $periodos =DB::table('reg_gastos')
       ->select(DB::raw("distinct (concat(year(fecha), '-', month(fecha))) as fecha"))
       ->orderby('fecha','ASC')
        ->get();

      $gasto =DB::table('reg_gastos')
          ->select(DB::raw("distinct(concat(tipos_de_gastos.tipo,'-',gastos.gasto))as gasto"),'reg_gastos.gasto_id as id')
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->get();

      $forma_pagos =DB::table('reg_gastos')
          ->select(DB::raw("distinct(concat(medios.nombre,'-',disponibilidades.nombre,'-',forma_de_pagos.nombre))as forma_pagos"), 'reg_gastos.forma_de_pagos_id as id')
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->get();



        return view('registros.gastos')
        ->with('gasto', $gasto)
        ->with('periodos',$periodos)
        ->with('forma_pagos', $forma_pagos);

    }

    public function listar($periodo)
    {
      $array = explode('-', $periodo);
      $reg_gastos =DB::table('reg_gastos')
          ->select(
            DB::raw("concat(tipos_de_gastos.tipo,'-',gastos.gasto)as concepto"),
            DB::raw("concat(medios.nombre,'-',disponibilidades.nombre,'-',forma_de_pagos.nombre)as caja"),
            DB::raw("concat(year(fecha), '-', month(fecha)) as fecha"),
            'reg_gastos.id','reg_gastos.gasto_id','reg_gastos.forma_de_pagos_id','reg_gastos.importe','reg_gastos.comentario')
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
          ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
          ->get();

        return response()->json(["data"=>$reg_gastos->toArray()]);
    }

    public function store(Request $request)
    {
      $forma_pagos = new Forma_de_Pagos([
        'nombre' => $request->input('nombre'),
        'disponibilidad_id' => $request->input('disponibilidad_id'),
        'user_id' => auth()->user()->id,
      ]);
      $forma_pagos->save();

    /*  $forma_pagos ='ok';*/

      return response()->json(["data"=> $forma_pagos->toArray()]);
    }

    public function editar(Request $request, $id)
    {
      $Disponibilidad = Forma_de_Pagos::find($id);
      $Disponibilidad->nombre =  $request['nombre'];
      $Disponibilidad->disponibilidad_id = $request['disponibilidad_id'];

      $Disponibilidad->save();

      return response()->json(["data" => $Disponibilidad]);
    }

    public function eliminar($id)
    {
      $Disponibilidad = Forma_de_Pagos::find($id);
      $Disponibilidad->delete();
      return response()->json(["data" => $Disponibilidad]);
    }

    public function eliminar_masivos($ids)

    {
      //Force array
      // $ids = is_array($ids) ? $ids : array($ids);

        foreach ($ids as $id) {
          // dd($key);
          $Disponibilidad = Forma_de_Pagos::find($id);
          $Disponibilidad->delete();
      }
        return response()->json(["data" => 'borrados']);
    }

    public function selectCuentas($id)
    {

        $disponibilidades =DB::table('disponibilidades')
          ->select('disponibilidades.id','disponibilidades.nombre','disponibilidades.medio_id','medios.nombre as medio_nombre','users.name')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'disponibilidades.user_id', '=', 'users.id')
          ->where(DB::raw('medios.id'),'=',$id)
          ->where(DB::raw('users.id'),auth()->user()->id )
           ->get();

        return response()->json(["data"=> $disponibilidades->toArray()]);
    }

}


        