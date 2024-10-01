<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Escalafon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
// use Storage;
use Illuminate\Support\Facades\Storage;
use Cache;
// use App\Models\User;

class EscalafonController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // $datos=DB::connection('escalafon')->table('empleados')->orderBy('apellidos','desc')->paginate(10);
        $datos=Escalafon::with('dependencia')->with('regimen')->orderBy('apellidos','desc')->paginate(10);
        return $datos;
    }

    public function empleadoxdni(Request $request)
    {
        // $data=$request->all();

        // $datos=DB::connection('escalafon')->table('empleados')->where('dni',$request->dni)->get();
        $datos=Escalafon::with('dependencia')->where('dni',$request->dni)->get();

        if(!$datos->count())
        {
            $response = Http::get(route('permisos.dni',['num'=>$request->dni]));

        return response()->json(['status'=>1,'datos'=>$response->json()]);
        }
        else{
            $datos=Escalafon::with('dependencia')->where('dni',$request->dni)->first();
            return response()->json(['status'=>2,'datos'=>$datos]);
        }


    }

    public function regimenpersonal()
    {
        $datos=DB::table('regimen')->get();
        return $datos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function resumen()
    {
        $masculinos=Escalafon::where('sexo','MA')->count();
        $femenino=Escalafon::where('sexo','FE')->count();
        $casindeterminado=Escalafon::where('regimen','CAS indeterminado')->count();
        $nombrado=Escalafon::where('regimen','276 nombrado')->count();
        $temporal=Escalafon::where('regimen','CAS temporal')->count();
        $directivo=Escalafon::where('regimen','CAS directivo')->count();
        $medidacautelar=Escalafon::where('regimen','CAS medida cautelar')->count();
        $mandatojudicial=Escalafon::where('regimen','276 mandato judicial')->count();
        $cassuplencia=Escalafon::where('regimen','CAS suplencia')->count();
        $designado276=Escalafon::where('regimen','276 designado')->count();
        $total=Escalafon::count();

        $datos=array('masculinos'=>$masculinos,
        'femenino'=>$femenino,
        'casindeterminado'=>$casindeterminado,
        'nombrado'=>$nombrado,
        'temporal'=>$temporal,
        'directivo'=>$directivo,
        'medidacautelar'=>$medidacautelar,
        'mandatojudicial'=>$mandatojudicial,
        'cassuplencia'=>$cassuplencia,
        'designado276'=>$designado276,
        'total'=>$total
    );

        return response()->json($datos , 200);
    }

    // TRASLADAR DATOS DE CONVOCATORIA A LEGAJO
    /*
        SE TIENE QUE COMPARAR DATOS DE MARCACION Y CONVOCATORIA INICIANDOSE DESDE 02/07/2024
        FECHAS ANTIGUAS NO ESTARN REGISTRADAS EN EL RELOJ DEBIDO A QUE MUCHOS YA NO LABORAN
        LOS DATOS SE TOMARAN CON TRABAJADORES VIGENTES Y REGISTRADOS EN EL RELOJ 02/07/2024
    */
    public function buscadistrito($id)
    {
        $datos=DB::connection('cas')->table('lugar')->where('id',$id)->get();
        return $datos;
    }

    public function leerjson()
    {

        if($this->sincronizar()){
            $path=storage_path('app/cas.json');
            $json = json_decode(file_get_contents($path), true);

            return $json;
        }

    }
    public function verpostulante($idenvio)
    {
        $datos=DB::connection('cas')->table('user_puesto')->join('lugar','user_puesto.dis','=','lugar.id')->where('idenvioinsc',$idenvio)->get();
        return $datos;
    }
    public function sincronizar()
    {
        //86400 minutos comprenden 24 horas Laravel
        return  Cache::remember('token_convocatoria', 86400, function ()
        {

            $datos_reloj=DB::connection('marcacion')->table('personnel_employee')->select('emp_code')->groupBy('emp_code')->get();//where('emp_code',$dni)->get();


            foreach($datos_reloj as $relog)
            {
                $reg[]=$relog->emp_code;
            }
            // PARA NO DUPLICAR DATOS EN ESCALAFON, pero no estaba comtemplado doble contrato de un personal en escalafon, lo cual deberia registrarse
            // $esacalafon=$this->datosescalafon();
            // foreach($esacalafon as $escala)
            // {
            //     $esc[]=$escala->dni;
            // }


            // $dni_faltantes=array_diff($reg,$esc);// aqui busca los dnis que no estan en escalafon, devuelve los DNI en array
            // $resultado=$this->buscarenconvocatoria($dni_faltantes);
            // esta consulta solo agarra a reloj y convocatoria

            $resultado=$this->buscarenconvocatoria($reg);


            $file = Storage::put( 'cas.json', json_encode($resultado));


            return base64_encode('procesoconvocatoria');
        });


        // return $resultado;

    }

    public function datosescalafon(){
        $datos=Escalafon::select('dni')->get();
        return $datos;
    }

    public function buscarenconvocatoria($relog)
    {
        foreach($relog as $item)
        {
            $datos=DB::connection('cas')->table('user_puesto')
            // ->join('lugar','user_puesto.dis','=','lugar.id')

            ->where('num_doc',$item)->orderBy('idenvioinsc','DESC')->first();//$item;

            if($datos)
            {
                $dni[]=$datos;//array('datos'=>$datos);
            }
            // $dni[]=$item;
        }
        // $dni=DB::connection('cas')->table('envioinscripcion')->join('user_conv_detalle','envioinscripcion.iduser','=','user_conv_detalle.iduser')->where('num_doc',42282733)->orderBy('idenvioinsc','DESC')->limit(1)->get();//$item;
        return $dni;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addescalafon(Request $request)
    {
        $datos=$request->all();
        $add=new Escalafon();
        $add->fill($datos);
        $add->save();

        // $this->sincronizar();

        return $add;
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
