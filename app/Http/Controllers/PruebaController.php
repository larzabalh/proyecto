<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Prueba;
use App\Gasto;
use App\Tipo_de_gasto;

class PruebaController extends Controller
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

public function listar()
    {

      $gastos =DB::table('gastos')
          ->select('gastos.id','gastos.gasto','gastos.condicion','tipos_de_gastos.tipo','tipos_de_gastos.id as id_tipo','users.name')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
           ->get();

        return response()->json(["data"=> $gastos->toArray()]);
    }



    public function index()
    {
       $tipos = Tipo_de_gasto::all();
        
        return view('pruebas.prueba')->with('tipos', $tipos);;
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
      $gasto = new Gasto([
        'gasto' => $request->input('gasto'),
        'tipo_de_gasto_id' => $request->input('tipo'),
        'user_id' => auth()->user()->id,
      ]);
      $gasto->save();
      // return redirect()->route('gasto.index');
      return response()->json(["data"=> $gasto->toArray()]);
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
