<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insumos;
use App\Gerencias;
use App\User;
use App\Incidencias;
use App\Prestamos;
use PDF;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha_actual=date('Y-m-d');
        $gerencias=Gerencias::all();
        return view('graficas.index', compact('fecha_actual','gerencias'));
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
        // dd($request->all());
        $gerencia=Gerencias::find($request->id_gerencia);
        $prestamos=Prestamos::whereBetween('fecha_prestamo',[$request->desde,$request->hasta])->get();
        $incidencias=Incidencias::where('id','<>',0)->whereBetween('fecha_incidencia',[$request->desde,$request->hasta])->get();
        $insumos=Insumos::where('id_gerencia', $request->id_gerencia)->get();


        if ($request->generar == 'PDF') {

            if (count($insumos)==0) {
                flash('<i class="icon-circle-check"></i> ¡No exiten datos para generar reporte PDF!')->error()->important();    
                return redirect()->to('reportes');
            } else {
                $pdf = PDF::loadView('graficas/PDF/reportePDF', array(
                    'gerencia'=>$gerencia,
                    'prestamos'=>$prestamos,
                    'incidencias'=>$incidencias,
                    'insumos'=>$insumos,
                ));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream('Reporte_PDF.pdf');

            }
        }else{
            dd('genera grafica');
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
