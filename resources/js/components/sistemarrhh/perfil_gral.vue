<script>
import profileImg from '../../../images/profile-img.png';
import avatar1 from '../../../images/users/avatar-2.jpg';
import Vuex from 'vuex'
// import {mapGetters}  from 'vuex'
/**
 * Profile component
 */
export default {
    data() {
        return {
            profileImg,
            avatar1,
            datouser: '', //localStorage.getItem('user'),
            usuario: {}
        }

    },
    computed: {
        datosdeluser() {
            return this.$store.state.auth.user.user;
        }
    },
    mounted() {
        // this.iniciadatos()
        // this.usuario = JSON.parse(this.datouser).user;
    },

    methods: {
        // iniciadatos() {
        //     this.usuario = JSON.parse(this.datouser).user;
        // }
    }
};
</script>
<template>
<div class="card overflow-hidden">
    <div class="bg-soft bg-primary">
        <div class="row">
            <div class="col-7">
                <div class="text-primary p-3">
                    <h5 class="text-primary">Bienvenido</h5>
                    <p>al Sistema de Gore Digital</p>
                </div>
            </div>
            <div class="col-5 align-self-end">
                <img :src="profileImg" alt class="img-fluid" />
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="avatar-md profile-user-wid mb-4">
                    <img :src="avatar1" alt class="img-thumbnail rounded-circle" />
                </div>
                <h5 class="font-size-15 text-truncate">{{ datosdeluser.fullname }}</h5>
                <p class="text-muted mb-0 text-truncate">{{ datosdeluser.adm_cargo }} </p>
            </div>

            <div class="col-sm-12">
                <div class="pt-4">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-size-15">Dni</h5>
                            <p class="text-muted mb-0">{{ datosdeluser.adm_dni }}</p>
                        </div>
                        <div class="col-8">
                            <h5 class="font-size-15">Oficina</h5>
                            <p class="text-muted mb-0">Revenue</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <router-link  class="btn btn-primary btn-sm" to="/usuario/perfil">
                            Ver perfil
                            <i class="mdi mdi-arrow-right ms-1"></i>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card-body -->
</div>
<!-- end card -->
</template>
