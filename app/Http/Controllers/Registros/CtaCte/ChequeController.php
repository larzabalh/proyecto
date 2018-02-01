<?php

namespace App\Http\Controllers;

use App\Cheque;
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

class ChequeController extends Controller
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


        return view('registros.CtaCte.cheques')
        ->with('disponibilidades', $disponibilidades)
        ->with('cliente_id', $cliente_id)
        ->with('periodos',$periodos)
        ->with('conceptos',$conceptos)
        ->with('disponibilidad_id', $disponibilidad_id);

    }

    public function listar($estado=null)
    {

      $estado = ($estado==0) ? $estado=null : $estado;
      
      $cheques =DB::table('cheques')
          ->select('cheques.*','clientes.cliente')
          ->join('clientes', 'cheques.cliente_id', '=', 'clientes.id')
          ->join('users', 'cheques.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where('cheques.estado',"=",$estado)
          ->get();

        return response()->json(["data"=>$cheques->toArray()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function show(Cheque $cheque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function edit(Cheque $cheque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cheque $cheque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cheque $cheque)
    {
        //
    }
}
