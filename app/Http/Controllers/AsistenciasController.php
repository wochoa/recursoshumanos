<?php

namespace App\Http\Controllers;

use App\Models\asistencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AsistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $datos=$request->all();
        // $fechaini= date("d-m-Y", strtotime($request->fechaini));
        $fechaini= date("Y-m-d", strtotime($request->fechaini));
        // $fechafin= date("d-m-Y", strtotime($request->fechafin));
        $fechafin= date("Y-m-d", strtotime($request->fechafin));
        $where=[];
        if ($request->dni <> '')
            $where[] = ['dni', $request->dni];

        if($request->fechaini <> '' and $request->fechafin <> '')
        {
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=DB::connection('asistencias')->table('marcaciones_all')->where($where)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
            }
            else{
                $datos=DB::connection('asistencias')->table('marcaciones_all')->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
            }
        }
        else{
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=DB::connection('asistencias')->table('marcaciones_all')->where($where)->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
            }
            else{
                $datos=DB::connection('asistencias')->table('marcaciones_all')->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
            }
        }

        return $datos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listasistenciaxdni(Request $request)
    {   $dni=$request->dni;
        $datos=DB::connection('asistencias')->table('marcaciones_all')->where('dni',$dni)->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
        return $datos;
    }
    public function asistenciaxdni(Request $request)
    {
        $dni=$request->dni;
        $datos=DB::connection('asistencias')->table('marcaciones_all')->where('dni',$dni)->orderBy('fecha','desc')->orderBy('hora','desc')->get();
        // $arrayName = array();
        $i=0;
        foreach ($datos as $data) {
            $compara=$data->fecha.' '.$data->hora;//carbon::parse($data->fecha.' '.$data->hora);
            // $date1=Carbon::parse($data->fecha.' 08:00:00');// para las 8
            // $date=$compara->format('Y-m-d H:i:s');
            // $phpDateTimeStamp = $date->getTimestamp()*1000;
            $i++;
            $diapuntual=$data->dias_puntual;
            $diastarde=$data->dias_tarde;
            $faltadiacompleto=$data->falta_dc;
            $faltafaltamediodia=$data->falta_md;
            $hora=substr($data->hora,0,2);// para controlar por hora
            $minuto=substr($data->hora,3,2);// para controlar por minuto

            $marcacion='marcación';
            switch(intval($hora))
            {
                case 7: $className='bg-success text-white'; $marcacion='Ingreso'; break;
                case 8:
                    if($minuto>=0 and $minuto<=11){
                        $className='bg-success text-white'; $marcacion='Ingreso';
                    }
                    elseif($minuto>11 and $minuto<=15){
                        $className='bg-info text-white'; $marcacion='Ingreso tarde';
                    }
                    else{
                        $className='bg-danger text-white'; $marcacion='Desc.Todo el día';
                    }
                    break;

                case 13: $className='bg-warning text-white'; $marcacion='Salida'; break;
                case 14: $className='bg-success text-white'; $marcacion='Ingreso'; break;
                case 15: if($minuto>=0 and $minuto<=11)
                            {
                                 $className='bg-success text-white'; $marcacion='Ingreso';
                            }
                            elseif($minuto>11 and $minuto<=15){
                                $className='bg-info text-white'; $marcacion='Ingreso tarde';
                            }
                            else{
                                $className='bg-danger text-white'; $marcacion='Desc.Todo el día';
                            }
                            break;
                case 17: $className='bg-warning text-white'; $marcacion='salida'; break;

                case (intval($hora)>=18):$className='bg-warning text-white'; $marcacion='Salida'; break;
            }

            $arrayName[]=[
                'title'=>$marcacion,
                'start'=>$compara,
                // 'allDay'=> false,
                'className'=> $className
            ];
        }

        $resumen=array(
            'diapuntual'=>$diapuntual,'diastarde'=>$diastarde,'faltadiacompleto'=>$faltadiacompleto,'faltafaltamediodia'=>$faltafaltamediodia
        );

        // return $hora;
        return  response()->json(['asistencias'=>$arrayName,'resumen'=>$resumen]);

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
