<script>
import FullCalendar from "@fullcalendar/vue3";
import esLocale from '@fullcalendar/core/locales/es';
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import bootstrapPlugin from "@fullcalendar/bootstrap5";
import listPlugin from "@fullcalendar/list";

// import Layout from "../../layouts/main.vue";
// import PageHeader from "../../components/page-header.vue";
import axios from 'axios';

/**
 * Calendar component
 */

export default {
    props:['dni'],

    components: {
        FullCalendar,
        // Layout,
        // PageHeader,
    },
    data() {
        return {
            title: "Asistencia por Calendario",
            items: [{
                    text: "Asistencias",
                    active: true,
                },
                {
                    text: "Record de asistencias",
                    active: true,
                },
            ],
            calendarEvents: null, //calendarEvents,
            calendarOptions: {
                locale: esLocale,
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
                },
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin,
                    bootstrapPlugin,
                    listPlugin,
                ],
                initialView: "dayGridMonth",
                themeSystem: "bootstrap",
                initialEvents: [], //calendarEvents,
                editable: true,
                droppable: true,
                eventResizableFromStart: true,
                // dateClick: this.dateClicked,
                // eventClick: this.editEvent,
                // eventsSet: this.handleEvents,
                weekends: true,
                selectable: true,
                events: [],
                selectMirror: true,
                dayMaxEvents: true,
            },

            datosasistencias: [],
            // dniuser: this.$route.params.dni
        };
    },
    mounted() {
        this.consultadni();
    },
    methods: {
        consultadni() {
            // var url = '/asistenciaxdni'
            var url = '/biotime/marcacionxdni'
            const params = {
                dni: this.dni
            }
            axios.get(url, {
                params
            }).then(res => {
                // console.log(res.data);
                this.datosasistencias = res.data.resumen
                this.calendarOptions.events = res.data.asistencias
                this.calendarEvents = res.data.asistencias
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
    <!-- <div class="row">
        <div class="col-sm-6 mb-2">
            <router-link to="/usuarios/asistencias" class="btn btn-sm btn-info">Volver a asistencias</router-link>
        </div>
    </div> -->
    <div class="row">
        <h4 class="text-center text-info">Resumen de Asistencias</h4>
        <div class="col-sm-3">
            <div class="blog-stats-wid card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="me-3">
                            <p class="text-success mb-2">Días puntual</p>
                            <h5 class="mb-0">{{ datosasistencias.diapuntual }}</h5>
                        </div>
                        <div class="avatar-sm ms-auto">
                            <div class="avatar-title bg-success rounded-circle text-light font-size-20"><i class="bx bx-time-five bx-spin"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="blog-stats-wid card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="me-3">
                            <p class="text-info mb-2">Días tarde</p>
                            <h5 class="mb-0">{{ datosasistencias.diastarde }}</h5>
                        </div>
                        <div class="avatar-sm ms-auto">
                            <div class="avatar-title bg-info rounded-circle text-light font-size-24"><i class="bx bxs-timer"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="blog-stats-wid card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="me-3">
                            <p class="text-danger mb-2">Falta día completo</p>
                            <h5 class="mb-0">{{ datosasistencias.faltadiacompleto }}</h5>
                        </div>
                        <div class="avatar-sm ms-auto">
                            <div class="avatar-title bg-danger rounded-circle text-light font-size-20"><i class="bx bxs-book-bookmark"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="blog-stats-wid card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="me-3">
                            <p class="text-warning mb-2">Falta medio dia</p>
                            <h5 class="mb-0">{{ datosasistencias.faltafaltamediodia }}</h5>
                        </div>
                        <div class="avatar-sm ms-auto">
                            <div class="avatar-title bg-warning rounded-circle text-light font-size-20"><i class="bx bxs-book-bookmark"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="app-calendar">
                    <h4 class="text-center text-success">Asistencias por calendario</h4>
                        <FullCalendar ref="fullCalendar" :options="calendarOptions"></FullCalendar>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- </Layout> -->
</template>
