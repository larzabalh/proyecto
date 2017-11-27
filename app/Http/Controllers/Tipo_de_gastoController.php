<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_de_gasto;

class Tipo_de_gastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tipo = Tipo_de_gasto::all();
        return view('configuracion.tipos_de_gastos', ['tipo' => $tipo]);
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
      $tipo = new Tipo_de_gasto([
        'tipo' => $request->input('tipo')
      ]);
      $tipo->save();
      return redirect()->route('tipos_de_gastos.index');
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
      $tipo = Tipo_de_gasto::find($id);
      return view('configuracion.tipos_de_gastos-editar')->with('tipo', $tipo);
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
      $tipo = Tipo_de_gasto::find($id);
      $tipo->tipo = $request->input('tipo');

      $tipo->save();

        return redirect()->route('tipos_de_gastos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tipo = Tipo_de_gasto::find($id);
      $tipo->delete();
      return redirect()->route('tipos_de_gastos.index');
    }
}
