<?php

namespace App\Http\Controllers;

use App\Models\Papeletaspermisos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PapeletaspermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fecha=date("Y-m-d", strtotime($request->fecha));
        $pendiente=$request->pendiente;
        $where=[];
        if($request->dni <> '')
            $where[] = ['dni', $request->dni];
        if($request->fecha <> '')
            $where[] = ['fecha', $fecha];

        return Papeletaspermisos::where($where)->with('dependencia')->with('regimen')->orderBy('id','desc')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function idpapeleta(Request $request)
    {
        // return $request->all();
        $datos=Papeletaspermisos::find($request->idpapeleta);
        // $datos=Papeletaspermisos::with('dependencia')->with('regimen')->where('id',$request->idpapeleta)->first();
        return $datos;
    }

    public function updretorno(Request $request)
    {
        $Horasalida=date('H:i:s');
        $busca=Papeletaspermisos::find($request->idpapeleta);
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
        $add=new Papeletaspermisos();
        $add->fill($datos);
        $add->fecha=$fecha;
        $add->hora_salida=$Horasalida;

        $add->save();
        // return $request->all();

    }
    public function busqueda(Request $request)
    {
        return $request->all();
    }

    public function dni($num)
    {
        // Datos
        $token = 'apis-token-10468.00SYH65hyt-aKbPBAkvavXBtR0x9CbWR';
        $dni = $num;

        // Iniciar llamada a API
        $curl = curl_init();

        // Buscar dni
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 2,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: https://apis.net.pe/consulta-dni-api',
            'Authorization: Bearer ' . $token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // Datos listos para usar
        $persona = json_decode($response);
        return $persona;
    }


    /**
     * Display the specified resource.
     */
    public function show(Papeletaspermisos $papeletaspermisos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Papeletaspermisos $papeletaspermisos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Papeletaspermisos $papeletaspermisos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Papeletaspermisos $papeletaspermisos)
    {
        //
    }
}
