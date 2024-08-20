<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Escalafon;
// use App\Models\User;

class EscalafonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datos=DB::connection('escalafon')->table('empleados')->orderBy('apellidos','desc')->paginate(10);
        $datos=Escalafon::with('dependencia')->orderBy('apellidos','desc')->paginate(10);
        return $datos;
    }

    public function empleadoxdni(Request $request)
    {
        // $data=$request->all();

        // $datos=DB::connection('escalafon')->table('empleados')->where('dni',$request->dni)->get();
        $datos=Escalafon::with('dependencia')->where('dni',$request->dni)->get();
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
