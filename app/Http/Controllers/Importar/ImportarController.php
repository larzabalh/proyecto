<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Medios;
use App\Http\Controllers\Controller;
use Excel;

class ImportarController extends Controller
{

    function __construct()
      {
          $this->middleware('auth');
      }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('importar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liquidador(Request $request)
    {
       $archivo = $request->file('archivo');
       $nombre_original=$archivo->getClientOriginalName();
       $extension=$archivo->getClientOriginalExtension();
       $r1=Storage::disk('archivos')->put($nombre_original,  \File::get($archivo) );
       $ruta  =  storage_path('archivos') ."/". $nombre_original;
       
       if($r1){
            $ct=0;
            Excel::selectSheetsByIndex(0)->load($ruta, function($hoja) {
                $hoja->each(function($fila) {
                   
                        $medios=new Medios;
                        $medios->user_id= 1;
                        $medios->nombre= $fila->nombre;
                        $medios->save();
                });
            });

            return response()->json(["data"=> "TERMINADO"]);
        
       }
       else
       {
            return response()->json(["data"=> 'Error al subir el archivo']);
            
       }

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
