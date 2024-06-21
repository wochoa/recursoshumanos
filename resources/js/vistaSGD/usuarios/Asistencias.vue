<script>
import Layout from "../../layouts/main.vue";
import PageHeader from "../../components/page-header.vue";
import Datepicker from "vue3-datepicker";

import axios from 'axios';
import Paginate from 'vuejs-paginate-next';
/**
 * Starter component
 */
export default {
    page: {
        title: "Jobs List",
    },
    components: {
        Layout,
        PageHeader,
        Datepicker,
        paginate: Paginate,
    },
    data() {
        return {
            title: this.$route.meta.title,
            listDeleteModal: false,
            items: [{
                    text: "Usuarios",
                    href: "/"
                },
                {
                    text: this.$route.meta.title,
                    active: true
                }
            ],
            datepickervalue: new Date(),
            asistencias: {},
            frmbusqueda: {
                dni: '',
                fechaini: '',
                fechafin: '',
                page: ''
            }
        };
    },
    computed: {
        // ...Vuex.mapGetters(['getAllusuarios']),
        // usuarios() {
        //     return this.$store.state.usuarios.totaluser;
        // }
    },
    mounted() {
        this.Buscarusuarios();
    },
    methods: {
        Buscarusuarios(page = 1) {

            var url = '/asistencias'

            this.frmbusqueda.page = page

            axios.get(url, {
                params: this.frmbusqueda
            }).then(response => {
                this.asistencias = response.data
            })
        },
        primeraletra(string) {
            return string.charAt(0).toUpperCase();
        },
        upfechafinal() {
            this.frmbusqueda.fechafin = this.frmbusqueda.fechaini
        }
    }
};
</script>
<template>
<Layout>
    <PageHeader :title="title" :items="items" />

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom pt-1 pb-1">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">{{ $route.meta.title }}</h5>
                        <div class="flex-shrink-0">
                            <!-- <a href="#!" class="btn btn-primary me-1">Nuevo usuario</a>
                            <a href="#!" class="btn btn-light me-1"><i class="mdi mdi-refresh"></i></a> -->
                            <div class="dropdown d-inline-block">

                                <button type="menu" class="btn btn-success" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Exportar pdf</a></li>
                                    <li><a class="dropdown-item" href="#">Exportar excel</a></li>
                                    <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom pb-1 pt-1">
                    <form @submit.prevent="Buscarusuarios(frmbusqueda.page)">
                        <div class="row g-3">
                            <div class="col-xxl-4 col-lg-6 pt-4">
                                <input type="text" class="form-control" id="searchTableList" placeholder="DNI ..." v-model="frmbusqueda.dni" autofocus>
                            </div>

                            <div class="col-xxl-2 col-lg-3">
                                <label for="">Fecha inicio</label>
                                <input type="date" v-model="frmbusqueda.fechaini" class="form-control" placeholder="Fecha Inicio" @keyup="upfechafinal">
                            </div>
                            <div class="col-xxl-2 col-lg-3">
                                <label for="">Fecha fin</label>
                                <input type="date" v-model="frmbusqueda.fechafin" class="form-control" placeholder="Fecha fin">
                            </div>
                            <div class="col-xxl-2 col-lg-3 pt-4">
                                <button type="submit" class="btn btn-secondary"><i class="mdi mdi-filter-outline"></i>
                                    Buscar</button>
                            </div>
                            <div class="col-xxl-2 col-lg-3 pt-4" v-if="frmbusqueda.dni.length>=8">
                                <router-link :to="'/usuarios/asistencias/'+frmbusqueda.dni+'/record'" class="btn btn-info">
                                    <i class="mdi mdi-filter-outline align-middle"></i>
                                    Recor de asistencias
                                </router-link>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle dt-responsive nowrap w-100 table-check table-hover table-striped table-sm" id="job-list">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">DNI</th>
                                    <th scope="col">USUARIO</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">HORA</th>

                                    <th scope="col">ESTADO</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="list in asistencias.data" :key="list.dni">
                                    <th scope="row">{{ list.dni }}</th>
                                    <td>
                                        <small><b>Usuario:</b>{{ list.nombre_completo }}</small><br>
                                        <small><b>cargo:</b>{{ list.cargo }}</small><br>
                                        <small><b>Unidad:</b>{{ list.dependencia }}</small>
                                    </td>
                                    <td><small> {{ list.fecha }}</small></td>
                                    <td><small>{{ list.hora }}</small></td>

                                    <td><small>{{ list.estado }}</small></td>

                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View">
                                                <router-link to="/jobs/details" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></router-link>
                                            </li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit">
                                                <a href="#" class="btn btn-sm btn-soft-info"><i class="mdi mdi-pencil-outline"></i></a>
                                            </li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete">
                                                <b-button variant="soft-danger" class="btn-sm" @click="listDeleteModal = !listDeleteModal"><i class="mdi mdi-delete-outline"></i></b-button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- <paginate :page-count="asistencias.last_page" :page-range="3" :margin-pages="2" :click-handler="Buscarusuarios" :prev-text="'Prev'" :next-text="'Next'" :container-class="'pagination'" :page-class="'page-item'">
                    </paginate> -->

                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto me-auto">
                            <p class="text-muted mb-0">Mostrando <b>{{ asistencias.from }}</b> a <b>{{ asistencias.to }}</b> de <b>{{ asistencias.last_page }}</b> datos</p>
                        </div>
                        <div class="col-auto">
                            <div class="card d-inline-block ms-auto mb-0">
                                <div class="card-body p-2">
                                    <paginate :page-count="asistencias.last_page" :page-range="3" :margin-pages="2" :click-handler="Buscarusuarios" :prev-text="'<<'" :next-text="'>>'" :container-class="'pagination mb-0'" :page-class="'page-item'"></paginate>

                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!-- end table responsive -->
                </div>
                <!-- end card body -->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>

    <!-- The modal -->
    <b-modal v-model="listDeleteModal" hide-footer title="Delete" class="v-modal-custom">
        <p class="text-muted font-size-16 mb-4">are you sure want to delete?</p>
        <div class="modal-footer v-modal-footer">
            <b-button type="button" variant="light" @click="listDeleteModal = false">Close
            </b-button>
            <b-button type="button" variant="success">Save Changes</b-button>
        </div>
    </b-modal>
</Layout>
</template>
