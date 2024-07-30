<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;

class Firmaperu extends Controller
{

    public $token_firma_peru;

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
    public function parametros(Request $request)
    {

        $paramfirma = '{
            "signatureFormat": "PAdES",
            "signatureLevel": "B",
            "signaturePackaging": "enveloped",
            "documentToSign":"http://firmaperu.test/demo/demo.pdf",
            "certificateFilter": ".*",
            "webTsa": "",
            "userTsa": "",
            "passwordTsa": "",
            "theme": "oscuro",
            "visiblePosition": true,
            "contactInfo": "",
            "signatureReason": "Soy el autor de este documento",
            "bachtOperation": false,
            "oneByOne": true,
            "signatureStyle": 1,
            "imageToStamp":"http://firmaperu.test/img/stamp3_1.png",
            "stampTextSize": 14,
            "stampWordWrap": 37,
            "role": "Analista de servicios",
            "stampPage": 1,
            "positionx": 20,
            "positiony": 20,
            "uploadDocumentSigned":"http://firmaperu.test/Uploadx.php",
            "certificationSignature": false,
            "token":"' . $this->getTokenFirmaPeruCached() . '"
         }';

        return response(
            base64_encode(
                $paramfirma
            ),
            200
        )
            ->header("Access-Control-Allow-Origin",  "*")
            ->header('Content-Type', 'text/html; charset=UTF-8');

        // return $this->getTokenFirmaPeruCached();
    }
    public function getTokenFirmaPeru()
    {
        $curl = curl_init();
        $fields = array('client_id' => 'p99VWXJ1tzIwNDg5MjUwNzMxJ-hafwePDg', 'client_secret' => 'sD-b136fUs7OXA2-omAS6e-yvvR1t1_ZB6Y');
        $fields_string = http_build_query($fields);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apps.firmaperu.gob.pe/admin/api/security/generate-token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_POSTFIELDS => $fields_string,
                CURLOPT_POST => 1
            )
        );
        return curl_exec($curl);
    }
    public function getTokenFirmaPeruCached()
    {
        //86400 minutos comprenden 24 horas Laravel 5.7 hacia atras
        //5184000 segundos comprenden 24 horas Laravel 5.8 en adelante
        return $this->token_firma_peru = Cache::remember('token_firma_peru', 86400, function () {
            return $this->getTokenFirmaPeru();
        });
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
