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
     public function select_gasto(Request $request, $id)
     {

       $gastos =DB::table('reg_gastos')
           ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
           ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
           ->where('gastos.tipo_de_gasto_id','=',$id)
           ->select('gastos.gasto','gastos.id')
           ->groupBy('gastos.gasto','gastos.id')
            ->get();

        return response()->json($gastos);

        }


public function suma_importe(Request $request, $id)
{

  $suma =DB::table('reg_gastos')
      ->select(DB::raw('sum(reg_gastos.importe) as importe'),'gastos.gasto','gastos.id','tipos_de_gastos.tipo','tipos_de_gastos.id')
      ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
      ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
      ->where('gastos.id','=',$id)
      ->groupBy('gastos.gasto','gastos.id','tipos_de_gastos.tipo','tipos_de_gastos.id')
       ->first();

   return response()->json($suma);

}




    public function index()
    {

      $tipos =DB::table('reg_gastos')
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->select('tipos_de_gastos.tipo','tipos_de_gastos.id')
          ->groupBy('tipos_de_gastos.tipo','tipos_de_gastos.id')
           ->get();

      // $gastos = Gasto::all();
      // dd($gastos);



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
