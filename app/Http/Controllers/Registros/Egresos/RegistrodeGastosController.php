<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Reg_Gasto;
use App\Forma_de_Pagos;
use App\Gasto;
use App\cta_cte_disponibilidades;

class RegistrodeGastosController extends Controller
{
  

    function __construct()
  {
      $this->middleware('auth');
  }
    /**

     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response     */
    public function index()
    {

      $periodos =DB::table('reg_gastos')
       ->select(DB::raw("distinct (concat(year(fecha), '-', month(fecha))) as fecha"))
       ->orderby('fecha','ASC')
        ->get();

      $gasto =DB::table('gastos')
          
          ->select('gastos.id','gastos.gasto')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->get();

      $forma_pagos =DB::table('forma_de_pagos')
          ->select(DB::raw("distinct(concat(medios.nombre,'-',forma_de_pagos.nombre))as forma_pagos"), 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'forma_de_pagos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->orderBy('forma_pagos','ASC')
          ->get();



        return view('registros.egresos.egresosIndividuales')
        ->with('gasto', $gasto)
        ->with('periodos',$periodos)
        ->with('forma_pagos', $forma_pagos);

    }

    public function listar($periodo,$gasto_filtro=null,$pagado=null)
    {

      $gasto_filtro = ($gasto_filtro==0) ? $gasto_filtro=null : $gasto_filtro;
      $pagado = ($pagado==0) ? $pagado=null : $pagado;
      $array = explode('-', $periodo);
      $reg_gastos =DB::table('reg_gastos')
          ->select(
            /*DB::raw("concat(tipos_de_gastos.tipo,'-',gastos.gasto)as concepto"),*/
            DB::raw("concat(medios.nombre,'-',forma_de_pagos.nombre)as caja"),
            DB::raw("concat(year(fecha), '-', month(fecha)) as periodo"),
            DB::raw("CAST(fecha AS DATE) as fecha"),
            'tipos_de_gastos.tipo','gastos.gasto','reg_gastos.id','reg_gastos.gasto_id','reg_gastos.forma_de_pagos_id','reg_gastos.importe','reg_gastos.comentario','reg_gastos.pagado')
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
          ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
          ->where(DB::raw('reg_gastos.forma_de_pagos_id'),'LIKE',$gasto_filtro)
          ->where('reg_gastos.pagado',"=",$pagado)
          ->get();

        return response()->json(["data"=>$reg_gastos->toArray()]);
    }

    public function store(Request $request)
    {
      $reg_gastos = new Reg_Gasto([
        'fecha' => $request->input('fecha'),
        'gasto_id' => $request->input('gasto_id'),
        'forma_de_pagos_id' => $request->input('forma_de_pagos_id'),
        'importe' => $request->input('importe'),
        'pagado' => $request->input('pagado'),
        'comentario' => $request->input('comentario'),
        'user_id' => auth()->user()->id,
      ]);
      $reg_gastos->save();

      if ($request->registrarBanco==1) {
          //1- Busco disponibilidad_id de la forma de pago, para poder registrarlo!!!
          $disponibilidad_id = Forma_de_Pagos::find($request->forma_de_pagos_id);

          //2- Guardo, en la cuenta bancaria que corresponde
          $disponibilidades = new cta_cte_disponibilidades([
                  'fecha' =>$request->fecha,
                  'debe' => 0,
                  'haber' => $request->importe,
                  'disponibilidad_id' =>$disponibilidad_id->disponibilidad_id,//estoy accediendo a la consulta que hice
                  'id_concepto' => $request->gasto_id,
                  'comentario' => $request->comentario,
                  'user_id' => auth()->user()->id,
                ]);
          $disponibilidades->save();
      }

      return response()->json(["data"=> $reg_gastos->toArray()]);
    }

    public function editar(Request $request, $id)
    {
      $reg_gastos = Reg_Gasto::find($id);
      $reg_gastos->fecha =  $request['fecha'];
      $reg_gastos->gasto_id =  $request['gasto_id'];
      $reg_gastos->forma_de_pagos_id =  $request['forma_de_pagos_id'];
      $reg_gastos->importe =  $request['importe'];
      $reg_gastos->pagado =  $request['pagado'];
      $reg_gastos->comentario =  $request['comentario'];

      $reg_gastos->save();

      if ($request->registrarBanco==1) {
          //1- Busco disponibilidad_id de la forma de pago, para poder registrarlo!!!
          $disponibilidad_id = Forma_de_Pagos::find($request->forma_de_pagos_id);

          //2- Guardo, en la cuenta bancaria que corresponde
          $disponibilidades = new cta_cte_disponibilidades([
                  'fecha' =>$request->fecha,
                  'haber' => $request->importe,
                  'disponibilidad_id' =>$disponibilidad_id->disponibilidad_id,//estoy accediendo a la consulta que hice
                  'id_concepto' => $request->gasto_id,
                  'comentario' => $request->comentario,
                  'user_id' => auth()->user()->id,
                ]);
          $disponibilidades->save();
      }

      return response()->json(["data" => $reg_gastos]);
    }

    public function eliminar($id)
    {
      $reg_gastos = Reg_Gasto::find($id);
      $reg_gastos->delete();
      return response()->json(["data" => $reg_gastos]);
    }

    public function eliminar_masivos($ids)

    {
      //Force array
      // $ids = is_array($ids) ? $ids : array($ids);

        foreach ($ids as $id) {
          // dd($key);
          $reg_gastos = Reg_Gasto::find($id);
          $reg_gastos->delete();
      }
        return response()->json(["data" => 'borrados']);
    }

    public function selectCuentas($id)
    {

        $reg_gastos =DB::table('disponibilidades')
          ->select('disponibilidades.id','disponibilidades.nombre','disponibilidades.medio_id','medios.nombre as medio_nombre','users.name')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('users', 'disponibilidades.user_id', '=', 'users.id')
          ->where(DB::raw('medios.id'),'=',$id)
          ->where(DB::raw('users.id'),auth()->user()->id )
           ->get();

        return response()->json(["data"=> $reg_gastos->toArray()]);
    }

}


        