<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reg_Gasto;
use App\Forma_de_Pagos;
use App\Gasto;
use App\cta_cte_disponibilidades;

class egresosMasivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$forma_pagos =DB::table('forma_de_pagos')
          ->select(DB::raw("distinct(concat(medios.nombre,'-',forma_de_pagos.nombre))as nombre"),'forma_de_pagos.id','forma_de_pagos.disponibilidad_id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'forma_de_pagos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->orderBy('nombre','ASC')
          ->get();

        $forma_pagos =DB::table('gastos')
          ->select('gastos.*','tipos_de_gastos.tipo')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->get();*/

        $gastos_mensuales=DB::table('gastos_mensuales')
           ->select('gastos_mensuales.gasto_id','gastos.gasto','forma_de_pagos.nombre as forma_pago','gastos_mensuales.forma_de_pagos_id')
            ->join('gastos', 'gastos_mensuales.gasto_id', '=', 'gastos.id')
            ->join('forma_de_pagos', 'gastos_mensuales.forma_de_pagos_id', '=', 'forma_de_pagos.id')
            ->join('users', 'gastos_mensuales.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->groupBy('gasto_id')
            ->groupBy('gasto')
            ->groupBy('forma_de_pagos_id')
            ->groupBy('forma_pago')
            ->orderBy('forma_pago','ASC')
            ->orderBy('gastos.gasto','ASC')
            ->orderBy('forma_de_pagos.nombre','ASC')
            ->get();

  /*      dd($gastos_mensuales);*/

        $forma_pagos=DB::table('gastos_mensuales')
            ->select(DB::raw("distinct(forma_de_pagos.nombre)as forma_de_pago"), 'gastos_mensuales.forma_de_pagos_id')
            ->join('forma_de_pagos', 'gastos_mensuales.forma_de_pagos_id', '=', 'forma_de_pagos.id')
            ->join('users', 'gastos_mensuales.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->orderBy('forma_de_pagos.nombre','ASC')
            ->get();

        $gastos=DB::table('gastos_mensuales')
            ->select(DB::raw("distinct(gastos.gasto)as gasto"), 'gastos_mensuales.gasto_id')
            ->join('gastos', 'gastos_mensuales.gasto_id', '=', 'gastos.id')
            ->join('users', 'gastos_mensuales.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id )
            ->orderBy('gastos.gasto','ASC')
            ->get();

        $tipos_de_gastos =DB::table('tipos_de_gastos')
          ->select('tipos_de_gastos.*')
          ->join('users', 'tipos_de_gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->orderBy('tipos_de_gastos.tipo','ASC')
          ->get();


        return view('registros.egresos.egresosMasivos')
                    ->with('forma_pagos', $forma_pagos)
                    ->with('gastos', $gastos)
                    ->with('gastos_mensuales', $gastos_mensuales)
                    ->with('tipos_de_gastos', $tipos_de_gastos);
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
