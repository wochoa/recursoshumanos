<?php

namespace App\Http\Controllers;

use App\Models\Reginicidencias;
use Illuminate\Http\Request;

class ReginicidenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fechaini= date("Y-m-d", strtotime($request->fechaini));
        $fechafin= date("Y-m-d", strtotime($request->fechafin));
        $where=[];
        if ($request->incidencias <> '')
            $where[] = ['incidencias', 'LIKE' ,'%'.strtoupper($request->incidencias).'%'];

        if($request->fechaini <> '' and $request->fechafin <> '')
        {
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=Reginicidencias::where($where)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha','desc')->paginate(10);
            }
            else{
                $datos=Reginicidencias::whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha','desc')->paginate(10);
            }
        }
        else{
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=Reginicidencias::where($where)->orderBy('fecha','desc')->paginate(10);
            }
            else{
                $datos=Reginicidencias::orderBy('fecha','desc')->paginate(10);
            }
        }

        return $datos;
    }

    public function pdf(Request $request)
    {

        $fechaini= date("Y-m-d", strtotime($request->fechaini));
        $fechafin= date("Y-m-d", strtotime($request->fechafin));
        $where=[];
        if ($request->incidencias <> '')
        $where[] = ['incidencias', 'LIKE' ,'%'.strtoupper($request->incidencias).'%'];

        if($request->fechaini <> '' and $request->fechafin <> '')
        {
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=Reginicidencias::select('id','incidencias','fecha','hora','sectores')->where($where)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha','desc')->get();
            }
            else{
                $datos=Reginicidencias::select('id','incidencias','fecha','hora','sectores')->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha','desc')->get();
            }
        }
        else{
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=Reginicidencias::select('id','incidencias','fecha','hora','sectores')->where($where)->orderBy('fecha','desc')->get();
            }
            else{
                $datos=Reginicidencias::select('id','incidencias','fecha','hora','sectores')->orderBy('fecha','desc')->get();
            }
        }
        //dowlandpdf
        
        // $pdf = Pdf::loadView('dowlandpdf', compact('datos'));
        // $pdf->setPaper('A4', 'landscape');
        // //  return $pdf->stream();
        // return $pdf->output();
        return $datos;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reginicidencias $reginicidencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reginicidencias $reginicidencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reginicidencias $reginicidencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reginicidencias $reginicidencias)
    {
        //
    }
}
