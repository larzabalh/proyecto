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

        $gastos_mensuales=DB::table('gastos_mensuales')
           ->select('gastos_mensuales.id','gastos_mensuales.gasto_id','gastos.gasto',DB::raw("concat(medios.nombre,'-',forma_de_pagos.nombre)as forma_pago"),'gastos_mensuales.forma_de_pagos_id','gastos_mensuales.importe','gastos_mensuales.comentario','tipos_de_gastos.tipo as tipo','tipos_de_gastos.id as id_tipo')
            ->join('gastos', 'gastos_mensuales.gasto_id', '=', 'gastos.id')
            ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
            ->join('forma_de_pagos', 'gastos_mensuales.forma_de_pagos_id', '=', 'forma_de_pagos.id')
            ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
            ->join('users', 'gastos_mensuales.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id)
            ->orderBy('forma_pago','ASC')
            ->orderBy('gastos.gasto','ASC')
            ->get();

        $importe=DB::table('gastos_mensuales')
           ->select(DB::raw("sum(gastos_mensuales.importe) as importe"),'gastos_mensuales.forma_de_pagos_id')
            ->join('users', 'gastos_mensuales.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id)
            ->groupBy('forma_de_pagos_id')
            ->get();

        $tipos_de_gastos =DB::table('tipos_de_gastos')
          ->select('tipos_de_gastos.*')
          ->join('users', 'tipos_de_gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->orderBy('tipos_de_gastos.tipo','ASC')
          ->get();

          /*dd($gastos_mensuales);*/


        return view('registros.egresos.egresosMasivos')
                    ->with('gastos_mensuales', $gastos_mensuales)
                    ->with('importe', $importe)
                    ->with('tipos_de_gastos', $tipos_de_gastos);
    }

    public function listar()
    {
      $gastos_mensuales=DB::table('gastos_mensuales')
           ->select('gastos_mensuales.id','gastos_mensuales.gasto_id','gastos.gasto',DB::raw("concat(medios.nombre,'-',forma_de_pagos.nombre)as forma_pago"),'gastos_mensuales.forma_de_pagos_id','gastos_mensuales.importe','gastos_mensuales.comentario')
            ->join('gastos', 'gastos_mensuales.gasto_id', '=', 'gastos.id')
            ->join('forma_de_pagos', 'gastos_mensuales.forma_de_pagos_id', '=', 'forma_de_pagos.id')
            ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
            ->join('users', 'gastos_mensuales.user_id', '=', 'users.id')
            ->where(DB::raw('users.id'),auth()->user()->id)
            ->orderBy('forma_pago','ASC')
            ->orderBy('gastos.gasto','ASC')
            ->get();


        return response()->json(["data"=>$gastos_mensuales->toArray()]);
    }

    public function verificarUnSoloEgresoMasivo(Request $request)
    {

        $fecha = $request->fecha;    

        $array = explode('-', $fecha);
        $verificar =DB::table('reg_gastos')
          ->select('masivo',
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("count(*) as cantidad")
                  )          
          ->where(DB::raw('user_id'),auth()->user()->id )
          ->where(DB::raw('year(fecha)'), $array[0])
          ->where(DB::raw('month(fecha)'), $array[1])
          ->where(DB::raw('masivo'),'=',1)
          ->groupBy('masivo')
          ->groupBy('fecha')
          ->get();
        
      return response()->json(["data"=>$verificar->toArray()]);
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
         $lstData=$request->data;
        $fecha = $request->fecha;    

        For($i=0; $i<count($lstData);$i++){
        $datos = $lstData[$i];
        $gasto_id=$datos['gasto_id'];
        $forma_de_pagos_id=$datos['forma_de_pagos_id'];
        $importe=$datos['importe'];
        $comentarios=$datos['comentarios'];

        if ($importe!=0) {//esto lo hago para no ingresar los registros con importe $0
            
            $Reg_Gasto = new Reg_Gasto([
                    'fecha' =>$fecha,
                    'gasto_id' =>$gasto_id,
                    'forma_de_pagos_id' =>$forma_de_pagos_id,
                    'importe' => $importe,
                    'comentario' => $comentarios,
                    'user_id' => auth()->user()->id,
                    'masivo' => 1,
                  ]);
             $Reg_Gasto->save();
            
            }

        }
      return response()->json(["data"=>$Reg_Gasto->toArray()]);
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
