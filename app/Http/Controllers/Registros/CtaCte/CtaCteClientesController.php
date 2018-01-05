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
use Illuminate\Support\Facades\Auth;

class CtaCteClientesController extends Controller
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

        $clientes =DB::table('clientes')
          ->select('clientes.*')
            ->where('clientes.user_id',"=",auth()->user()->id )
            ->where('clientes.condicion',"=",1)
            ->orderBy('cliente','ASC')
            ->get();

        $periodos =DB::table('cta_cte_clientes')
        ->select(DB::raw("distinct (concat(year(fecha), '-', month(fecha))) as fecha"))
        ->where(DB::raw('user_id'),auth()->user()->id )
        ->orderby('fecha','ASC')
        ->get();

        $cliente_id =DB::table('cta_cte_clientes')
          ->select(DB::raw("distinct(clientes.cliente)as clientes"),'cta_cte_clientes.cliente_id as id')
            ->join('clientes', 'cta_cte_clientes.cliente_id', '=', 'clientes.id')
            ->join('users', 'cta_cte_clientes.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->orderBy('clientes','ASC')
            ->get();

        $disponibilidad_id =DB::table('cta_cte_clientes')
          ->select(DB::raw("distinct(disponibilidades.nombre)as bancos"),'cta_cte_clientes.cliente_id as id')
            ->join('disponibilidades', 'cta_cte_clientes.cliente_id', '=', 'disponibilidades.id')
            ->join('users', 'cta_cte_clientes.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->orderBy('bancos','ASC')
            ->get();


        return view('registros.ctacte.clientes')
        ->with('clientes', $clientes)
        ->with('cliente_id', $cliente_id)
        ->with('periodos',$periodos)
        ->with('disponibilidad_id', $disponibilidad_id);

    }

    public function listar($cliente_id)
    {

      
      
      $cliente =DB::table('cta_cte_clientes')
            ->select('clientes.cliente','cta_cte_clientes.*',
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("CAST(fecha AS DATE) as fecha"),
            DB::raw("IFNULL(cta_cte_clientes.haber, 0) as haber"),//Esto lo hago para que salga el cero y esta pisando * que puse primero
            DB::raw("IFNULL(disponibilidades.nombre, '') as disponibilidad_id"))//Esto lo hago para que salga el cero y esta pisando * que puse primero
            ->leftjoin('disponibilidades', 'cta_cte_clientes.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('users', 'cta_cte_clientes.user_id', '=', 'users.id')
            ->join('clientes', 'cta_cte_clientes.cliente_id', '=', 'clientes.id')
            ->where(DB::raw('cta_cte_clientes.user_id'),auth()->user()->id )
            ->where('cta_cte_clientes.cliente_id',"=",$cliente_id)
            ->orderBy('cta_cte_clientes.id','asc')
            ->get();

        return response()->json(["data"=>$cliente->toArray()]);
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

      return response()->json(["data"=> $CtaCteCliente->toArray()]);
    }

    public function editar(Request $request, $id)
    {
      $reg_gastos = Reg_Gasto::find($id);
      $reg_gastos->fecha =  $request['fecha'];
      $reg_gastos->gasto_id =  $request['gasto_id'];
      $reg_gastos->forma_de_pagos_id =  $request['forma_de_pagos_id'];
      $reg_gastos->importe =  $request['importe'];
      $reg_gastos->comentario =  $request['comentario'];

      $reg_gastos->save();

      return response()->json(["data" => $reg_gastos]);
    }

    public function eliminar($id)
    {
      $reg_gastos = Reg_Gasto::find($id);
      $reg_gastos->delete();
      return response()->json(["data" => $reg_gastos]);
    }

    public function eliminar_masivos($ids)

    {
      //Force array
      // $ids = is_array($ids) ? $ids : array($ids);

        foreach ($ids as $id) {
          // dd($key);
          $reg_gastos = Reg_Gasto::find($id);
          $reg_gastos->delete();
      }
        return response()->json(["data" => 'borrados']);
    }

    public function selectCuentas($id)
    {

        $reg_gastos =DB::table('disponibilidades')
          ->select('disponibilidades.id','disponibilidades.nombre','disponibilidades.medio_id','medios.nombre as medio_nombre','users.name')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'disponibilidades.user_id', '=', 'users.id')
          ->where(DB::raw('medios.id'),'=',$id)
          ->where(DB::raw('users.id'),auth()->user()->id )
           ->get();

        return response()->json(["data"=> $reg_gastos->toArray()]);
    }

}