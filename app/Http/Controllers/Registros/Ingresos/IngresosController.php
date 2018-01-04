<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Cliente;
use App\Facturador;
use App\Liquidador;
use App\Cobrador;
use App\Disponibilidad;
use App\Periodo;
use App\CtaCteCliente;
use App\Http\Requests\IngresosMensualesRequest;
use Illuminate\Support\Facades\Auth;


class IngresosController extends Controller
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
      $clientes = Cliente::orderBy('cliente','ASC')->get();
      $facturadores = Facturador::orderBy('facturador','ASC')->get();
      $liquidadores = Liquidador::orderBy('liquidador','ASC')->get();
      $cobradores = Cobrador::orderBy('cobrador','ASC')->get();
      $disponibilidades = Disponibilidad::orderBy('nombre','ASC')->get();
      $periodos = Periodo::orderBy('id','ASC')->get();
      
      return view('registros.ingresos.ingresos')
      ->with('clientes', $clientes)
      ->with('facturadores', $facturadores)
      ->with('liquidadores', $liquidadores)
      ->with('cobradores', $cobradores)
      ->with('disponibilidades', $disponibilidades)
      ->with('periodos', $periodos);
    }

     public function listar()
    {
      $clientes =DB::table('clientes')
          ->select('clientes.*')
          ->where(DB::raw('user_id'),auth()->user()->id )
          ->get();

        return response()->json(["data"=>$clientes->toArray()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      // dd($request->input('cliente'));
      dd($request->cliente);
        return 'aca estoy';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $lstData=$request->data;
        $fecha = $request->fecha;    

        For($i=0; $i<count($lstData);$i++){
        $datos = $lstData[$i];
        $cliente_id=$datos['id'];
        $honorarios=$datos['honorarios'];
        $comentarios=$datos['comentarios'];


        $CtaCteCliente = new CtaCteCliente([
                'fecha' =>$fecha,
                'cliente_id' =>$cliente_id,
                'debe' => $honorarios,
                'comentario' => $comentarios,
                'user_id' => auth()->user()->id,
              ]);
         $CtaCteCliente->save();

        }
      return response()->json(["data"=>$CtaCteCliente->toArray()]);
    }

    public function verificarUnSoloIngresoMasivo(Request $request)
    {

        $fecha = $request->fecha;    

        For($i=0; $i<count($lstData);$i++){
        $datos = $lstData[$i];
        $cliente_id=$datos['id'];
        $honorarios=$datos['honorarios'];
        $comentarios=$datos['comentarios'];


        $CtaCteCliente = new CtaCteCliente([
                'fecha' =>$fecha,
                'cliente_id' =>$cliente_id,
                'debe' => $honorarios,
                'comentario' => $comentarios,
                'user_id' => auth()->user()->id,
              ]);
         $CtaCteCliente->save();

        }
      return response()->json(["data"=>$CtaCteCliente->toArray()]);
    }


}
