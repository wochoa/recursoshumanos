<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Sispermiso;
use Illuminate\Support\Facades\DB;

class RolesypermisosController extends Controller
{
    //
    public function index()
    {
        //permisos
        $permisos=Sispermiso::orderBy('id','desc')->get();
        $roles=DB::table('roles')->orderBy('id','desc')->get();
        $rolesypermiso=DB::table('role_has_permissions')->select('permission_id','role_id','permissions.name as nom_permiso','roles.name as nom_rol')->join('permissions','role_has_permissions.permission_id','=','permissions.id')->join('roles','role_has_permissions.role_id','=','roles.id')->get();
        $datos=array('permisos'=>$permisos,'roles'=>$roles,'rolesypermisos'=>$rolesypermiso);
        return response()->json($datos, 200);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addpermisos(Request $request)
    {
        $datpermiso=strtoupper($request->nuevopermiso);//convertimos a mayusculas el nombre del permiso

        $new= new Sispermiso();
        $new->name=$datpermiso;
        $new->guard_name='web';
        $new->save();

        return $new;
    }
    public function updatepermisos(Request $request)
    {
        $upd=Sispermiso::find($request->id);
        $upd->name=strtoupper($request->nombre);
        $upd->save();
        return $upd;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verpermisos($idrol)
    {
        // $datos=$request->all();
        $permisosxrol=DB::table('role_has_permissions as rop')->join('permissions as p','rop.permission_id','=','p.id')->where('role_id',$idrol)->orderByDesc('p.id')->get();
        return $permisosxrol;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quitarperdelrol(Request $request)
    {
        // $datos=$request->all();
        // return $datos;
        DB::table('role_has_permissions')
        ->where(['role_id'=> $request->idrol,'permission_id'=> $request->idpermiso])
        ->delete();
    }
    public function agregarperdelrol(Request $request)
    {
        // $datos=$request->all();
        DB::table('role_has_permissions')->insert(
            ['role_id' => $request->idrol,
            'permission_id' => $request->idpermiso]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListarPermisoByUsuario(Request $request)
    {
        $id=$request->Userid;
        $permisos=DB::table('permisosuser')->select('name')->where('model_id',$id)->get();
        return $permisos;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
