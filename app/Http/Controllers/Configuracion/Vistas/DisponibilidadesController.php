<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Disponibilidad;
use App\Medios;



class DisponibilidadesController extends Controller{
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

      $tipos = Medios::all();
        return view('configuracion.vistas.disponibilidades')->with('tipos', $tipos);
    }

    public function listar(){
      $disponibilidades =DB::table('disponibilidades')
          ->select('disponibilidades.id','disponibilidades.nombre','disponibilidades.medio_id','medios.nombre as medio_nombre','users.name')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'disponibilidades.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
           ->get();

        return response()->json(["data"=> $disponibilidades->toArray()]);

    }

    public function store(Request $request)
    {
      $Disponibilidad = new Disponibilidad([
        'nombre' => $request->input('nombre'),
        'medio_id' => $request->input('medio_id'),
        'user_id' => auth()->user()->id,
      ]);
      $Disponibilidad->save();
      // return redirect()->route('Disponibilidad.index');
      return response()->json(["data"=> $Disponibilidad->toArray()]);
    }

    public function editar(Request $request, $id)
    {
      $Disponibilidad = Disponibilidad::find($id);
      $Disponibilidad->nombre =  $request['nombre'];
      $Disponibilidad->medio_id = $request['medio_id'];

      $Disponibilidad->save();

      return response()->json(["data" => $Disponibilidad]);
    }

    public function eliminar($id)
    {
      $Disponibilidad = Disponibilidad::find($id);
      $Disponibilidad->delete();
      return response()->json(["data" => $Disponibilidad]);
    }

    public function eliminar_masivos($ids)

    {
      //Force array
      // $ids = is_array($ids) ? $ids : array($ids);

        foreach ($ids as $id) {
          // dd($key);
          $Disponibilidad = Disponibilidad::find($id);
          $Disponibilidad->delete();
      }
        return response()->json(["data" => 'borrados']);
    }

}
