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
      $clientes =DB::table('clientes')
          ->select('clientes.*','facturadores.facturador','liquidadores.liquidador','cobradores.cobrador','disponibilidades.nombre as banco')
          ->join('facturadores', 'clientes.facturador_id', '=', 'facturadores.id')
          ->join('liquidadores', 'clientes.liquidador_id', '=', 'liquidadores.id')
          ->join('cobradores', 'clientes.cobrador_id', '=', 'cobradores.id')
          ->join('disponibilidades', 'clientes.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('users', 'clientes.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where('clientes.condicion',"=",1)
          ->orderBy('cliente','ASC')
          ->get();



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
          ->select('clientes.*','facturadores.facturador','liquidadores.liquidador','cobradores.cobrador','disponibilidades.nombre as banco')
          ->join('facturadores', 'clientes.facturador_id', '=', 'facturadores.id')
          ->join('liquidadores', 'clientes.liquidador_id', '=', 'liquidadores.id')
          ->join('cobradores', 'clientes.cobrador_id', '=', 'cobradores.id')
          ->join('disponibilidades', 'clientes.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('users', 'clientes.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where('clientes.condicion',"=",1)
          ->orderBy('cliente','ASC')
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
                'masivo' => 1,
              ]);
         $CtaCteCliente->save();

        }
      return response()->json(["data"=>$CtaCteCliente->toArray()]);
    }

    public function verificarUnSoloIngresoMasivo(Request $request)
    {

        $fecha = $request->fecha;    

        $array = explode('-', $fecha);
        $verificar =DB::table('cta_cte_clientes')
          ->select('masivo',
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("count(*) as cantidad")
                  )          
          ->where(DB::raw('user_id'),auth()->user()->id )
          ->where(DB::raw('year(fecha)'), $array[0])
          ->where(DB::raw('month(fecha)'), $array[1])
          ->where(DB::raw('masivo'),'=',1)
          ->groupBy('masivo')
          ->groupBy('fecha')
          ->get();
        
      return response()->json(["data"=>$verificar->toArray()]);
    }


}
