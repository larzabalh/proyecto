<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reg_Gasto;
use App\Forma_de_Pagos;
use App\Gasto;

class HomeController extends Controller
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

        return view('home')->with('periodos',$periodos);
    }

    public function listar($periodo)
    {

    $array = explode('-', $periodo);

        $mediosdepagosGastos =DB::table('reg_gastos')
          ->select(DB::raw("concat(medios.nombre,'-',forma_de_pagos.nombre)as banco"),DB::raw('sum(reg_gastos.importe) as importe'))
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
          ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
          ->groupBy('banco')
          ->get();

        $detalleGastos =DB::table('reg_gastos')
          ->select('gastos.gasto',DB::raw('sum(reg_gastos.importe) as importe'))
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
          ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
          ->groupBy('gastos.gasto')
          ->get();

        $GastosPagados =DB::table('reg_gastos')
          ->select('gastos.gasto',DB::raw('sum(reg_gastos.importe) as importe'))
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('reg_gastos.pagado'),'=', 1 )
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
          ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
          ->groupBy('gastos.gasto')
          ->get();

        $GastosImpagos =DB::table('reg_gastos')
          ->select('gastos.gasto',DB::raw('sum(reg_gastos.importe) as importe'))
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('reg_gastos.pagado'),'=', null )
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
          ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
          ->groupBy('gastos.gasto')
          ->get();


      $tiposGastos =DB::table('reg_gastos')
          ->select('tipos_de_gastos.tipo',DB::raw('sum(reg_gastos.importe) as importe'))
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
          ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
          ->groupBy('tipos_de_gastos.tipo')
          ->get();

      $reg_gastos =DB::table('reg_gastos')
          ->select(
            'tipos_de_gastos.tipo','gastos.gasto',DB::raw('sum(reg_gastos.importe) as importe'))
          ->join('gastos', 'reg_gastos.gasto_id', '=', 'gastos.id')
          ->join('forma_de_pagos', 'reg_gastos.forma_de_pagos_id', '=', 'forma_de_pagos.id')
          ->join('disponibilidades', 'forma_de_pagos.disponibilidad_id', '=', 'disponibilidades.id')
          ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
          ->join('tipos_de_gastos', 'gastos.tipo_de_gasto_id', '=', 'tipos_de_gastos.id')
          ->join('users', 'gastos.user_id', '=', 'users.id')
          ->where(DB::raw('users.id'),auth()->user()->id )
          ->where(DB::raw('year(reg_gastos.fecha)'), $array[0])
          ->where(DB::raw('month(reg_gastos.fecha)'), $array[1])
          ->groupBy('gastos.gasto','tipos_de_gastos.tipo')
          ->get();

      $ingresos_todos =DB::table('cta_cte_clientes')
            ->select('clientes.cliente',DB::raw('sum(cta_cte_clientes.debe) as debe'))
            ->join('users', 'cta_cte_clientes.user_id', '=', 'users.id')
            ->join('clientes', 'cta_cte_clientes.cliente_id', '=', 'clientes.id')
            ->where(DB::raw('cta_cte_clientes.user_id'),auth()->user()->id )
            ->where(DB::raw('year(cta_cte_clientes.fecha)'), $array[0])
            ->where(DB::raw('month(cta_cte_clientes.fecha)'), $array[1])
            ->groupBy('clientes.cliente')
            ->orderBy('clientes.cliente','asc')
            ->get();

      $ingresos_impagos =DB::table('cta_cte_clientes')
            ->select('clientes.cliente',DB::raw('sum(cta_cte_clientes.debe - cta_cte_clientes.haber) as deuda'))
            ->join('users', 'cta_cte_clientes.user_id', '=', 'users.id')
            ->join('clientes', 'cta_cte_clientes.cliente_id', '=', 'clientes.id')
            ->where(DB::raw('cta_cte_clientes.user_id'),auth()->user()->id )
            ->where(DB::raw('year(cta_cte_clientes.fecha)'), $array[0])
            ->where(DB::raw('month(cta_cte_clientes.fecha)'), $array[1])
            ->groupBy('clientes.cliente')
            ->orderBy('clientes.cliente','asc')
            ->get();

      $saldosBancarios =DB::table('cta_cte_disponibilidades')
            ->select(
                    DB::raw("concat(medios.nombre,'-',disponibilidades.nombre)as banco"),
                    DB::raw('sum(cta_cte_disponibilidades.debe - cta_cte_disponibilidades.haber) as saldo'))
            ->join('users', 'cta_cte_disponibilidades.user_id', '=', 'users.id')
            ->join('disponibilidades', 'cta_cte_disponibilidades.disponibilidad_id', '=', 'disponibilidades.id')
            ->join('medios', 'disponibilidades.medio_id', '=', 'medios.id')
            ->where(DB::raw('cta_cte_disponibilidades.user_id'),auth()->user()->id )
            ->groupBy('banco')
            ->orderBy('banco','asc')
            ->get();

        return response()->json([
                                "reg_gastos"=>$reg_gastos->toArray(),
                                "detalleGastos"=>$detalleGastos->toArray(),
                                "tiposGastos"=>$tiposGastos->toArray(),
                                "mediosdepagosGastos"=>$mediosdepagosGastos->toArray(),
                                "GastosPagados"=>$GastosPagados->toArray(),
                                "GastosImpagos"=>$GastosImpagos->toArray(),
                                "ingresos_todos"=>$ingresos_todos->toArray(),
                                "ingresos_impagos"=>$ingresos_impagos->toArray(),
                                "saldosBancarios"=>$saldosBancarios->toArray(),
                                ]);
    }

    public function store(Request $request)
    {
      $reg_gastos = new Reg_Gasto([
        'fecha' => $request->input('fecha'),
        'gasto_id' => $request->input('gasto_id'),
        'forma_de_pagos_id' => $request->input('forma_de_pagos_id'),
        'importe' => $request->input('importe'),
        'comentario' => $request->input('comentario'),
        'user_id' => auth()->user()->id,
      ]);
      $reg_gastos->save();

    /*  $reg_gastos ='ok';*/

      return response()->json(["data"=> $reg_gastos->toArray()]);
    }

    public function editar(Request $request, $id)
    {
      $reg_gastos = Reg_Gasto::find($id);
      $reg_gastos->fecha =  $request['fecha'];
      $reg_gastos->gasto_id =  $request['gasto_id'];
      $reg_gastos->forma_de_pagos_id =  $request['forma_de_pagos_id'];
      $reg_gastos->importe =  $request['importe'];
      $reg_gastos->comentario =  $request['comentario'];

      $reg_gastos->save();

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