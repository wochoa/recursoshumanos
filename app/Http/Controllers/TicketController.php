<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Vistatiketpendiente;
use Illuminate\Http\Request;
Use App\Models\Dependencia;
Use App\Models\Catatenciones;
use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function misticket()
    {
        $iduser=auth()->user()->id;
        $datos=Ticket::where('iduser',$iduser)->orderBy('idticket','desc')->paginate(10);
        // $datos="resultado";

        return response()->json($datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pendientes()
    {   
        $idoficina=auth()->user()->depe_id;
        $iddepe=Dependencia::where('iddependencia',$idoficina)->value('depe_depende');

        if($iddepe==3)// si es sede central
        {
            $pendientes = Vistatiketpendiente::where(function ($query) use ($iddepe) {
            $query->where('codejecutora', $iddepe);
            })
            ->orWhere(function ($query) {
                $query->where('ayudasede', 1);
            })->with('oficina')->with('catticket')->paginate(10); // Cambia 10 por la cantidad de registros por página
        }
        else
        {
             $pendientes = Vistatiketpendiente::where(function ($query) use ($iddepe) {
            $query->where('codejecutora', $iddepe);
            })
            ->with('oficina')->with('catticket')->paginate(10); // Cambia 10 por la cantidad de registros por página
        }
       
        return response()->json($pendientes);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function tipoayuda(Request $request)
    {   $idoficina=auth()->user()->depe_id;
        $iddepe=Dependencia::where('iddependencia',$idoficina)->value('depe_depende');

        $opcionesayuda=Catatenciones::where(['idejecutora'=>$iddepe,'tipo_tiket'=>$request->tipo])->get();
        return response()->json($opcionesayuda);
    }

    /**
     * Display the specified resource.
     */
    public function crear(Request $request)
    {
        $idoficina=auth()->user()->depe_id;
        $iddepe=Dependencia::where('iddependencia',$idoficina)->value('depe_depende');

        $nuveoticket=new Ticket();
        $nuveoticket->iduser=auth()->user()->id;
        $nuveoticket->idoficina=auth()->user()->depe_id;
        $nuveoticket->codejecutora=$iddepe;
        $nuveoticket->ayudasede=$request->ayudaCentral;
        $nuveoticket->tipoayuda=$request->ayuda;
        $nuveoticket->detalleayuda=$request->descripcion;
        $nuveoticket->prioridad=$request->prioridad;
        $nuveoticket->estado_atencion='ENVIADO';
        $nuveoticket->save();

        // $message = $nuveoticket->idticket.' - '.$nuveoticket->detalleayuda;
        // broadcast(new MessageSent($message))->toOthers();
        // return response()->json(['status' => 'Message broadcasted']);
        $payload = [
            'titulo' => 'Nuevo ticket creado',
            'mensaje' => $nuveoticket->idticket . ' - ' . $nuveoticket->detalleayuda,
            'tipo' => 'success',
        ];

        // broadcast(new MessageSent($payload))->toOthers();
        broadcast(new MessageSent($payload)); // sin toOthers() para pruebas

        return response()->json([
            'status' => 'Ticket creado y mensaje enviado',
            'ticket' => $nuveoticket,
        ]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function atender(Request $request)
    {
        $ticket = Ticket::find($request->ticket);

        $ticket->estado_atencion = 'RECEPCIONADO';
        $ticket->idsoporte = auth()->user()->id;
        $ticket->fecha_recepcion = date('Y-m-d H:i:s');
        $ticket->save();

        $payload = [
            'titulo' => 'Ticket recepcionado',
            'mensaje' => $ticket->idticket . ' - RECEPCIONADO',
            'tipo' => 'info',
        ];

        // broadcast(new MessageSent($payload))->toOthers();
        broadcast(new MessageSent($payload)); // sin toOthers() para pruebas

        return response()->json([
            'status' => 'Ticket recepcionado y mensaje enviado',
            'ticket' => $ticket,
        ]);
    }
    public function finalizar(Request $request)
    {
        $ticket = Ticket::find($request->ticket);

        $ticket->estado_atencion = 'FINALIZADO';
        $ticket->solucion = $request->textsolucion;
         $ticket->fecha_resuelto = date('Y-m-d');
        $ticket->hora_resuelto = date('H:i:s');
        $ticket->save();

        $payload = [
            'titulo' => 'Ticket atendido',
            'mensaje' => $ticket->idticket . ' -  FINALIZADO',
            'tipo' => 'primary',
        ];

        // broadcast(new MessageSent($payload))->toOthers();
        broadcast(new MessageSent($payload)); // sin toOthers() para pruebas

        return response()->json([
            'status' => 'Ticket atendido y mensaje enviado',
            'ticket' => $ticket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function userssoporte()
    {
        $idoficina = auth()->user()->depe_id;
        $iddepe = Dependencia::where('iddependencia', $idoficina)->value('depe_depende');

        $rolesPermitidos = ['Soporte', 'Soporte_DJI'];

        $userssoporte = DB::table('vistausersoporte')
            ->where('depe_depende', $iddepe)
            ->whereIn('rolasignado', $rolesPermitidos)
            ->get();

        return response()->json($userssoporte);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function porcentajeatencion()
    {
         $idoficina = auth()->user()->depe_id;
        $iddepe = Dependencia::where('iddependencia', $idoficina)->value('depe_depende');

        $recepcionados=Ticket::where('estado_atencion','RECEPCIONADO')->where('codejecutora',$iddepe)->count();
        $enviados=Ticket::where('estado_atencion','ENVIADO')->where('codejecutora',$iddepe)->count();
        $finalizados=Ticket::where('estado_atencion','FINALIZADO')->where('codejecutora',$iddepe)->count();
        $total = $recepcionados + $enviados;
        $porcentaje = $total > 0 ? round(($recepcionados / $total) * 100, 2) : 0;

        return response()->json([
        'enviados' => $enviados,
        'recepcionados' => $recepcionados,
        'finalizados' => $finalizados,
        'porcentaje' => $porcentaje,
    ]);

    }

    public function Reporte(Request $request)
    {   $fecha_inicial=$request->fecha1;
        $fecha_final=$request->fecha2;
        
        $iduser=auth()->user()->id;
        $datos=Ticket::where('idsoporte',$iduser)->whereBetween('fecha_resuelto', [$fecha_inicial, $fecha_final])->orderBy('idticket','desc')->get();
        return response()->json($datos);
    }
}