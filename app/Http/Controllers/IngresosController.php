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
use App\IngresosMensuales;
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
      $clientes = Cliente::orderBy('cliente','ASC')->get();
      $facturadores = Facturador::orderBy('facturador','ASC')->get();
      $liquidadores = Liquidador::orderBy('liquidador','ASC')->get();
      $cobradores = Cobrador::orderBy('cobrador','ASC')->get();
      $disponibilidades = Disponibilidad::orderBy('disponibilidad','ASC')->get();
      $periodos = Periodo::orderBy('id','ASC')->get();

      // dd($facturadores,$liquidadores,$cobradores,$disponibilidades);
      return view('ingresos.ingresos')
      ->with('clientes', $clientes)
      ->with('facturadores', $facturadores)
      ->with('liquidadores', $liquidadores)
      ->with('cobradores', $cobradores)
      ->with('disponibilidades', $disponibilidades)
      ->with('periodos', $periodos);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function asignar(IngresosMensualesRequest $request)
    {
      $honorarios = $request->input('honorario');
      $periodo = Periodo::find($request->input('periodo'));

      foreach ($honorarios as $idCliente => $monto) {

      $ingresomensual = new IngresosMensuales([
        'periodo_id' => $request->input('periodo'),
        'cliente_id' =>$idCliente,
        'honorario' => $monto
      ]);
      $ingresomensual->save();
    }
      return redirect()->route('mensual.index')->with('periodo', $periodo);;

  // dd($request);

      // dd($request->input('cliente'));
    }
}
