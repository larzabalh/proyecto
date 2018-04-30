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
use App\View_Conceptos;
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

      /*      $clientes =DB::table('clientes')
         	 	->select('cliente as concepto','clientes.id as id')
            	->where(DB::raw('user_id'),auth()->user()->id )
            	->orderBy('cliente','ASC')
            	;

	        $forma_pagos =DB::table('forma_de_pagos')
	          	->select('nombre as concepto','forma_de_pagos.id as id')
	            ->where(DB::raw('user_id'),auth()->user()->id )
	            ->orderBy('nombre','ASC')
	     		    ;
	            
	        $gastos =DB::table('gastos')
	          	->select('gasto as concepto','gastos.id as id')
	            ->where(DB::raw('user_id'),auth()->user()->id )
	            ->orderBy('gasto','ASC')
	     		    ;

        $conceptos = $clientes->union($forma_pagos)->union($gastos)->get();*/

        $conceptos =DB::table('view_conceptos')
            ->select('view_conceptos.*')
            ->where('view_conceptos.user_id',"=",auth()->user()->id )
            ->get();


        $disponibilidad_id =DB::table('cta_cte_disponibilidades')
          ->select(DB::raw("distinct(concat(medios.nombre,'-',disponibilidades.nombre))as bancos"),'cta_cte_disponibilidades.disponibilidad_id as id')
            ->join('disponibilidades', 'cta_cte_disponibilidades.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
            ->join('users', 'cta_cte_disponibilidades.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->orderBy('bancos','ASC')
            ->get();


        return view('registros.CtaCte.disponibilidades')
        ->with('disponibilidades', $disponibilidades)
        ->with('cliente_id', $cliente_id)
        ->with('periodos',$periodos)
        ->with('conceptos',$conceptos)
        ->with('disponibilidad_id', $disponibilidad_id);

    }

    public function listar($disponibilidad_id)
    { 
      $disponibilidades =DB::table('cta_cte_disponibilidades')
            ->select('clientes.cliente','view_conceptos.*','cta_cte_disponibilidades.*',
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("CAST(fecha AS DATE) as fecha"),
            DB::raw("IFNULL(cta_cte_disponibilidades.debe, 0) as debe"),//Esto lo hago para que salga el cero y esta pisando * que puse primero
            DB::raw("IFNULL(disponibilidades.nombre, '') as disponibilidad_id"),//Esto lo hago para que salga el cero y esta pisando * que puse primero
            DB::raw("IFNULL(cta_cte_disponibilidades.comentario, '') as comentario"))//Esto lo hago para que salga el cero y esta pisando * que puse primero
            ->join('disponibilidades', 'cta_cte_disponibilidades.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('view_conceptos', 'cta_cte_disponibilidades.id_concepto', '=', 'view_conceptos.id')
            ->leftjoin('clientes', 'cta_cte_disponibilidades.cliente_id', '=', 'clientes.id')
            ->join('users', 'cta_cte_disponibilidades.user_id', '=', 'users.id')
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
            ->leftjoin('clientes', 'cta_cte_disponibilidades.cliente_id', '=', 'clientes.id')
            ->where(DB::raw('cta_cte_disponibilidades.user_id'),auth()->user()->id )
            ->where('cta_cte_disponibilidades.id',"=",$id)
            ->orderBy('cta_cte_disponibilidades.id','asc')
            ->get();

        return response()->json(["data"=>$disponibilidades->toArray()]);
    }

    
    public function store(Request $request)
    {


    }

      public function show(Request $request)
    {


    }

    
    public function grabar(Request $request)
    {
      //Verifico que el concepto que seleccionado sea un cliente: cliente_id
      $cliente_id =null;
      if ($request->id_concepto <10000 ) {
        //esto quiere decir que el concepto seleccionado fue un cliente entonces tengo que guardar en la Cta Cte Clientes
        $cliente_id = $request->id_concepto;
      }


      $honorario = $request->honorario;
      $debe=0;
      $haber=0;

      if ($request->contabilidad == 'debe') {
        $debe = $honorario;
      }else{
        $haber=$honorario;
      }

      //2- Guardo
        if ($cliente_id !='') {
          $cliente = new CtaCteCliente([
                'fecha' =>$request->fecha,
                'cliente_id' =>$cliente_id,
                'debe' => $haber,
                'haber' => $debe,
                'disponibilidad_id' => $request->disponibilidad_id,
                'comentario' => $request->comentario,
                'user_id' => auth()->user()->id,
              ]);
        $cliente->save();
        }

        $disponibilidades = new cta_cte_disponibilidades([
                'fecha' =>$request->fecha,
                'cliente_id' =>$cliente_id,
                'debe' => $debe,
                'haber' => $haber,
                'disponibilidad_id' =>$request->disponibilidad_id,
                'id_CtaCteCliente' => (isset ($cliente->id)?$cliente->id:null),
                'id_concepto' => $request->id_concepto,
                'comentario' => $request->comentario,
                'user_id' => auth()->user()->id,
              ]);
        $disponibilidades->save();

        //4- Actualizo lo que guarde antes, con el ultimo id de la otra tabla.
      if (isset($cliente_id) and $debe !=0) {
       /* $CtaCteDisponibilidades = cta_cte_disponibilidades::find($CtaCteDisponibilidades->id);*/
        $cliente->id_cta_cte_disponibilidad =  (isset ($disponibilidades->id)?$disponibilidades->id:null);
        $cliente->save();
      }
      return response()->json([
              "data"=> $disponibilidades->toArray(),
              
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

      $disponibilidades = cta_cte_disponibilidades::find($id);
      $disponibilidades->fecha =  $request['fecha'];
      $disponibilidades->disponibilidad_id =  $request['disponibilidad_id'];
      $disponibilidades->debe =  $debe;
      $disponibilidades->haber =  $haber;
      $disponibilidades->id_concepto =  $request['id_concepto'];
      $disponibilidades->comentario =  $request['comentario'];

      $disponibilidades->save();


      //Verifico que el concepto que seleccionado sea un cliente: cliente_id

      if ($request->id_concepto <10000 ) {
        //esto quiere decir que el concepto seleccionado fue un cliente entonces tengo que guardar en la Cta Cte Clientes
          $CtaCteCliente = CtaCteCliente::find($disponibilidades->id_CtaCteCliente);
          $CtaCteCliente->fecha =  $request['fecha'];
          $CtaCteCliente->cliente_id =  $request['id_concepto'];
          $CtaCteCliente->debe =  $haber;
          $CtaCteCliente->haber =  $debe;
          $CtaCteCliente->disponibilidad_id =  $request['disponibilidad_id'];
          $CtaCteCliente->comentario =  $request['comentario'];

          $CtaCteCliente->save();
      }


      return response()->json(["data" => $disponibilidades]);
    }

    public function eliminar($id)
    {
      

      $disponibilidades = cta_cte_disponibilidades::find($id);
      $disponibilidades->delete();


        if ($disponibilidades->cliente_id!=null) {
          

          $cliente= CtaCteCliente::find($disponibilidades->id_CtaCteCliente);
          if ($cliente != null) { //Esto lo hago por un error loco que me tira!!!
          $cliente->delete();
          }
          }


      return response()->json([
                              "data" => $disponibilidades,
                             
                              ]);
    }

}