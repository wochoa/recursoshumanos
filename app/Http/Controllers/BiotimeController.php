<?php

namespace App\Http\Controllers;

use App\Models\Biotime;
use Illuminate\Http\Request;
use DB;

class BiotimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tabla=Biotime::on('marcacion')->table('iclock_transaction')->get();
        $tabla=DB::connection('marcacion')->table('iclock_transaction')->get();
        return $tabla;
    }

    public function marcacion(Request $request)
    {
        $dni=$request->dni;
        $datos=DB::connection('marcacion')->table('iclock_transaction')->where('emp_code',$dni)->get();
        $i=0;

            $diapuntual=0;
            $diastarde=0;
            $faltadiacompleto=0;
            $faltafaltamediodia=0;

        foreach($datos as $data)
        {
            $compara=$data->punch_time;



            $hora=substr($compara,11,2);// para controlar por hora
            $minuto=substr($compara,14,2);// para controlar por minuto

            $marcacion='marcación';
            $className='';

            switch(intval($hora))
            {
                case 5: $className='bg-success text-white'; $marcacion='Ingreso'; $diapuntual+=0.5;break;
                case 6: $className='bg-success text-white'; $marcacion='Ingreso'; $diapuntual+=0.5;break;
                case 7: $className='bg-success text-white'; $marcacion='Ingreso'; $diapuntual+=0.5;break;
                case 8:
                    if($minuto>=0 and $minuto<=11){
                        $className='bg-success text-white'; $marcacion='Ingreso';
                        $diapuntual+=0.5;
                    }
                    elseif($minuto>11 and $minuto<=15){
                        $className='bg-info text-white'; $marcacion='Ingreso tarde';
                        $diastarde+=0.5;
                    }
                    else{
                        $className='bg-danger text-white'; $marcacion='Ingreso tarde';//Desc.Todo el día
                        $faltadiacompleto+=1;
                    }
                    break;
                    case 9: $className='bg-danger text-white'; $marcacion='Ingreso tarde';break;//Desc.Todo el día
                    case 10: $className='bg-danger text-white'; $marcacion='Ingreso tarde';break;//Desc.Todo el día
                    case 11: $className='bg-danger text-white'; $marcacion='Ingreso tarde';break;//Desc.Todo el día
                    case 12: $className='bg-danger text-white'; $marcacion='Ingreso tarde';break;//Desc.Todo el día
                case 13: $className='bg-warning text-white'; $marcacion='Salida'; break;
                case 14: $className='bg-success text-white'; $marcacion='Ingreso'; $diapuntual+=0.5;break;
                case 15: if($minuto>=0 and $minuto<=11)
                            {
                                 $className='bg-success text-white'; $marcacion='Ingreso';
                                 $diapuntual+=0.5;
                            }
                            elseif($minuto>11 and $minuto<=15){
                                $className='bg-info text-white'; $marcacion='Ingreso tarde';
                                $diastarde+=0.5;
                            }
                            else{
                                $className='bg-danger text-white'; $marcacion='Desc.Medio día';
                                $faltafaltamediodia+=1;
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
        // return $datos;
        $resumen=array(
            'diapuntual'=>$diapuntual,'diastarde'=>$diastarde,'faltadiacompleto'=>$faltadiacompleto,'faltafaltamediodia'=>$faltafaltamediodia
        );

        // return $hora;
        return  response()->json(['asistencias'=>$arrayName,'resumen'=>$resumen]);
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
    public function show(Biotime $biotime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biotime $biotime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biotime $biotime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biotime $biotime)
    {
        //
    }
}
