<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Forma_de_Pagos;
use App\Disponibilidad;
use App\Medios;

class Forma_PagoController extends Controller
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

      $disponibilidades = Disponibilidad::all();
      $bancos = Medios::all();
        return view('configuracion.vistas.forma_pagos')
        ->with('disponibilidades', $disponibilidades)
        ->with('bancos', $bancos);
    }

    public function listar(){
      $forma_pagos =DB::table('forma_de_pagos')
          ->select('forma_de_pagos.id','forma_de_pagos.nombre','disponibilidades.id as disponibilidad_id','disponibilidades.nombre as disponibilidad_nombre','medios.nombre as medio_id','users.name')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'disponibilidades.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
           ->get();

        return response()->json(["data"=> $forma_pagos->toArray()]);

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
