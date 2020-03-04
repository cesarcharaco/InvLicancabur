<?php

namespace App\Http\Controllers;

use App\Incidencias;
use App\Insumos;
use App\Gerencias;
use App\HistorialIncidencias;
use App\Areas;
use Illuminate\Http\Request;

date_default_timezone_set('UTC');
ini_set('max_execution_time', 900);
set_time_limit(900);

class IncidenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidencias=\DB::table('insumos')->join('incidencias','incidencias.id_insumo','=','insumos.id')->select('insumos.producto','insumos.descripcion','insumos.serial','incidencias.tipo','incidencias.fecha_incidencia','incidencias.cantidad','incidencias.id')->get();
        //dd($incidencias);
        return view('inventario.incidencias.index',compact('incidencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $gerencias=Gerencias::all();
        $insumos=Insumos::where('id_gerencia',1)->get();
        $hoy=date('Y-m-d');
        return view('inventario.incidencias.create',compact('gerencias','insumos','hoy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        if ($request->id_gerencia==null) {
            flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar una Gerencia!')->warning()->important();
            return redirect()->back();
        } else {
            if ($request->id_insumo==null) {
            flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar un Insumo!')->warning()->important();
            return redirect()->back();
            } else {
                if ($request->fecha_incidencia==null) {
                flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar una fecha en la que ocurrió!')->warning()->important();
                return redirect()->back();
                } else {
                    $disponible=$this->buscar_existencia($request->id_insumo);
                    if ($request->cantidad>$disponible) {
                        flash('<i class="fa fa-check-circle-o"></i> La Cantidad a solicitar no puede ser mayor a la disponible del insumo seleccionado!')->warning()->important();
                        return redirect()->back();
                    } else {
                        //generando y buscando codigo
                        $buscar="";
                        do{
                            $codigo=$this->generarCodigo();
                            $buscar_codigo=HistorialIncidencias::where('codigo',$codigo)->first();
                            if($buscar_codigo!==null){
                                $buscar=$buscar_codigo->codigo;
                            }
                        }while($codigo==$buscar);
                        //--- fin de la generacion y busqueda de codigo
                        
                                //actualizando existencias
                                $insumo=Insumos::find($request->id_insumo);
                                $insumo->in_almacen=$insumo->in_almacen-$request->cantidad;
                                $insumo->disponibles=$insumo->disponibles-$request->cantidad;

                            if ($request->tipo=="En Reparación") {

                                $insumo->en_reparacion=$insumo->en_reparacion+$request->cantidad;
                                $insumo->save();
                            }else{
                                $insumo->entregados=$insumo->inservible+$request->cantidad;
                                $insumo->existencia=$insumo->existencia-$request->cantidad;
                                $insumo->save();
                            }
                            //registrando incidencia
                                $incidencia=new Incidencias();
                                $incidencia->id_insumo=$request->id_insumo;
                                $incidencia->cantidad=$request->cantidad;
                                $incidencia->tipo=$request->tipo;
                                $incidencia->observacion=$request->observacion;
                                $incidencia->fecha_incidencia=$request->fecha_incidencia;
                                $incidencia->save();
                                //guardando en historial
                                $historial=new HistorialIncidencias();
                                $historial->id_incidencia=$incidencia->id;
                                $historial->codigo=$codigo;
                                $historial->save();
                                //---------------------
                        

                        if ($request->tipo=="En Reparación") {
                        flash('<i class="fa fa-check-circle-o"></i> Insumo(s) registrado EN REPARACIÓN exitosamente!')->warning()->important();
                        return redirect()->to('incidencias');
                        } else {
                            flash('<i class="fa fa-check-circle-o"></i> Insumo(s) registrado INSERVIBLE exitosamente!')->warning()->important();
                            return redirect()->to('incidencias');
                        }
                    }
                    
                }
            }    
        }       
    }//fin de la funcion store

    /**
     * Display the specified resource.
     *
     * @param  \App\Incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencias $incidencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function edit($id_incidencia)
    {
        $incidencia=Incidencias::find($id_incidencia);
        $gerencias=Gerencias::all();
        $insumos=Insumos::where('id_gerencia',$incidencia->insumos->id_gerencia)->get();
        $hoy=date('Y-m-d');
        return view('inventario.incidencias.edit',compact('gerencias','insumos','hoy','incidencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_incidencia)
    {
        if ($request->id_gerencia==null) {
            flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar una Gerencia!')->warning()->important();
            return redirect()->back();
        } else {
            if ($request->id_insumo==null) {
            flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar un Insumo!')->warning()->important();
            return redirect()->back();
            } else {
                if ($request->fecha_incidencia==null) {
                flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar una fecha en la que ocurrió!')->warning()->important();
                return redirect()->back();
                } else {
                    $disponible=$this->buscar_existencia($request->id_insumo);
                    if ($request->cantidad>$disponible) {
                        flash('<i class="fa fa-check-circle-o"></i> La Cantidad a solicitar no puede ser mayor a la disponible del insumo seleccionado!')->warning()->important();
                        return redirect()->back();
                    } else {

                            $incidencia=Incidencias::find($id_incidencia);
                                //devolviendo cambios de incidencias
                                $insumo=Insumos::find($incidencia->id_insumo);
                                $insumo->in_almacen=$insumo->in_almacen+$incidencia->cantidad;
                                $insumo->disponibles=$insumo->disponibles+$incidencia->cantidad;

                                if ($incidencia->tipo=="En Reparación") {
                                    $insumo->en_reparacion=$insumo->en_reparacion-$incidencia->cantidad;
                                    $insumo->save();
                                }else{
                                    $insumo->inservible=$insumo->inservible-$incidencia->cantidad;
                                    $insumo->existencia=$insumo->existencia+$incidencia->cantidad;
                                    $insumo->save();
                                }

                                //--------------------------------------
                                //actualizando existencias
                                $insumo=Insumos::find($request->id_insumo);
                                $insumo->in_almacen=$insumo->in_almacen-$request->cantidad;
                                $insumo->disponibles=$insumo->disponibles-$request->cantidad;

                            if ($request->tipo=="En Reparación") {

                                $insumo->en_reparacion=$insumo->en_reparacion+$request->cantidad;
                                $insumo->save();
                            }else{
                                $insumo->inservible=$insumo->inservible+$request->cantidad;
                                $insumo->existencia=$insumo->existencia-$request->cantidad;
                                $insumo->save();
                            }
                            //actualizando incidencia
                                
                                $incidencia->id_insumo=$request->id_insumo;
                                $incidencia->cantidad=$request->cantidad;
                                $incidencia->tipo=$request->tipo;
                                $incidencia->observacion=$request->observacion;
                                $incidencia->fecha_incidencia=$request->fecha_incidencia;
                                $incidencia->save();
                                
                        if ($request->tipo=="En Reparación") {
                        flash('<i class="fa fa-check-circle-o"></i> Insumo(s) actualizado EN REPARACIÓN exitosamente!')->warning()->important();
                        return redirect()->to('incidencias');
                        } else {
                            flash('<i class="fa fa-check-circle-o"></i> Insumo(s) actualizado INSERVIBLE exitosamente!')->warning()->important();
                            return redirect()->to('incidencias');
                        }
                    }
                    
                }
            }    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        //dd($request->all());
        $incidencia=Incidencias::find($request->id_incidencia);
        //dd($incidencia);
        $historial=HistorialIncidencias::where('id_incidencia',$request->id_incidencia)->first();
        //dd($historial);
                    
                $cantidad=$incidencia->cantidad;
                $tipo=$incidencia->tipo;
                //echo $key->id_incidencia."<br>";
                  //actualizando existencias
                $insumo=Insumos::find($incidencia->id_insumo);
                $insumo->in_almacen=$insumo->in_almacen+$cantidad;
                $insumo->disponibles=$insumo->disponibles+$cantidad;

                if ($tipo=="En Reparación") {

                $insumo->en_reparacion=$insumo->en_reparacion-$cantidad;
                    $insumo->save();
                }else{
                    $insumo->inservible=$insumo->inservible-$cantidad;
                    $insumo->existencia=$insumo->existencia+$cantidad;
                    $insumo->save();
                }
            
            $incidencia->delete();
            if($historial!==null){
            $historial->delete();
            }
            
        
        flash('<i class="fa fa-check-circle-o"></i> Incidencia Eliminada exitosamente!')->warning()->important();
        return redirect()->back();
    }

    protected function generarCodigo() {
     $key = '';
     $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $max = strlen($pattern)-1;
     for($i=0;$i < 4;$i++) $key .= $pattern{mt_rand(0,$max)};
     return $key;
    }

    public function historial()
    {
        //\DB::select('SET @@sql_mode=""');
        $historial=HistorialIncidencias::select('codigo','id','created_at',\DB::raw('codigo'))->where('id','>',0)->groupBy('codigo')->orderBy('id','DESC')->get();

        return view('inventario.incidencias.historial',compact('historial'));
    }

    public function deshacer_incidencia(Request $request)
    {
        //dd($request->all());
        $historial=HistorialIncidencias::where('codigo',$request->codigo)->get();
        //dd($historial);
        foreach ($historial as $key) {
            
                $cantidad=$key->incidencias->cantidad;
                $tipo=$key->incidencias->tipo;
                //echo $key->id_incidencia."<br>";
                  //actualizando existencias
                $insumo=Insumos::find($key->incidencias->id_insumo);
                $insumo->in_almacen=$insumo->in_almacen+$cantidad;
                $insumo->disponibles=$insumo->disponibles+$cantidad;

                if ($tipo=="En Reparación") {
                    $insumo->en_reparacion=$insumo->en_reparacion-$cantidad;
                    $insumo->save();
                }else{
                    $insumo->inservible=$insumo->inservible-$cantidad;
                    $insumo->existencia=$insumo->existencia+$cantidad;
                    $insumo->save();
                }
            $incidencia=Incidencias::find($key->id_incidencia);
            $incidencia->delete();
            $key->delete();
            
        }
        flash('<i class="fa fa-check-circle-o"></i> Incidencia deshecha exitosamente!')->warning()->important();
        return redirect()->back();

    }

    public function buscar_existencia($id_insumo)
    {
        $insumo=Insumos::find($id_insumo);
        return $insumo->disponibles;
    }
}
