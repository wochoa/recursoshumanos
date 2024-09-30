<?php

namespace App\Http\Controllers;

use App\Models\Licenciaspersonal;
use Illuminate\Http\Request;

class LicenciaspersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fecha_ini=date("Y-m-d", strtotime($request->fecha_ini));
        $fecha_fin=date("Y-m-d", strtotime($request->fecha_fin));
        $pendiente=$request->pendiente;
        $where=[];
        if($request->dni <> '')
            $where[] = ['dni', $request->dni];
        if($request->fecha_ini <> '' and $request->fecha_fin <> '')
            $where[] = ['fecha_ini', $fecha_ini];
        if($request->fecha_fin <> '')
        $where[] = ['fecha_fin', $fecha_fin];

        //->whereBetween('fecha', [$fechaini, $fechafin])

        return Licenciaspersonal::where($where)->with('dependencia')->with('regimen')->orderBy('id','desc')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function idpapeleta(Request $request)
    {
        // return $request->all();
        $datos=Licenciaspersonal::find($request->idpapeleta);
        // $datos=Licenciaspersonal::with('dependencia')->with('regimen')->where('id',$request->idpapeleta)->first();
        return $datos;
    }

    public function updretorno(Request $request)
    {
        $Horasalida=date('H:i:s');
        $busca=Licenciaspersonal::find($request->idpapeleta);
        $busca->hora_retorno=$Horasalida;
        $busca->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addpapaletas(Request $request)
    {
        // return $request->all();
        $fecha=date('Y-m-d');
        $Horasalida=date('H:i:s');

        $datos=$request->all();
        $add=new Licenciaspersonal();
        $add->fill($datos);
        // $add->fecha=$fecha;
        // $add->hora_salida=$Horasalida;

        $add->save();
        // return $request->all();

    }
    public function busqueda(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Licenciaspersonal $licenciaspersonal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Licenciaspersonal $licenciaspersonal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Licenciaspersonal $licenciaspersonal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Licenciaspersonal $licenciaspersonal)
    {
        //
    }
}
