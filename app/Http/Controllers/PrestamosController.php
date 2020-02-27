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
        //
    }

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
}
