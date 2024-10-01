<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dependencia;

class DependenciaController extends Controller
{


    // public function usuariosdepe($dni)
    //  {
    //      $datos=user::with('dependencia')->where('adm_dni',$dni)->get();
    //      return $datos;
    //  }
    //  public function listausuarios()
    //  {
    //      $datos=user::with('dependencia')->get();
    //      return $datos;
    //  }


    public function index()
    {
        // $datos=Dependencia::where(['depe_tipo'=>1,'depe_depende'=>3])->orderBy('depe_nombre','ASC')->get();
        $depes=array(3,53,54,55,56,59,60,1894);

        // $datos=Dependencia::where('depe_tipo',1)->orderBy('depe_nombre','ASC')->get();
        $result = Dependencia::where(function ($query) use ($depes) {
            foreach ($depes as $item) {
                $query->orWhere('depe_depende', '=', $item);
                    // ->orWhere('col2', 'LIKE', "%{$item}%");
            }
        })->orderBy('depe_nombre','ASC')->get();
        return $result;
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
