<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Gasto;
use App\Tipo_de_gasto;
use App\Http\Requests\GastosRequest;

class GastosController extends Controller
{

  function __construct()
  {
      $this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

      $tipos = Tipo_de_gasto::all();
        return view('configuracion.egresos.gastos')
        ->with('tipos', $tipos);
    }

    public function listar(){
      $gastos =DB::table('gastos')
          ->select('gastos.id','gastos.gasto','gastos.condicion','tipos_de_gastos.tipo','tipos_de_gastos.id as id_tipo','users.name')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
           ->get();

        return response()->json(["data"=> $gastos->toArray()]);

    }

    public function store(GastosRequest $request)
    {
      $gasto = new Gasto([
        'gasto' => $request->input('gasto'),
        'tipo_de_gasto_id' => $request->input('tipo'),
        'user_id' => auth()->user()->id,
      ]);
      $gasto->save();
      // return redirect()->route('gasto.index');
      return response()->json(["data"=> $gasto->toArray()]);
    }

    public function editar(Request $request, $id)
    {
      $gasto = Gasto::find($id);
      $gasto->gasto =  $request['gasto'];
      $gasto->tipo_de_gasto_id = $request['tipo'];

      $gasto->save();

      return response()->json(["data" => $gasto]);
    }

    public function eliminar($id)
    {
      $gasto = Gasto::find($id);
      $gasto->delete();
      return response()->json(["data" => $gasto]);
    }

    public function eliminar_masivos($ids)

    {
      //Force array
      // $ids = is_array($ids) ? $ids : array($ids);

        foreach ($ids as $id) {
          // dd($key);
          $gasto = Gasto::find($id);
          $gasto->delete();
      }
        return response()->json(["data" => 'borrados']);
    }

}
