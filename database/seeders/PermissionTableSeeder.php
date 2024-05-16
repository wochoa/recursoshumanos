<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        Permission::create(['name' => 'Pagina_crearticket']);// pagina ticket
        Permission::create(['name' => 'Pagina_misticket']);// pagina mis ticket
        Permission::create(['name' => 'Pagina_reporteticket']);// pagina reporte ticket
        Permission::create(['name' => 'Ticket_leer']);
        Permission::create(['name' => 'Ticket_crear']);
        Permission::create(['name' => 'Ticket_editar']);
        Permission::create(['name' => 'Ticket_eliminar']);
        Permission::create(['name' => 'Pagina_chat']);// pagina chat
        Permission::create(['name' => 'crear_chat']);
        Permission::create(['name' => 'Pagina_mioficina']);//pagina mi oficina
        Permission::create(['name' => 'Pagina_personalsoporte']);
        Permission::create(['name' => 'pagina_userSGD']);// pagina  usuarios sgd
        Permission::create(['name' => 'UsuarioSGD_rol']);// puede asignar rol
        Permission::create(['name' => 'Pagina_roles']);// pagina de roles
        Permission::create(['name' => 'roles_leer']);
        Permission::create(['name' => 'roles_crear']);
        Permission::create(['name' => 'roles_editar']);
        Permission::create(['name' => 'roles_eliminar']);
        Permission::create(['name' => 'Pagina_permisos']);// pagina de permisos
        Permission::create(['name' => 'permisos_leer']);
        Permission::create(['name' => 'permisos_crear']);
        Permission::create(['name' => 'permisos_editar']);
        Permission::create(['name' => 'permisos_eliminar']);
        Permission::create(['name' => 'Pagina_catatenciones']);// pagina de categoria de atenciones
        Permission::create(['name' => 'catatenciones_leer']);
        Permission::create(['name' => 'catatenciones_crear']);
        Permission::create(['name' => 'catatenciones_editar']);
        Permission::create(['name' => 'catatenciones_eliminar']);
        Permission::create(['name' => 'Pagina_inventario']);// pagina de inventario -- falta crear todo
        Permission::create(['name' => 'inventario_leer']);
        Permission::create(['name' => 'inventario_crear']);
        Permission::create(['name' => 'inventario_editar']);
        Permission::create(['name' => 'inventario_eliminar']);

        Permission::create(['name' => 'acceso_gestionportales']);
        Permission::create(['name' => 'gp_menu_portalweb']);
        Permission::create(['name' => 'gp_configuracion_tema']);
        Permission::create(['name' => 'gp_publicacion_leer']);
        Permission::create(['name' => 'gp_publicacion_editar']);
        Permission::create(['name' => 'gp_publicacion_crear']);
        Permission::create(['name' => 'gp_publicacion_eliminar']);
        Permission::create(['name' => 'gp_menu_leer']);
        Permission::create(['name' => 'gp_menu_crear']);
        Permission::create(['name' => 'gp_menu_editar']);
        Permission::create(['name' => 'gp_menu_eliminar']);
        Permission::create(['name' => 'gp_pagina_leer']);
        Permission::create(['name' => 'gp_pagina_crear']);
        Permission::create(['name' => 'gp_pagina_editar']);
        Permission::create(['name' => 'gp_pagina_eliminar']);
        Permission::create(['name' => 'gp_taspagina_leer']);
        Permission::create(['name' => 'gp_taspagina_crear']);
        Permission::create(['name' => 'gp_taspagina_editar']);
        Permission::create(['name' => 'gp_taspagina_eliminar']);
        Permission::create(['name' => 'gp_categoria_leer']);
        Permission::create(['name' => 'gp_categoria_crear']);
        Permission::create(['name' => 'gp_categoria_editar']);
        Permission::create(['name' => 'gp_categoria_eliminar']);
        Permission::create(['name' => 'gp_anuncios_leer']);
        Permission::create(['name' => 'gp_anuncios_crear']);
        Permission::create(['name' => 'gp_anuncios_editar']);
        Permission::create(['name' => 'gp_anuncios_eliminar']);
        Permission::create(['name' => 'gp_seccion_leer']);
        Permission::create(['name' => 'gp_seccion_crear']);
        Permission::create(['name' => 'gp_seccion_editar']);
        Permission::create(['name' => 'gp_seccion_eliminar']);
        Permission::create(['name' => 'gp_enlaceref_leer']);
        Permission::create(['name' => 'gp_enlaceref_crear']);
        Permission::create(['name' => 'gp_enlaceref_editar']);
        Permission::create(['name' => 'gp_enlaceref_eliminar']);
        Permission::create(['name' => 'pg_menu_ciudadano']);
        Permission::create(['name' => 'pg_libroreclamaciones_leer']);
        Permission::create(['name' => 'pg_sugerencias_leer']);
        Permission::create(['name' => 'pg_menu_registrovisitas']);
        Permission::create(['name' => 'pg_registrovisitas_leer']);
        Permission::create(['name' => 'pg_registrovisitas_reporte']);
        Permission::create(['name' => 'pagina_pide']);
        Permission::create(['name' => 'gp_slider_leer']);
        Permission::create(['name' => 'gp_slider_editar']);
        Permission::create(['name' => 'gp_slider_crear']);
        Permission::create(['name' => 'gp_slider_eliminar']);
        // create roles and assign existing permissions
        $admin = Role::create(['name' => 'Superadmin']);
        $empleado = Role::create(['name' => 'Administrador']);
        $soporte = Role::create(['name' => 'Soporte']);
        $usuario = Role::create(['name' => 'Usuario']);
        $portalweb_publicador = Role::create(['name' => 'portalweb_publicador']);
        $portalweb_administrador = Role::create(['name' => 'portalweb_administrador']);
        $portalweb_ciudadano = Role::create(['name' => 'portalweb_ciudadano']);
        $portalweb_regvisitas = Role::create(['name' => 'portalweb_regvisitas']);
        $consumo_pide = Role::create(['name' => 'consumo_pide']);

        // asignacion de roles y permisos

        $admin->givePermissionTo(
            [
                'Pagina_crearticket',
                'Pagina_misticket',
                'Pagina_reporteticket',
                'Ticket_leer',
                'Ticket_crear',
                'Ticket_editar',
                'Ticket_eliminar',
                'Pagina_chat',
                'crear_chat',
                'Pagina_mioficina',
                'Pagina_personalsoporte',
                'pagina_userSGD',
                'UsuarioSGD_rol',
                'Pagina_roles',
                'roles_leer',
                'roles_crear',
                'roles_editar',
                'roles_eliminar',
                'Pagina_permisos',
                'permisos_leer',
                'permisos_crear',
                'permisos_editar',
                'permisos_eliminar',
                'Pagina_catatenciones',
                'catatenciones_leer',
                'catatenciones_crear',
                'catatenciones_editar',
                'catatenciones_eliminar',
                'Pagina_inventario',
                'inventario_leer',
                'inventario_crear',
                'inventario_editar',
                'inventario_eliminar',
                'acceso_gestionportales',
                'gp_menu_portalweb',
                'gp_configuracion_tema',
                'gp_publicacion_leer',
                'gp_publicacion_editar',
                'gp_publicacion_crear',
                'gp_publicacion_eliminar',
                'gp_menu_leer',
                'gp_menu_crear',
                'gp_menu_editar',
                'gp_menu_eliminar',
                'gp_pagina_leer',
                'gp_pagina_crear',
                'gp_pagina_editar',
                'gp_pagina_eliminar',
                'gp_taspagina_leer',
                'gp_taspagina_crear',
                'gp_taspagina_editar',
                'gp_taspagina_eliminar',
                'gp_categoria_leer',
                'gp_categoria_crear',
                'gp_categoria_editar',
                'gp_categoria_eliminar',
                'gp_anuncios_leer',
                'gp_anuncios_crear',
                'gp_anuncios_editar',
                'gp_anuncios_eliminar',
                'gp_seccion_leer',
                'gp_seccion_crear',
                'gp_seccion_editar',
                'gp_seccion_eliminar',
                'gp_enlaceref_leer',
                'gp_enlaceref_crear',
                'gp_enlaceref_editar',
                'gp_enlaceref_eliminar',
                'pg_menu_ciudadano',
                'pg_libroreclamaciones_leer',
                'pg_sugerencias_leer',
                'pg_menu_registrovisitas',
                'pg_registrovisitas_leer',
                'pg_registrovisitas_reporte',
                'pagina_pide',
                'gp_slider_leer',
                'gp_slider_editar',
                'gp_slider_crear',
                'gp_slider_eliminar'
            ]
        );

       // create a demo user
    //   $user = Factory(App\User::class)->create([
    //       'adm_name' => 'WILMER',
    //       'adm_lastname' => 'OCHOA ALVARADO',
    //       'adm_estado' => '1',
    //       'depe_id' => '2',
    //       'adm_correo' => 'woalvarado1@gmail.com',
    //       'adm_dni'=>'42282733',
    //       'adm_email'=>'WOCHOA2',
    //       // factory default password is 'password'
    //   ]);
    //   $user->assignRole($admin);
    }
}
