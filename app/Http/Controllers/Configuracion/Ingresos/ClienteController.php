<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Cliente;
use App\Facturador;
use App\Liquidador;
use App\Cobrador;
use App\Disponibilidad;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

// dd($request->input('cliente_buscar').'%');
      $clientes =DB::table('clientes')
          ->leftjoin('facturadores', 'clientes.facturador_id', '=', 'facturadores.id')
          ->leftjoin('liquidadores', 'clientes.liquidador_id', '=', 'liquidadores.id')
          ->leftjoin('cobradores', 'clientes.cobrador_id', '=', 'cobradores.id')
          ->leftjoin('disponibilidades', 'clientes.disponibilidad_id', '=', 'disponibilidades.id')
          ->orderBy('cliente','ASC')
          ->where('clientes.id',"LIKE",'%'.$request->input('cliente_buscar').'%')
          ->where('clientes.honorario',"LIKE",'%'.$request->input('honorario_buscar').'%')
          ->where('clientes.email',"LIKE",'%'.$request->input('email_buscar').'%')
          ->where('facturadores.id',"LIKE",$request->input('facturador_buscar'))
          ->where('liquidadores.id',"LIKE",$request->input('liquidador_buscar'))
          ->where('cobradores.id',"LIKE",$request->input('cobrador_buscar'))
          ->where('disponibilidades.id','LIKE',$request->input('disponibilidad_buscar'))
          ->where('clientes.condicion',"=",1)
          ->select('clientes.*','facturadores.facturador','liquidadores.liquidador','cobradores.cobrador','disponibilidades.nombre')
          ->get();

          // dd($clientes);
          $todos_clientes = Cliente::orderBy('cliente','ASC')->get();
          $facturadores = Facturador::orderBy('facturador','ASC')->get();
          $liquidadores = Liquidador::orderBy('liquidador','ASC')->get();
          $cobradores = Cobrador::orderBy('cobrador','ASC')->get();
          $disponibilidades = Disponibilidad::orderBy('nombre','ASC')->get();

          // dd($facturadores,$liquidadores,$cobradores,$disponibilidades);
          return view('configuracion.ingresos.clientes')
          ->with('clientes', $clientes)
          ->with('facturadores', $facturadores)
          ->with('liquidadores', $liquidadores)
          ->with('cobradores', $cobradores)
          ->with('todos_clientes', $todos_clientes)
          ->with('disponibilidades', $disponibilidades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function listar()
    {

      $clientes =DB::table('clientes')
          ->select('clientes.*','facturadores.facturador','liquidadores.liquidador','cobradores.cobrador','disponibilidades.nombre as banco')
          ->leftjoin('facturadores', 'clientes.facturador_id', '=', 'facturadores.id')
          ->leftjoin('liquidadores', 'clientes.liquidador_id', '=', 'liquidadores.id')
          ->leftjoin('cobradores', 'clientes.cobrador_id', '=', 'cobradores.id')
          ->leftjoin('disponibilidades', 'clientes.disponibilidad_id', '=', 'disponibilidades.id')
          ->leftjoin('users', 'clientes.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where('clientes.condicion',"=",1)
          ->orderBy('cliente','ASC')
          ->get();


        return response()->json(["data"=>$clientes->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $cliente = new Cliente([
        'cliente' => $request->input('cliente'),
        'honorario' => $request->input('honorario'),
        'email' => $request->input('email'),
        'facturador_id' => $request->input('facturador_id'),
        'liquidador_id' => $request->input('liquidador_id'),
        'cobrador_id' => $request->input('cobrador_id'),
        'disponibilidad_id' => $request->input('disponibilidad_id'),
        'contacto' => $request->input('contacto'),
        'comentario' => $request->input('comentario'),
        'user_id' => auth()->user()->id,

      ]);
      $cliente->save();
      return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $cliente = Cliente::find($id);
      $facturadores = Facturador::orderBy('facturador','ASC')->get();
      $liquidadores = Liquidador::orderBy('liquidador','ASC')->get();
      $cobradores = Cobrador::orderBy('cobrador','ASC')->get();
      $disponibilidades = Disponibilidad::orderBy('disponibilidad','ASC')->get();
      return view('clientes.cliente_edit')
      ->with('cliente', $cliente)
      ->with('facturadores', $facturadores)
      ->with('liquidadores', $liquidadores)
      ->with('cobradores', $cobradores)
      ->with('disponibilidades', $disponibilidades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request, $id)
    {
      $cliente = Cliente::find($id);

      $cliente->honorario = $request->input('honorario');
      $cliente->email = $request->input('email');
      $cliente->facturador_id = $request->input('facturador_id');
      $cliente->liquidador_id = $request->input('liquidador_id');
      $cliente->cobrador_id = $request->input('cobrador_id');
      $cliente->disponibilidad_id = $request->input('disponibilidad_id');
      $cliente->contacto = $request->input('contacto');
      $cliente->comentario = $request->input('comentario');

      $cliente->save();
     return response()->json(["data" => $cliente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function eliminar($id)
    {
      $cliente = Cliente::find($id);
      $cliente->condicion = 0;

      $cliente->save();
      return response()->json(["data" => $cliente]);
    }
}
