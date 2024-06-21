<script>
// import FullCalendar from "@fullcalendar/vue3";
// import esLocale from '@fullcalendar/core/locales/es';
// import dayGridPlugin from "@fullcalendar/daygrid";
// import timeGridPlugin from "@fullcalendar/timegrid";
// import interactionPlugin from "@fullcalendar/interaction";
// import bootstrapPlugin from "@fullcalendar/bootstrap5";
// import listPlugin from "@fullcalendar/list";

import Paginate from 'vuejs-paginate-next';
import axios from 'axios';

/**
 * Calendar component
 */

export default {
    props:['dni'],

    components: {
        paginate: Paginate,
    },
    data() {
        return {
            title: "Asistencia por Calendario",
            // items: [{
            //         text: "lista_asistencia",
            //         active: true,
            //     },
            //     {
            //         text: "Record de lista_asistencia",
            //         active: true,
            //     },
            // ],
            lista_asistencia:[]

        };
    },
    mounted() {
        this.consultadni();
    },
    methods: {
        consultadni(page = 1) {
            var url = '/listasistenciaxdni'
            // this.frmbusqueda.page=page
            const params = {
                dni: this.dni,
                page:page
            }
            axios.get(url, {
                params
            }).then(res => {
                // console.log(res.data);
                this.lista_asistencia = res.data
            })
        }
    },
};
</script>

<style>
.fc-theme-standard .fc-scrollgrid {
    border: 1px solid rgb(239, 242, 247) !important;
}
</style>

<template>
<!-- <Layout> -->
    <!-- <PageHeader :title="title" :items="items" /> -->
    <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-secondary text-center">Mis asistencia por maracciones</h4>
                    <div class="table-responsive mb-0">
                        <table class="table table-nowrap table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">NOMBRES</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">MARCACIÓN</th>
                                    <!-- <th scope="col">Budget</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in lista_asistencia.data">
                                    <th scope="row">{{ item.id }}</th>
                                    <th scope="row">{{ item.dni }}</th>
                                    <td>{{ item.nombre_completo }}</td>
                                    <td>{{ item.fecha }}</td>
                                    <td>{{ item.hora }}</td>
                                    <!-- <td>$506</td> -->
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto me-auto">
                            <p class="text-muted mb-0">Mostrando <b>{{ lista_asistencia.from }}</b> a <b>{{ lista_asistencia.to }}</b> de <b>{{ lista_asistencia.last_page }}</b> datos</p>
                        </div>
                        <div class="col-auto">
                            <div class="card d-inline-block ms-auto mb-0">
                                <div class="card-body p-2">
                                    <paginate :page-count="lista_asistencia.last_page" :page-range="3" :margin-pages="2" :click-handler="consultadni" :prev-text="'<<'" :next-text="'>>'" :container-class="'pagination mb-0'" :page-class="'page-item'"></paginate>

                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div>
            </div>
<!-- </Layout> -->
</template>
