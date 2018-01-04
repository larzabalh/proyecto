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
        ->with('cliente_id', $cliente_id)
        ->with('periodos',$periodos)
        ->with('disponibilidad_id', $disponibilidad_id);

    }

    public function listar($cliente_id)
    {

      
      
      $cliente =DB::table('cta_cte_clientes')
            ->select(
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("CAST(fecha AS DATE) as fecha"),
            'disponibilidades.nombre as bancos','clientes.cliente','cta_cte_clientes.*')
            ->join('disponibilidades', 'cta_cte_clientes.cliente_id', '=', 'disponibilidades.id')
            ->join('users', 'cta_cte_clientes.user_id', '=', 'users.id')
            ->join('clientes', 'cta_cte_clientes.cliente_id', '=', 'clientes.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->where(DB::raw('cta_cte_clientes.cliente_id'),'=',$cliente_id)
            ->get();

        return response()->json(["data"=>$cliente->toArray()]);
    }

    public function store(Request $request)
    {
      $reg_gastos = new Reg_Gasto([
        'fecha' => $request->input('fecha'),
        'gasto_id' => $request->input('gasto_id'),
        'forma_de_pagos_id' => $request->input('forma_de_pagos_id'),
        'importe' => $request->input('importe'),
        'comentario' => $request->input('comentario'),
        'user_id' => auth()->user()->id,
        'masivo' => 1,
      ]);
      $reg_gastos->save();

    /*  $reg_gastos ='ok';*/

      return response()->json(["data"=> $reg_gastos->toArray()]);
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