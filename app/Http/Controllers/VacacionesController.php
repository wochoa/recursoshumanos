<?php

namespace App\Http\Controllers;

use App\Models\Vacaciones;
use Illuminate\Http\Request;
use App\Models\Escalafon;
use App\Models\Asignavacaciones;

class VacacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $where[]=['escalafon.estado', 1];
        $where=[];
        if($request->dni)
            $where[] = ['dni', $request->dni];
        if($request->regimen)
            $where[] = ['regimen_id', $request->regimen];

        return Vacaciones::rightJoin('escalafon','vacaciones.idescalafon','=','escalafon.idescalafon')
                            ->join('regimen','escalafon.regimen_id','=','regimen.idregimen')
                            ->join('tram_dependencia','escalafon.depe_id','=','tram_dependencia.iddependencia')->where($where)->paginate(10);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function buscarid(Request $request)
    {
        // $datos=$request->all();
        $edit=Vacaciones::find($request->id);
        return $edit;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {

        $datos=$request->all();

        
        if($request->tipofrm==1){// si es la primera vez agrega a VACACIONES y tmb se agrega a ASIGNAVACIONES   
            $addvac=new Vacaciones();
            $addvac->fill($datos);
            $addvac->save();

            
        }

        if($request->tipofrm==2||$request->tipofrm==3){// cuando se modifica a VACACIONES
            $addvac=Vacaciones::find($request->id);
            $addvac->tot_vacaciones=$request->tot_vacaciones;
            $addvac->rest_vacaciones=$request->rest_vacaciones;
            $addvac->save();
        }
        // if($request->tipofrm==3){// se agrega cunado solo se asigna vacaciones
            $asig=new Asignavacaciones();
            $asig->idvacaciones=$addvac->id;
            $asig->sustento=$request->sustento;
            $asig->cantidaddias=$request->cantidad;
            $asig->save();
        // }
        
        

            

    }

    /**
     * Display the specified resource.
     */
    public function show(Vacaciones $vacaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacaciones $vacaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacaciones $vacaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacaciones $vacaciones)
    {
        //
    }
}
