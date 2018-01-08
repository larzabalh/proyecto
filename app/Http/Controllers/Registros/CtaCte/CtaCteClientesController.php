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

     public function listar_uno($id)
    {
      
      $cliente =DB::table('cta_cte_clientes')
            ->select('clientes.cliente','cta_cte_clientes.*',
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("CAST(fecha AS DATE) as fecha"),
            DB::raw("IFNULL(cta_cte_clientes.haber, 0) as haber"),//Esto lo hago para que salga el cero y esta pisando * que puse primero
            DB::raw("IFNULL(disponibilidades.nombre, '') as banco"))//Esto lo hago para que salga el cero y esta pisando * que puse primero
            ->leftjoin('disponibilidades', 'cta_cte_clientes.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('users', 'cta_cte_clientes.user_id', '=', 'users.id')
            ->join('clientes', 'cta_cte_clientes.cliente_id', '=', 'clientes.id')
            ->where(DB::raw('cta_cte_clientes.user_id'),auth()->user()->id )
            ->where('cta_cte_clientes.id',"=",$id)
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

        if (isset($request->disponibilidad_id) and $haber !=0) {
          $CtaCteDisponibilidades = new cta_cte_disponibilidades([
                'fecha' =>$request->fecha,
                'cliente_id' =>$request->cliente_id,
                'debe' => $haber,
                'haber' => $debe,
                'disponibilidad_id' => $request->disponibilidad_id,
                'comentario' => $request->comentario,
                'user_id' => auth()->user()->id,
              ]);
        $CtaCteDisponibilidades->save();
        }
        //Guardo el Id de graben en CtaCteDisponibilidades, para luego guardarlo en la otra consulta!!!
        $id_cta_cte_disponibilidad = $CtaCteDisponibilidades->id;

        $CtaCteCliente = new CtaCteCliente([
                'fecha' =>$request->fecha,
                'cliente_id' =>$request->cliente_id,
                'debe' => $debe,
                'haber' => $haber,
                'disponibilidad_id' => $request->disponibilidad_id,
                'id_cta_cte_disponibilidad' => $id_cta_cte_disponibilidad,
                'comentario' => $request->comentario,
                'user_id' => auth()->user()->id,
              ]);
        $CtaCteCliente->save();

      return response()->json([
              "data"=> $CtaCteCliente->toArray(),
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

         if (isset($request->disponibilidad_id) and $haber !=0) {

          $CtaCteDisponibilidades = cta_cte_disponibilidades::find($CtaCteCliente->id_cta_cte_disponibilidad);

            $CtaCteDisponibilidades->fecha =  $request['fecha'];
            $CtaCteDisponibilidades->cliente_id =  $request['cliente_id'];
            $CtaCteDisponibilidades->debe =  $haber;
            $CtaCteDisponibilidades->haber =  $debe;
            $CtaCteDisponibilidades->disponibilidad_id =  $request['disponibilidad_id'];
            $CtaCteDisponibilidades->comentario =  $request['comentario'];

          $CtaCteDisponibilidades->save();
        }



      return response()->json([
                              "data" => $CtaCteCliente,
                              "data1" => $CtaCteDisponibilidades
                              ]);
    }

    public function eliminar($id)
    {
      $CtaCteCliente = CtaCteCliente::find($id);
      $CtaCteCliente->delete();
      return response()->json(["data" => $CtaCteCliente]);
    }

}