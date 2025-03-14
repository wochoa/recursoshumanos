<?php

namespace App\Http\Controllers;

use App\Models\Dnipcm;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DnipcmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function getdni($dni,$key)
    {
        // dni
        $consulta=Dnipcm::where('estado',1)->first();

        $nuDniConsulta=$dni;
        $nuDniUsuario=$consulta->nuDni;
        $nuRucUsuario=$consulta->nuRuc;
        $password=$consulta->nuDni;
        $keybd=$consulta->key;

        $key=$key;//env("JWT_SECRET");// token del API

        if($key==$keybd)
        {
            $url="https://ws2.pide.gob.pe/Rest/RENIEC/Consultar?nuDniConsulta=".$nuDniConsulta."&nuDniUsuario=".$nuDniUsuario."&nuRucUsuario=".$nuRucUsuario."&password=".$nuDniUsuario."&out=json";
            $api=file_get_contents($url);
            $response_data = json_decode($api);
                
            $return=$response_data->consultarResponse->return;

            if($return->coResultado="0000")
            {
                $datos=array(
                    "apPrimer"=>$return->datosPersona->apPrimer,
                    "apSegundo"=>$return->datosPersona->apSegundo,
                    "direccion"=>$return->datosPersona->direccion,
                    "estadoCivil"=>$return->datosPersona->estadoCivil,
                    "foto"=>$return->datosPersona->foto,
                    "prenombres"=>$return->datosPersona->prenombres,
                    "restriccion"=>$return->datosPersona->restriccion,
                    "ubigeo"=>$return->datosPersona->ubigeo,
                );
                $upd=Dnipcm::find($consulta->id);
                $upd->creditos=$consulta->creditos-1;
                $upd->save();
            }
            else
            {
                //  catualizamos a otro si se gasta los creditos
            }
        
        return $datos;
        }
        else{
            return response()->json(['status'=>0,'msg'=>'No concuerda las credenciales'], 200);
        }        
    }    
    public function consultadni(Request $request)
    {
        // dni
        $consulta=Dnipcm::where('estado',1)->first();

        $nuDniConsulta=$request->dni;
        $nuDniUsuario=$consulta->nuDni;
        $nuRucUsuario=$consulta->nuRuc;
        $password=$consulta->nuDni;
        $keybd=$consulta->key;

        //buscamos si tiene el paquete

        $key=$request->key;//env("JWT_SECRET");// token del API

        if($key==$keybd)
        {
            
            $url="https://ws2.pide.gob.pe/Rest/RENIEC/Consultar?nuDniConsulta=".$nuDniConsulta."&nuDniUsuario=".$nuDniUsuario."&nuRucUsuario=".$nuRucUsuario."&password=".$nuDniUsuario."&out=json";
            $api=file_get_contents($url);
            $response_data = json_decode($api);

                
            $return=$response_data->consultarResponse->return;

            if($return->coResultado="0000")
            {
                $datos=array(
                    "apPrimer"=>$return->datosPersona->apPrimer,
                    "apSegundo"=>$return->datosPersona->apSegundo,
                    "direccion"=>$return->datosPersona->direccion,
                    "estadoCivil"=>$return->datosPersona->estadoCivil,
                    "foto"=>$return->datosPersona->foto,
                    "prenombres"=>$return->datosPersona->prenombres,
                    "restriccion"=>$return->datosPersona->restriccion,
                    "ubigeo"=>$return->datosPersona->ubigeo,
                );
                $upd=Dnipcm::find($consulta->id);
                $upd->creditos=$consulta->creditos-1;
                $upd->save();
            }
            else
            {
                //  catualizamos a otro si se gasta los creditos
            }
        
        return $datos;
        }
        else{
            return response()->json(['status'=>0,'msg'=>'No concuerda las credenciales'], 200);
        }        
    }

    public function dni_codveri(Request $request)
    {
        // dni
        $consulta=Dnipcm::where('estado',1)->first();
        $nuDniConsulta=$request->dni;
        $nuDniUsuario=$consulta->nuDni;
        $nuRucUsuario=$consulta->nuRuc;
        $password=$consulta->nuDni;

        //buscamos si tiene el paquete

        $key=$request->key;//env("JWT_SECRET");// token del API

        if($key==$keybd)
        {


            $url="https://ws2.pide.gob.pe/Rest/RENIEC/Consultar?nuDniConsulta=".$nuDniConsulta."&nuDniUsuario=".$nuDniUsuario."&nuRucUsuario=".$nuRucUsuario."&password=".$nuDniUsuario."&out=json";
            $api=file_get_contents($url);
            $response_data = json_decode($api);

            $curl = curl_init();
            $token = 'apis-token-11039.IXruf4gnUkvd3PxUXGh4VbfKoCZPRds7';
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $request->dni,
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
            $persona = json_decode($response);

            
            $return=$response_data->consultarResponse->return;

            if($return->coResultado="0000")
            {
                $datos=array(
                    "apPrimer"=>$return->datosPersona->apPrimer,
                    "apSegundo"=>$return->datosPersona->apSegundo,
                    "direccion"=>$return->datosPersona->direccion,
                    "estadoCivil"=>$return->datosPersona->estadoCivil,
                    "foto"=>$return->datosPersona->foto,
                    "prenombres"=>$return->datosPersona->prenombres,
                    "restriccion"=>$return->datosPersona->restriccion,
                    "ubigeo"=>$return->datosPersona->ubigeo,
                    "digitoVerificador"=>$persona->digitoVerificador
                );
                $upd=Dnipcm::find($consulta->id);
                $upd->creditos=$consulta->creditos-1;
                $upd->save();
            }
            else
            {
                //  catualizamos a otro
            }
            
            return $datos;
        }
        else{
            return response()->json('No concuerda las credenciales', 200);
        };
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Dnipcm $dnipcm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dnipcm $dnipcm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dnipcm $dnipcm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dnipcm $dnipcm)
    {
        //
    }
}
