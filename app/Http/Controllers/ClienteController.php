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
          ->select('clientes.*','facturadores.facturador','liquidadores.liquidador','cobradores.cobrador','disponibilidades.disponibilidad')
          ->get();

          // dd($clientes);
          $todos_clientes = Cliente::orderBy('cliente','ASC')->get();
          $facturadores = Facturador::orderBy('facturador','ASC')->get();
          $liquidadores = Liquidador::orderBy('liquidador','ASC')->get();
          $cobradores = Cobrador::orderBy('cobrador','ASC')->get();
          $disponibilidades = Disponibilidad::orderBy('disponibilidad','ASC')->get();

          // dd($facturadores,$liquidadores,$cobradores,$disponibilidades);
          return view('clientes.clientes')
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
      $cliente = new Cliente([
        'cliente' => $request->input('cliente'),
        'honorario' => $request->input('honorario'),
        'email' => $request->input('email'),
        'facturador_id' => $request->input('facturador'),
        'liquidador_id' => $request->input('liquidador'),
        'cobrador_id' => $request->input('cobrador'),
        'disponibilidad_id' => $request->input('disponibilidad'),
        'contacto' => $request->input('contacto'),
        'comentario' => $request->input('comentario')

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
    public function update(Request $request, $id)
    {
      $cliente = Cliente::find($id);

      $cliente->honorario = $request->input('honorario');
      $cliente->email = $request->input('email');
      $cliente->facturador_id = $request->input('facturador');
      $cliente->liquidador_id = $request->input('liquidador');
      $cliente->cobrador_id = $request->input('cobrador');
      $cliente->disponibilidad_id = $request->input('disponibilidad');
      $cliente->contacto = $request->input('contacto');
      $cliente->comentario = $request->input('comentario');

      $cliente->save();
      return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cliente = Cliente::find($id);
      $cliente->delete();
      return redirect()->route('clientes.index');
    }
}
