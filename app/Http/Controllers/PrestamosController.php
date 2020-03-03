<?php

namespace App\Http\Controllers;

use App\Prestamos;
use Illuminate\Http\Request;
use App\Solicitantes;
use App\Insumos;
use App\Gerencias;
use App\Areas;
class PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$solicitantes=Solicitantes::all();

        $prestamos=\DB::table('insumos')->join('prestamos','prestamos.id_insumo','=','insumos.id')->join('solicitantes','solicitantes.id','=','prestamos.id_solicitante')->select('solicitantes.nombres','solicitantes.rut','solicitantes.id','insumos.producto','insumos.descripcion','insumos.serial','prestamos.tipo','prestamos.fecha_prestamo','prestamos.fecha_devuelto','prestamos.status','prestamos.cantidad')->get();
        //dd($prestamos);
        return view('inventario.prestamos.index',compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitantes=Solicitantes::where('status','<>','Inactivo')->get();
        $gerencias=Gerencias::all();
        $insumos=Insumos::where('id_gerencia',1)->get();
        $hoy=date('Y-m-d');
        return view('inventario.prestamos.create',compact('solicitantes','gerencias','insumos','hoy'));

    }

    public function buscar_insumos($id_gerencia)
    {
        return $insumos=Insumos::where('id_gerencia',$id_gerencia)->get();
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
        if ($request->todos==null) {
            # para registrar uno o varios solicitantes
            
            if ($request->id_solicitante==null) {
                flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar al menos un Solicitante!')->warning()->important();
                return redirect()->back();
            }else{
                if ($request->id_gerencia==null) {
                    flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar una Gerencia!')->warning()->important();
                    return redirect()->back();
                } else {
                    if ($request->id_insumo==null) {
                    flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar un Insumo!')->warning()->important();
                    return redirect()->back();
                    } else {
                        if ($request->fecha_prestamo==null) {
                        flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar una Gerencia!')->warning()->important();
                        return redirect()->back();
                        } else {
                            $disponible=$this->buscar_existencia($request->id_insumo);
                            if ($request->cantidad>$disponible) {
                                flash('<i class="fa fa-check-circle-o"></i> La Cantidad a solicitar no puede ser mayor a la disponible del insumo seleccionado!')->warning()->important();
                                return redirect()->back();
                            } else {
                                for ($i=0; $i < count($request->id_solicitante) ; $i++) { 
                                        //actualizando existencias
                                        $insumo=Insumos::find($request->id_insumo);
                                        $insumo->in_almacen=$insumo->in_almacen-$request->cantidad;
                                        $insumo->out_almacen=$insumo->out_almacen+$request->cantidad;
                                        $insumo->disponibles=$insumo->disponibles-$request->cantidad;

                                    if ($request->tipo=="Prestar") {
                                        $insumo->save();
                                    }else{
                                        $insumo->entregados=$insumo->entregados+$request->cantidad;
                                        $insumo->existencia=$insumo->existencia-$request->cantidad;
                                        $insumo->save();
                                    }
                                    //registrando prestamo
                                        $prestamo=new Prestamos();
                                        $prestamo->id_solicitante=$request->id_solicitante[$i];
                                        $prestamo->id_insumo=$request->id_insumo;
                                        $prestamo->tipo=$request->tipo;
                                        $prestamo->observacion=$request->observacion;
                                        $prestamo->fecha_prestamo=$request->fecha_prestamo;
                                        if ($request->tipo=="Entregar") {
                                           $prestamo->status="No Aplica";
                                        }
                                        
                                        $prestamo->cantidad=$request->cantidad;
                                        $prestamo->save();                                        
                                }
                                if ($request->tipo=="Prestar") {
                                flash('<i class="fa fa-check-circle-o"></i> Préstamo Realizado exitosamente!')->warning()->important();
                                return redirect()->to('prestamos');
                                } else {
                                    flash('<i class="fa fa-check-circle-o"></i> Entrega Realizada exitosamente!')->warning()->important();
                                    return redirect()->to('prestamos');
                                }
                            }
                            
                        }
                    }    
                }
                
            }
        } else {
            # para registrarlos todos
            if ($request->id_gerencia==null) {
                flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar una Gerencia!')->warning()->important();
                return redirect()->back();
            } else {
                if ($request->id_insumo==null) {
                flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar un Insumo!')->warning()->important();
                return redirect()->back();
                } else {
                    if ($request->fecha_prestamo==null) {
                    flash('<i class="fa fa-check-circle-o"></i> Debe seleccionar una Gerencia!')->warning()->important();
                    return redirect()->back();
                    } else {
                        $disponible=$this->buscar_existencia($request->id_insumo);
                        if ($request->cantidad>$disponible) {
                            flash('<i class="fa fa-check-circle-o"></i> La Cantidad a solicitar no puede ser mayor a la disponible del insumo seleccionado!')->warning()->important();
                            return redirect()->back();
                        } else {
                            $solicitantes=Solicitantes::where('status','Activo')->get();
                            if (count($solicitantes)>0) {
                            
                            foreach ($solicitantes as $key) {
                                    //actualizando existencias
                                    $insumo=Insumos::find($request->id_insumo);
                                    $insumo->in_almacen=$insumo->in_almacen-$request->cantidad;
                                    $insumo->out_almacen=$insumo->out_almacen+$request->cantidad;
                                    $insumo->disponibles=$insumo->disponibles-$request->cantidad;
                                    
                                if ($request->tipo=="Prestar") {
                                    $insumo->save();
                                }else{
                                    $insumo->entregados=$insumo->entregados+$request->cantidad;
                                    $insumo->existencia=$insumo->existencia-$request->cantidad;
                                    $insumo->save();
                                }
                                //registrando prestamo
                                    $prestamo=new Prestamos();
                                    $prestamo->id_solicitante=$key->id;
                                    $prestamo->id_insumo=$request->id_insumo;
                                    $prestamo->tipo=$request->tipo;
                                    $prestamo->observacion=$request->observacion;
                                    $prestamo->fecha_prestamo=$request->fecha_prestamo;
                                    if ($request->tipo=="Entregar") {
                                           $prestamo->status="No Aplica";
                                        }
                                    $prestamo->cantidad=$request->cantidad;
                                    $prestamo->save();                                        
                            }
                            if ($request->tipo=="Prestar") {
                                flash('<i class="fa fa-check-circle-o"></i> Préstamo Realizado exitosamente!')->warning()->important();
                                return redirect()->to('prestamos');
                            } else {
                                flash('<i class="fa fa-check-circle-o"></i> Entrega Realizada exitosamente!')->warning()->important();
                                return redirect()->to('prestamos');
                            }
                                
                            } else {
                                flash('<i class="fa fa-check-circle-o"></i> No existen solicitantes activos registrados!')->warning()->important();
                                return redirect()->back();
                            }
                        }
                        
                    }
                }    
            }
        }//fin del else de todos
    }//fin de la funcion store

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestamos  $prestamos
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamos $prestamos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestamos  $prestamos
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamos $prestamos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestamos  $prestamos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamos $prestamos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestamos  $prestamos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamos $prestamos)
    {
        //
    }

    public function buscar_existencia($id_insumo)
    {
        $insumo=Insumos::find($id_insumo);
        return $insumo->disponibles;
    }
}
