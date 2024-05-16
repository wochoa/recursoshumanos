<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Usuarios extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function usuariosdepe($dni)
    {
        $datos=user::with('dependencia')->where('adm_dni',$dni)->get();
        return $datos;
    }
    public function listausuarios(Request $request)
    {
        $page=$request->page?$request->page:null;

        if($page){
            $datos=user::with('dependencia')->whereNotNull('adm_inicial')->orderBy('adm_lastname','asc')->paginate(10);
            // return response()->json(['userall'=>$datos], 200);
            return $datos;
        }
        else{
            $datos=user::with('dependencia')->whereNotNull('adm_inicial')->orderBy('adm_lastname','asc')->get();
            return response()->json(['userall'=>$datos], 200);
        }

    }


    /**
     * Show the form for creating a new resource.
     */
    public function datospersonales()
    {
        $datos=DB::connection('escalafon')->table('empleados')->get();
        return $datos;
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
