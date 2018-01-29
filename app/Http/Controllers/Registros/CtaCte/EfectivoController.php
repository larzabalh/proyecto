<?php

namespace App\Http\Controllers;

use App\efectivo;
use Illuminate\Http\Request;

class EfectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       


       return view('registros.CtaCte.efectivo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar()
    {
        $caja = efectivo::where('user_id',auth()->user()->id)->get();;
        
        return response()->json(["data"=> $caja->toArray()]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $caja = new efectivo([
        'nombre' => $request->input('nombre'),
        'importe' => 0,
        'user_id' => auth()->user()->id,
      ]);
      $caja->save();
      return response()->json(["data"=> $caja->toArray()]);
    }

    public function eliminar($id)
    {
      $tipo = efectivo::find($id);
      $tipo->delete();
      return response()->json(["data" => $tipo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\efectivo  $efectivo
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request, $id)
    {
      $caja = efectivo::find($id);
      $caja->nombre =  $request['nombre'];
      $caja->save();

      return response()->json(["data" => $caja]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\efectivo  $efectivo
     * @return \Illuminate\Http\Response
     */
    public function edit(efectivo $efectivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\efectivo  $efectivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, efectivo $efectivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\efectivo  $efectivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(efectivo $efectivo)
    {
        //
    }
}
