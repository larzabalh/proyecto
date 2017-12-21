<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Reg_Gasto;
use App\Gasto;
use App\Tipo_de_gasto;
use App\Http\Requests\GastosRequest;
use Carbon\Carbon;

class RegistrodeGastosController extends Controller
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



        // $reg_gastos =Reg_Gasto::comentario($request->get('fecha'))->get();
/*        $periodos = Reg_Gasto::periodos()
                    ->select('fecha','gasto_id')
                    ->get()
                    ->groupBy(function($val) {
                      return Carbon::parse($val->fecha)->format('Y-m');
                    });*/

            /*->where('importe',"LIKE",'%'.$request->input('importe_buscar').'%')
            ->where('gastos.id',"LIKE",'%'.$request->input('gasto_buscar').'%')
            ->where('tipos_de_gastos.id',"LIKE",'%'.$request->input('tipo_buscar').'%')*/

        $reg_gastos =DB::table('reg_gastos')
          ->select(
            DB::raw("concat(tipos_de_gastos.tipo,'-',gastos.gasto)as concepto"),
            DB::raw("concat(medios.nombre,'-',disponibilidades.nombre,'-',forma_de_pagos.nombre)as caja"),
            'reg_gastos.id','reg_gastos.fecha','reg_gastos.gasto_id','reg_gastos.forma_de_pagos_id','reg_gastos.importe','reg_gastos.comentario')
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->get();

          



        return view('registros.gastos')
        ->with('reg_gastos', $reg_gastos)
        ->with('gastos', $gastos)
        ->with('tipos', $tipos)
        ->with('periodos', $periodos);
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

      $reg_gastos = new Reg_Gasto([
        'fecha' => $request->input('fecha'),
        'gasto_id' => $request->input('gasto'),
        // 'tipo_de_gasto_id' => $gasto->tipo_de_gasto_id,
        'importe' => $request->input('importe'),
        'comentario' => $request->input('comentario')

      ]);
      $reg_gastos->save();
      return redirect()->route('registrodegastos.index');
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
      $reg_gasto = Reg_Gasto::find($id);
      $gastos = Gasto::all();
      return view('registros.gasto_edit')
      ->with('reg_gasto', $reg_gasto)
      ->with('gastos', $gastos);
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


      $reg_gasto = Reg_Gasto::find($id);
      $reg_gasto->fecha = $request->input('fecha');
      $reg_gasto->gasto_id = $request->input('gasto');
      $reg_gasto->importe = $request->input('importe');
      $reg_gasto->comentario = $request->input('comentario');

      $reg_gasto->save();
      return redirect()->route('registrodegastos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $reg_gasto = Reg_Gasto::find($id);
      $reg_gasto->delete();
      return redirect()->route('registrodegastos.index');
    }
}
