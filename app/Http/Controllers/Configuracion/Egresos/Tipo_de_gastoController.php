<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_de_gasto;
use DB;

class Tipo_de_gastoController extends Controller
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

      $tipos = Tipo_de_gasto::where('user_id',auth()->user()->id)->get();;
      
        return view('configuracion.egresos.tipos_gastos', ['tipos' => $tipos]);
    }


    public function listar(){
      $tipos = Tipo_de_gasto::where('user_id',auth()->user()->id)->get();;
        
        return response()->json(["data"=> $tipos->toArray()]);
    }

    public function store(Request $request)
    {
      $tipo = new Tipo_de_gasto([
        'tipo' => $request->input('tipo'),
        'user_id' => auth()->user()->id,
      ]);
      $tipo->save();
      return response()->json(["data"=> $tipo->toArray()]);
    }


    public function eliminar($id)
    {
      $tipo = Tipo_de_gasto::find($id);
      $tipo->delete();
      return response()->json(["data" => $tipo]);
    }


    public function editar(Request $request, $id)
    {
      $tipo = Tipo_de_gasto::find($id);
      $tipo->tipo =  $request['tipo'];
      $tipo->save();

      return response()->json(["data" => $tipo]);
    }

 
}
