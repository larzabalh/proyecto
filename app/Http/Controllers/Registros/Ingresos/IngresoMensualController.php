<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Periodo;

class IngresoMensualController extends Controller
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
    public function index(Request $request)
    {

// dd($request);
      $ingresos =DB::table('ingresos_mensuales')
          ->join('clientes', 'ingresos_mensuales.cliente_id', '=', 'clientes.id')
          ->join('periodos', 'ingresos_mensuales.periodo_id', '=', 'periodos.id')
          ->where('ingresos_mensuales.periodo_id',"LIKE",$request->input('periodo'))
          ->select('ingresos_mensuales.*','clientes.cliente','periodos.periodo')
          ->get();
          // dd($ingresos);

          $periodos = Periodo::orderBy('id','ASC')->get();
          $periodo = Periodo::find($request->input('periodo'));

          return view('ingresos.mensual')
          ->with('ingresos', $ingresos)
          ->with('periodos', $periodos)
          ->with('periodo', $periodo);


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
}
