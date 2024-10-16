<?php

namespace App\Http\Controllers;

use App\Models\asistencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

//
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

class AsistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $fechaini= date("Y-m-d", strtotime($request->fechaini));
        $fechafin= date("Y-m-d", strtotime($request->fechafin));
        $where=[];
        if ($request->dni <> '')
            $where[] = ['dni', $request->dni];

        if($request->fechaini <> '' and $request->fechafin <> '')
        {
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=DB::connection('asistencias')->table('marcaciones_all_resume')->where($where)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('dni','desc')->orderBy('fecha','desc')->paginate(10);
            }
            else{
                $datos=DB::connection('asistencias')->table('marcaciones_all_resume')->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('dni','desc')->orderBy('fecha','desc')->paginate(10);
            }
        }
        else{
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=DB::connection('asistencias')->table('marcaciones_all_resume')->where($where)->orderBy('dni','desc')->orderBy('fecha','desc')->paginate(10);
            }
            else{
                $datos=DB::connection('asistencias')->table('marcaciones_all_resume')->orderBy('dni','desc')->orderBy('fecha','desc')->paginate(10);
            }
        }

        return $datos;
        // return $this->reordenamarcacion($datos);
    }
    public function pdf(Request $request)
    {

        $fechaini= date("Y-m-d", strtotime($request->fechaini));
        $fechafin= date("Y-m-d", strtotime($request->fechafin));
        $where=[];
        if ($request->dni <> '')
            $where[] = ['dni', $request->dni];

        if($request->fechaini <> '' and $request->fechafin <> '')
        {
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=DB::connection('asistencias')->table('marcaciones_all_resume')->select('id','dni','nombre_completo as nombre','fecha','ma_1','ma_2','ma_3','ma_4','tot_min_ta as m_tarde','tot_min_ex as m_extra')->where($where)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('dni','desc')->orderBy('fecha','desc')->get();
            }
            else{
                $datos=DB::connection('asistencias')->table('marcaciones_all_resume')->select('id','dni','nombre_completo as nombre','fecha','ma_1','ma_2','ma_3','ma_4','tot_min_ta as m_tarde','tot_min_ex as m_extra')->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('dni','desc')->orderBy('fecha','desc')->get();
            }
        }
        else{
            if(count($where)>0)
            {// cuando tiene elemenos where
                $datos=DB::connection('asistencias')->table('marcaciones_all_resume')->select('id','dni','nombre_completo as nombre','fecha','ma_1','ma_2','ma_3','ma_4','tot_min_ta as m_tarde','tot_min_ex as m_extra')->where($where)->orderBy('dni','desc')->orderBy('fecha','desc')->get();
            }
            else{
                $datos=DB::connection('asistencias')->table('marcaciones_all_resume')->select('id','dni','nombre_completo as nombre','fecha','ma_1','ma_2','ma_3','ma_4','tot_min_ta as m_tarde','tot_min_ex as m_extra')->orderBy('dni','desc')->orderBy('fecha','desc')->get();
            }
        }
        //dowlandpdf
        
        // $pdf = Pdf::loadView('dowlandpdf', compact('datos'));
        // $pdf->setPaper('A4', 'landscape');
        // //  return $pdf->stream();
        // return $pdf->output();
        return $datos;

    }
    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function reordenamarcacion(Request $request)
    {

        $datos=DB::connection('asistencias')->table('marcaciones_all')->select('dni','fecha')->orderBy('dni','desc')->orderBy('fecha','desc')->groupBy('dni','fecha')->get();


        $fechaini= date("Y-m-d", strtotime($request->fechaini));
        $fechafin= date("Y-m-d", strtotime($request->fechafin));
        $where=[];
        if ($request->dni <> '')
            $where[] = ['dni', $request->dni];

        if($request->fechaini <> '' and $request->fechafin <> '')
        {
            if(count($where)>0)
            {// cuando tiene elemenos where
                // $datos=DB::connection('asistencias')->table('marcaciones_all')->where($where)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('dni','desc')->orderBy('fecha','desc')->paginate(10);
                $datos=DB::connection('asistencias')->table('marcaciones_all')->where($where)->whereBetween('fecha', [$fechaini, $fechafin])->select('dni','fecha')->orderBy('dni','desc')->orderBy('fecha','desc')->groupBy('dni','fecha')->get();
            }
            else{
                // $datos=DB::connection('asistencias')->table('marcaciones_all')->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('dni','desc')->orderBy('fecha','desc')->paginate(10);
                $datos=DB::connection('asistencias')->table('marcaciones_all')->whereBetween('fecha', [$fechaini, $fechafin])->select('dni','fecha')->orderBy('dni','desc')->orderBy('fecha','desc')->groupBy('dni','fecha')->get();
            }
        }
        else{
            if(count($where)>0)
            {// cuando tiene elemenos where
                // $datos=DB::connection('asistencias')->table('marcaciones_all')->where($where)->orderBy('dni','desc')->orderBy('fecha','desc')->paginate(10);
                $datos=DB::connection('asistencias')->table('marcaciones_all')->where($where)->select('dni','fecha')->orderBy('dni','desc')->orderBy('fecha','desc')->groupBy('dni','fecha')->get();
            }
            else{
                // $datos=DB::connection('asistencias')->table('marcaciones_all')->orderBy('dni','desc')->orderBy('fecha','desc')->paginate(10);
                $datos=DB::connection('asistencias')->table('marcaciones_all')->select('dni','fecha')->orderBy('dni','desc')->orderBy('fecha','desc')->groupBy('dni','fecha')->paginate(10);
            }
        }

        foreach($datos as $valor)
        {
            $horas[]=$this->extrae_horas($valor->dni,$valor->fecha);

        }
        // $vaob=json_decode($datos,true);
        // print_r($vaob);

        // // print_r($datos);

        // // return json_decode($datos[0]->data);
        return $this->paginate($horas);
    }

    public function extrae_horas($dni,$fecha)
    {
        $horas=$datos=DB::connection('asistencias')->table('marcaciones_all')->where(['dni'=>$dni,'fecha'=>$fecha])->orderBy('hora','asc')->get();
        $id=$horas[0]->id;
        $dni=$dni;
        $nombres=$horas[0]->nombre_completo;
        $dependencia=$horas[0]->dependencia;
        $fecha=$fecha;
        $tot_min_ta=$horas[0]->tot_min_ta;
        $tot_min_ex=$horas[0]->tot_min_ex;
        $ma1=$horas[0]->hora;
        $ma2=$horas[1]->hora;
        $ma3=$horas[2]->hora;
        $ma4=$horas[3]->hora;
        $f_dc_m1=$horas[0]->f_dc_m1+$horas[1]->f_dc_m1+$horas[2]->f_dc_m1+$horas[3]->f_dc_m1;
        $f_md_m3=$horas[0]->f_md_m3+$horas[1]->f_md_m3+$horas[2]->f_md_m3+$horas[3]->f_md_m3;
        $just=$horas[0]->just;
        $doc_just=$horas[0]->doc_just;
        $array=array(
            'id'=>$id,
            'dni'=>$dni,
            'nombres'=>$nombres,
            'dependencia'=>$dependencia,
            'fecha'=>$fecha,
            'ma1'=>$ma1,
            'ma2'=>$ma2,
            'ma3'=>$ma3,
            'ma4'=>$ma4,
            'f_dc_m1'=>$f_dc_m1,
            'f_md_m3'=>$f_md_m3,
            'tot_min_ta'=>$tot_min_ta,
            'tot_min_ex'=>$tot_min_ex,
            'just'=>$just,
            'doc_just'=>$doc_just
        );
        return $array;
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
            // $className='bg-danger text-white';
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
                case 9: $className='bg-danger text-white'; $marcacion='Desc.Todo el día';break;
                case 10: $className='bg-danger text-white'; $marcacion='Desc.Todo el día';break;
                case 11: $className='bg-danger text-white'; $marcacion='Desc.Todo el día';break;
                case 12: $className='bg-danger text-white'; $marcacion='Desc.Todo el día';break;
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
