<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Prueba;
use App\Gasto;
use App\Tipo_de_gasto;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function select_tipo(Request $request, $id)
     {
       // $reg_gastos =DB::table('reg_gastos')
       //     ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
       //     ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
       //     ->where('gastos.tipo_de_gasto_id','=',$id)
       //     // ->where('importe',"LIKE",'%'.$request->input('importe_buscar').'%')
       //     // ->where('gastos.id',"LIKE",'%'.$request->input('gasto_buscar').'%')
       //     // ->where('tipos_de_gastos.id',"LIKE",'%'.$request->input('tipo_buscar').'%')
       //     ->select('reg_gastos.*','gastos.gasto','tipos_de_gastos.tipo')
       //     ->get();
       //     dd($reg_gastos);

           $reg_gastos =DB::table('reg_gastos')
               ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
               ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
               ->where('gastos.tipo_de_gasto_id','=',$id)
               ->select('reg_gastos.importe','gastos.gasto','gastos.tipo_de_gasto_id','tipos_de_gastos.tipo')
               ->groupBy('gastos.gasto')
               ->get();
               dd($reg_gastos);


        // $tipos = Tipo_de_gasto::where('id','=',$id)->get();
        return response()->json($reg_gastos);

        }



    public function index()
    {


      // $gastos = Gasto::all();
      // dd($gastos);
      $tipos = Tipo_de_gasto::all();
        return view('pruebas.prueba', ['tipos' => $tipos]);

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
      if ($request->ajax()){

        Prueba::create($request->all());

        return response()->json([
          "mensaje" => "creado"
          ]);
        }

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
