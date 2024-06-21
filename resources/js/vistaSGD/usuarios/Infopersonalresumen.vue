<script>
/**
 * Contacts-Profile component
 */
export default {
    props: ['datosdeluser', 'datospersonal'],
    components: {

    },
    data() {
        return {

        };
    },
    // computed: {
    //     datosdeluser() {
    //         return this.$store.state.auth.user.user;
    //     }
    // }
    methods:{
        honomastico(fecha)
        {
            var datos=fecha.trim();//.substr(-5,5);
            console.log(fecha);
            // return datos;
        }
    }
};
</script>

<template>
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Información del personal</h4>

        <p class="text-muted mb-4">Hola <b>{{datosdeluser.fullname}}</b>, estos son tus datos, según nuestros registros</p>
        <div class="table-responsive mb-0">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <!-- <th scope="row"></th> -->
                        <td><b>Nombres</b> :<br><i class="bx bxs-user"></i>{{datospersonal.nombres?datospersonal.nombres+''+datospersonal.apellidos:datosdeluser.fullname}}</td>
                    </tr>
                    <tr>
                        <!-- <th scope="row">Teléfono :</th> -->
                        <td><b>Teléfono</b> :<br><i class="bx bx-phone"></i>{{datospersonal.celular?datospersonal.celular:datosdeluser.adm_telefono}}</td>
                    </tr>
                    <tr>
                        <!-- <th scope="row">E-mail inst :</th> -->
                        <td><b>E-mail institucional</b> :<br><i class="bx bx-mail-send"></i>{{datospersonal.correoinst?datospersonal.correoinst:datosdeluser.adm_correo}}</td>
                    </tr>
                    <tr>
                        <!-- <th scope="row">E-mail per :</th> -->
                        <td><b>E-mail persoanl</b> :<br><i class="bx bx-mail-send"></i>{{datospersonal.correo?datospersonal.correo:datosdeluser.adm_correo}}</td>
                    </tr>
                    <tr>
                        <!-- <th scope="row">Dirección :</th> -->
                        <td><b>Dirección</b> :<br> <i class="bx bx-target-lock"></i> {{ datospersonal.direccion }}</td>
                    </tr>
                    <tr>
                        <td><b>Fecha nacimiento</b> :<br> <i class="bx bx-happy-heart-eyes"></i> {{ datospersonal.nacimiento }}</td>
                    </tr>
                    <!-- <tr>
                        <td><b>fecha nacimiento</b> :<br> <i class="bx bx-happy-heart-eyes"></i> {{ datospersonal.nacimiento}}</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>
