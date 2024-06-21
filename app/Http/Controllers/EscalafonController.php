<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscalafonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos=DB::connection('escalafon')->table('empleados')->orderBy('apellidos','desc')->paginate(10);
        return $datos;
    }

    public function empleadoxdni(Request $request)
    {
        // $data=$request->all();

        $datos=DB::connection('escalafon')->table('empleados')->where('dni',$request->dni)->get();
        return $datos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function resumen()
    {
        $masculinos=DB::connection('escalafon')->table('empleados')->where('sexo','MA')->count();
        $femenino=DB::connection('escalafon')->table('empleados')->where('sexo','FE')->count();
        $casindeterminado=DB::connection('escalafon')->table('empleados')->where('regimen','CAS indeterminado')->count();
        $nombrado=DB::connection('escalafon')->table('empleados')->where('regimen','276 nombrado')->count();
        $temporal=DB::connection('escalafon')->table('empleados')->where('regimen','CAS temporal')->count();
        $directivo=DB::connection('escalafon')->table('empleados')->where('regimen','CAS directivo')->count();
        $medidacautelar=DB::connection('escalafon')->table('empleados')->where('regimen','CAS medida cautelar')->count();
        $mandatojudicial=DB::connection('escalafon')->table('empleados')->where('regimen','276 mandato judicial')->count();
        $cassuplencia=DB::connection('escalafon')->table('empleados')->where('regimen','CAS suplencia')->count();
        $designado276=DB::connection('escalafon')->table('empleados')->where('regimen','276 designado')->count();
        $total=DB::connection('escalafon')->table('empleados')->count();

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
