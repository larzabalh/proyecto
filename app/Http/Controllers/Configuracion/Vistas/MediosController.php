<?php

namespace App\Http\Controllers;

use App\Medios;
use Illuminate\Http\Request;

class MediosController extends Controller
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

      $medios = Medios::all();
        return view('configuracion.vistas.medios', ['data' => $medios]);
    }


    public function listar(){
      $medios = Medios::all();
        return response()->json(["data"=> $medios->toArray()]);
    }

    public function store(Request $request)
    {
      $medios = new Medios([
        'nombre' => $request->input('nombre'),
        'user_id' => auth()->user()->id,
      ]);
      $medios->save();
      return response()->json(["data"=> $medios->toArray()]);
    }


    public function eliminar($id)
    {
      $medio = Medios::find($id);
      $medio->delete();
      return response()->json(["data" => $medio]);
    }


    public function editar(Request $request, $id)
    {
      $medio = Medios::find($id);
      $medio->nombre =  $request['nombre'];
      $medio->save();

      return response()->json(["data" => $medio]);
    }

 
}
