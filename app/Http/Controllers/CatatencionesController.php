<?php

namespace App\Http\Controllers;

use App\Models\Catatenciones;
use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Dependencia;

class CatatencionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $idoficina=auth()->user()->depe_id;
       $iddepe=Dependencia::where('iddependencia',$idoficina)->value('depe_depende');
       $catatenciones=Catatenciones::where('idejecutora',$iddepe)->get();
       return response()->json($catatenciones);
    
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
    public function show(Catatenciones $catatenciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catatenciones $catatenciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catatenciones $catatenciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catatenciones $catatenciones)
    {
        //
    }
}
