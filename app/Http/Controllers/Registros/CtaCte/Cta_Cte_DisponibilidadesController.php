<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cliente;
use App\Facturador;
use App\Liquidador;
use App\Cobrador;
use App\Disponibilidad;
use App\CtaCteCliente;
use App\cta_cte_disponibilidades;
use Illuminate\Support\Facades\Auth;

class Cta_Cte_DisponibilidadesController extends Controller
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

        $disponibilidades =DB::table('disponibilidades')
          ->select('disponibilidades.*')
            ->where('disponibilidades.user_id',"=",auth()->user()->id )
            ->where('disponibilidades.condicion',"=",1)
            ->orderBy('nombre','ASC')
            ->get();

        $periodos =DB::table('cta_cte_disponibilidades')
        ->select(DB::raw("distinct (concat(year(fecha), '-', month(fecha))) as fecha"))
        ->where(DB::raw('user_id'),auth()->user()->id )
        ->orderby('fecha','ASC')
        ->get();

        $cliente_id =DB::table('cta_cte_disponibilidades')
          ->select(DB::raw("distinct(clientes.cliente)as clientes"),'cta_cte_disponibilidades.cliente_id as id')
            ->join('clientes', 'cta_cte_disponibilidades.cliente_id', '=', 'clientes.id')
            ->join('users', 'cta_cte_disponibilidades.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->orderBy('clientes','ASC')
            ->get();

            $clientes =DB::table('clientes')
         	 	->select(\DB::raw("cliente as concepto"))
            	->where(DB::raw('user_id'),auth()->user()->id )
            	->orderBy('cliente','ASC')
            	;

	        $forma_pagos =DB::table('forma_de_pagos')
	          	->select(\DB::raw("nombre as concepto"))
	            ->where(DB::raw('user_id'),auth()->user()->id )
	            ->orderBy('nombre','ASC')
	     		;
	            
	        $gastos =DB::table('gastos')
	          	->select(\DB::raw("gasto as concepto"))
	            ->where(DB::raw('user_id'),auth()->user()->id )
	            ->orderBy('gasto','ASC')
	     		;

        $conceptos = $clientes->union($forma_pagos)->union($gastos)->get();


        $disponibilidad_id =DB::table('cta_cte_disponibilidades')
          ->select(DB::raw("distinct(concat(medios.nombre,'-',disponibilidades.nombre))as bancos"),'cta_cte_disponibilidades.disponibilidad_id as id')
            ->join('disponibilidades', 'cta_cte_disponibilidades.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
            ->join('users', 'cta_cte_disponibilidades.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->orderBy('bancos','ASC')
            ->get();


        return view('registros.ctacte.disponibilidades')
        ->with('disponibilidades', $disponibilidades)
        ->with('cliente_id', $cliente_id)
        ->with('periodos',$periodos)
        ->with('conceptos',$conceptos)
        ->with('disponibilidad_id', $disponibilidad_id);

    }

    public function listar($disponibilidad_id)
    { 
      $disponibilidades =DB::table('cta_cte_disponibilidades')
            ->select('clientes.cliente','cta_cte_disponibilidades.*',
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("CAST(fecha AS DATE) as fecha"),
            DB::raw("IFNULL(cta_cte_disponibilidades.debe, 0) as debe"),//Esto lo hago para que salga el cero y esta pisando * que puse primero
            DB::raw("IFNULL(disponibilidades.nombre, '') as disponibilidad_id"))//Esto lo hago para que salga el cero y esta pisando * que puse primero
            ->join('disponibilidades', 'cta_cte_disponibilidades.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('users', 'cta_cte_disponibilidades.user_id', '=', 'users.id')
            ->join('clientes', 'cta_cte_disponibilidades.cliente_id', '=', 'clientes.id')
            ->where(DB::raw('cta_cte_disponibilidades.user_id'),auth()->user()->id )
            ->where('cta_cte_disponibilidades.disponibilidad_id',"=",$disponibilidad_id)
            ->orderBy('cta_cte_disponibilidades.id','asc')
            ->get();

        return response()->json(["data"=>$disponibilidades->toArray()]);
    }

     public function listar_uno($id)
    {
      
      $disponibilidades =DB::table('cta_cte_disponibilidades')
            ->select('clientes.cliente','cta_cte_disponibilidades.*',
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("CAST(fecha AS DATE) as fecha"),
            DB::raw("IFNULL(cta_cte_disponibilidades.haber, 0) as haber"),//Esto lo hago para que salga el cero y esta pisando * que puse primero
            DB::raw("IFNULL(disponibilidades.nombre, '') as banco"))//Esto lo hago para que salga el cero y esta pisando * que puse primero
            ->leftjoin('disponibilidades', 'cta_cte_disponibilidades.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('users', 'cta_cte_disponibilidades.user_id', '=', 'users.id')
            ->join('clientes', 'cta_cte_disponibilidades.cliente_id', '=', 'clientes.id')
            ->where(DB::raw('cta_cte_disponibilidades.user_id'),auth()->user()->id )
            ->where('cta_cte_disponibilidades.id',"=",$id)
            ->orderBy('cta_cte_disponibilidades.id','asc')
            ->get();

        return response()->json(["data"=>$disponibilidades->toArray()]);
    }

    
    public function store(Request $request)
    {


    }

    
    public function grabar(Request $request)
    {
      $honorario = $request->honorario;
      $debe=0;
      $haber=0;

      if ($request->contabilidad == 'debe') {
        $debe = $honorario;
      }else{
        $haber=$honorario;
      }

        $CtaCteCliente = new CtaCteCliente([
                'fecha' =>$request->fecha,
                'cliente_id' =>$request->cliente_id,
                'debe' => $debe,
                'haber' => $haber,
                'disponibilidad_id' => $request->disponibilidad_id,
                'comentario' => $request->comentario,
                'user_id' => auth()->user()->id,
              ]);
        $CtaCteCliente->save();

      return response()->json([
              "data"=> $CtaCteCliente->toArray(),
              "data1"=> $CtaCteDisponibilidades->toArray(),
              ]);
    }

    public function editar(Request $request, $id)
    {

      $honorario = $request->honorario;
      $debe=0;
      $haber=0;

      if ($request->contabilidad == 'debe') {
        $debe = $honorario;
      }else{
        $haber=$honorario;
      }


      $CtaCteCliente = CtaCteCliente::find($id);
      $CtaCteCliente->fecha =  $request['fecha'];
      $CtaCteCliente->cliente_id =  $request['cliente_id'];
      $CtaCteCliente->debe =  $debe;
      $CtaCteCliente->haber =  $haber;
      $CtaCteCliente->disponibilidad_id =  $request['disponibilidad_id'];
      $CtaCteCliente->comentario =  $request['comentario'];

      $CtaCteCliente->save();

      return response()->json(["data" => $CtaCteCliente]);
    }

    public function eliminar($id)
    {
      $cta_cte_disponibilidades = cta_cte_disponibilidades::find($id);
      $cta_cte_disponibilidades->delete();
      return response()->json(["data" => $cta_cte_disponibilidades]);
    }

}