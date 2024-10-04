<?php

namespace App\Http\Controllers;

use App\Models\Papeletaspermisos;
use Illuminate\Http\Request;
use Storage;
use Carbon\Carbon;

class PapeletaspermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth' => 'verified'])->except('eliminapdf');
    // }

    public function index(Request $request)
    {
        $fecha=date("Y-m-d", strtotime($request->fecha));
        $pendiente=$request->pendiente;
        $where=[];

        if($request->dni <> '')
            $where[] = ['dni', $request->dni];
        if($request->fecha <> '')
            $where[] = ['fecha', $fecha];

        if($pendiente!='')
        {
            switch($pendiente)
            {
                case 0: // pendeinte hora_retorno=null
                    return Papeletaspermisos::where($where)->whereNull('hora_retorno')->with('dependencia')->with('regimen')->orderBy('id','desc')->paginate(10);
                    break;
                case 1:// si ha retrnado
                    return Papeletaspermisos::where($where)->whereNotNull('hora_retorno')->with('dependencia')->with('regimen')->orderBy('id','desc')->paginate(10);
                    break;
                // default:
                
            }
        }
        
            // $whereNotNull = 'hora_retorno';
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
    public function updpapaletas(Request $request)
    {
        // $datos=$request->all();

        $upd=Papeletaspermisos::find($request->id);
        $upd->destino=$request->destino;
        $upd->justificacion=$request->justificacion;
        $upd->motivo_salida=$request->motivo_salida;
        $upd->fecha=$request->fecha;
        if($request->hora_retorno!='null')
            $upd->hora_retorno=$request->hora_retorno;
        $upd->hora_salida=$request->hora_salida;
        // $upd->fill($datos);

        if($upd->archivo)
        {
            $rutaphp=storage_path($upd->archivo);
            unlink($rutaphp);
        }

        if ($request->hasFile('file'))
        {

            //get filename with extension
            $file = $request->file('file');//->getClientOriginalName();

            $fileName= 'papeletas/'.date('Y').'/'.date('m').'/'.date('d').'/'.time().'-'.$file->getClientOriginalName();
            // Storage::disk()->putFileAs('tramite', $file, $fileName); // SE GUARDA EN EL STORAGE

            $filesystem = Storage::disk('papeletassalida');
            $filesystem->putFileAs($file, $fileName);

            $ubica_urlbd='papeletassalida/'.$fileName;

            $upd->archivo=$ubica_urlbd;
        }
        $upd->save();
        return $upd;


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
    public function mostrararchivo($idfile)
    {
        $datarachivo=Papeletaspermisos::find($idfile);
        $rutaDelarchivo=$datarachivo->archivo;

        // $rutaDeArchivo = Storage::path($rutaDelarchivo);

        $headers = array(
            'Content-Type: application/pdf',
        );
        $file = storage_path($rutaDelarchivo);
        return response()->file($file);
        // return response()->file($rutaDeArchivo,$headers);
    }
    // public function eliminapdf($idfile)
    // {
        
    //     $upd=Papeletaspermisos::find($idfile);
        
    //     $rutaphp=storage_path($upd->archivo);
    //     unlink($rutaphp);

    //     // if($upd->archivo)
    //     // {
    //     //     if(file_exists($upd->archivo)){
    //     //         // Storage::delete($upd->archivo);
    //     //         unlink($upd->archivo);
    //     //         return 'eliminado';
    //     //     }
    //     //     return 'eliminado';
    //     // }
    // }


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
