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
use Carbon;

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

        $cliente_id =DB::table('clientes')
          ->select('clientes.*')
            ->join('users', 'clientes.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->where('clientes.condicion','=', 1 )
            ->orderBy('cliente','ASC')
            ->get();


        return  view('registros.CtaCte.cheques')
                ->with('cliente_id', $cliente_id);

    }

    public function listar($estado=null)
    {

      $estado = ($estado==0) ? $estado=null : $estado;
      
      $cheques =DB::table('cheques')
          ->select('cheques.*','clientes.cliente',
            DB::raw("DATE_FORMAT(cheques.fecha,'%d/%m/%Y') as fecha"),
            DB::raw("DATE_FORMAT(cheques.fecha_cobrar,'%d/%m/%Y') as fecha_cobrar"))
            
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

        $fecha = Carbon::createFromFormat('Y-m-d', $request['fecha']);
        $cheque = new Cheque([
        'fecha' => $fecha,
        'fecha_cobrar' => $fecha,
        'importe' => $request['importe'],
        'banco' => $request['banco'],
        'numero' => $request['numero'],
        'tipo' => $request['tipo'],
        'cliente_id' => $request['cliente_id'],
        'titular' => $request['titular'],
        'destino' => $request['destino'],
        'user_id' => auth()->user()->id,
      ]);
      $cheque->save();
      // return redirect()->route('gasto.index');
      return response()->json(["data"=> $cheque->toArray()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
      $cheque = Cheque::find($id);
      $cheque->delete();
      return response()->json(["data" => $cheque]);
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
