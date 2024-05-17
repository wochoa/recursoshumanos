<?php

namespace App\Http\Controllers;

use App\Models\asistencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datos=$request->all();
        $fechaini= date("d-m-Y", strtotime($request->fechaini));
        $fechafin= date("d-m-Y", strtotime($request->fechafin));
        $where=[];
        if ($request->dni <> '')
            $where[] = ['dni', $request->dni];

        if($request->fechaini <> '' and $request->fechafin <> '')
        {
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=DB::connection('asistencias')->table('biotime')->where($where)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha','desc')->paginate(10);
            }
            else{
                $datos=DB::connection('asistencias')->table('biotime')->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha','desc')->paginate(10);
            }
        }
        else{
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=DB::connection('asistencias')->table('biotime')->where($where)->orderBy('fecha','desc')->paginate(10);
            }
            else{
                $datos=DB::connection('asistencias')->table('biotime')->orderBy('fecha','desc')->paginate(10);
            }
        }

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
    public function show(asistencias $asistencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asistencias $asistencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, asistencias $asistencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asistencias $asistencias)
    {
        //
    }
}
