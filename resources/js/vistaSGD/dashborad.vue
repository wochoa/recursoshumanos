<script>
import Layout from "../layouts/main.vue";
import PageHeader from '../components/page-header.vue';

import Profile from "../components/sistemarrhh/perfil_gral.vue";
import Earning from "../components/widgets/earning.vue";
import Aplicativos from "../components/sistemarrhh/Aplicativos.vue";

// import show_alerta from '../funciones'

export default {

    components: {
        Layout,
        PageHeader,
        Profile,
        Earning,
        Aplicativos
    },
    data() {
        return {
            title: this.$route.meta.title,
            item: 'false',
            statData: [{
                    icon: "bx bx-help-circle",
                    title: "Sistema de tiket",
                    value: "Soporte técnico",
                    url: "/",
                    borde: "success"
                },
                {
                    icon: "bx bx-archive-in",
                    title: "Sistema de Convocatorias",
                    value: "comité de evaluación",
                    url: "/",
                    borde: "success"
                },
                {
                    icon: "bx bxl-vk",
                    title: "Sistema de gestión de portales",
                    value: "Administrador de webs",
                    url: "/",
                    borde: "success"
                },
                {
                    icon: "bx bxl-product-hunt",
                    title: "Sistema de proyectos",
                    value: "Administrador de proyectos",
                    url: "/",
                    borde: "success"
                },
                {
                    icon: "bx bx-store-alt",
                    title: "Sistema de PROMYPE",
                    value: "Dirección de producción",
                    url: "/",
                    borde: "success"
                },
                {
                    icon: "bx bxs-user",
                    title: "Sistema de escalafón",
                    value: "Recursos humanos SEDE",
                    url: "/",
                    borde: "warning"
                },
                {
                    icon: "bx bxs-taxi",
                    title: "Control vehicular",
                    value: "Servicios auxiliares",
                    url: "/",
                    borde: "info"
                },
                {
                    icon: "bx bx-edit",
                    title: "Gestión Documental",
                    value: "U. Transformación Digital",
                    url: "/",
                    borde: "success"
                },
                {
                    icon: "bx bxs-file-pdf",
                    title: "Normatividad regional",
                    value: "U. Transformación Digital",
                    url: "/",
                    borde: "success"
                },
                {
                    icon: "bx bxs-copy-alt",
                    title: "Expedientes judiciales",
                    value: "Procuraduria pública regional",
                    url: "/",
                    borde: "info"
                },
                {
                    icon: "bx bxs-user-detail",
                    title: "Control de asistencias",
                    value: "Recursos Humanos",
                    url: "/",
                    borde: "danger"
                },
                {
                    icon: "bx bxs-bus",
                    title: "Gestion de vacaciones",
                    value: "Recursos Humanos",
                    url: "/",
                    borde: "danger"
                },
                {
                    icon: "bx bx-mail-send",
                    title: "Correo insitucional",
                    value: "U. Transformación Digital",
                    url: "/",
                    borde: "info"
                },
                {
                    icon: "bx bx-money",
                    title: "Boletas de pago",
                    value: "Recursos humanos",
                    url: "/",
                    borde: "danger"
                },
                {
                    icon: "bx bx-money",
                    title: "Sistema de fedatarios",
                    value: "Fedatarios GRH",
                    url: "/",
                    borde: "danger"
                }
            ],
        }
    },
    mounted() {
        // this.cargadatos();
        // show_alerta('Bien heccho','Fue aceptado','success');
    },

    methods: {
        // cargadatos()
        // {
        //     this.$store.dispatch('usuarios/Totalusuarios');
        // }
    }
}
</script>

<template>
<Layout>
    <PageHeader :title="title" :items="items" />
    <!-- start page title -->
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active">Welcome to Skote Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> -->
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-4">
            <Profile />
            <!-- <Earning /> -->
        </div>
        <!-- end col -->

        <!-- mostramos las palicaciones del GRH -->
        <div class="col-xl-8">
            <div class="row">
                <div v-for="stat of statData" :key="stat.icon" class="col-md-4">
                    <Aplicativos :icon="stat.icon" :title="stat.title" :value="stat.value" :url="stat.url" :borde="stat.borde" />
                </div>
            </div>

            <!-- Email sent -->
            <!-- <Emailsent /> -->
        </div>
    </div>
    <!-- end row -->
</Layout>
</template>
