<script>
import axios from 'axios'

export default {
    name: 'Resuempleado',

    data() {
        return {
            reporteempleado: {
                masculinos: null,
                femenino: null,
                casindeterminado: null,
                nombrado: null,
                temporal: null,
                directivo: null,
                medidacautelar: null,
                mandatojudicial: null,
                cassuplencia: null,
                designado276: null,
                mandatojudidatoscial: null,
                cassuplencia: null,
                designado276: null,
                total: null

            }
        };
    },

    mounted() {
        this.resumen();
    },

    methods: {
        resumen() {
            var url = '/resuempleado'
            axios.get(url).then(res => {
                this.reporteempleado = res.data
            })
        },
        procentaje(total,parte)
        {
            const x=(100*parte)/total;
            return Math.trunc(x)
        }

    },
};
</script>

<template>
<div>
    <div class="row">
        <!-- <div class="col-xl-4">
        </div> -->
        <div class="col-xl-12">
            <div class="row">

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body pt-0 pb-0">
                            <!-- <h4 class="card-title mb-1">Resumen de empleados</h4> -->

                            <div class="text-center">
                                <div class="mb-1">
                                    <i class="bx bx-user-circle  text-primary display-4"></i>
                                </div>
                                <h3>{{ reporteempleado.total }}</h3>
                                <p>Total de empleados registrados</p>
                            </div>

                            <div class="table-responsive mt-4">
                                <table class="table table-centered table-sm">
                                    <tbody>
                                        <tr>
                                            <td style="width: 140px">
                                                <p class="mb-0">Masculino</p>
                                            </td>
                                            <td style="width: 120px">
                                                <h5 class="mb-0">{{ reporteempleado.masculinos }}</h5>
                                            </td>
                                            <td>
                                                <b-progress :value="procentaje(reporteempleado.total,reporteempleado.masculinos)" variant="primary" height="5px"></b-progress>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="mb-0">Femenino</p>
                                            </td>
                                            <td>
                                                <h5 class="mb-0">{{ reporteempleado.femenino }}</h5>
                                            </td>
                                            <td>
                                                <b-progress :value="procentaje(reporteempleado.total,reporteempleado.femenino)" variant="success" height="5px"></b-progress>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td>
                                                <p class="mb-0">San Diego</p>
                                            </td>
                                            <td>
                                                <h5 class="mb-0">1,026</h5>
                                            </td>
                                            <td>
                                                <b-progress :value="70" variant="warning" height="5px"></b-progress>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body pt-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted">Cas indeterminado</p>
                                            <h4 class="mb-0">{{ reporteempleado.casindeterminado }}</h4>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-voice bx-tada font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body pt-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted">276 nombrado</p>
                                            <h4 class="mb-0">{{ reporteempleado.nombrado }}</h4>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-voice font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body pt-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted">CAS temporal</p>
                                            <h4 class="mb-0">{{ reporteempleado.temporal }}</h4>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-voice font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body pt-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted">directivo</p>
                                            <h4 class="mb-0">{{ reporteempleado.directivo }}</h4>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-voice font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body pt-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted">CAS Medida cautelar</p>
                                            <h4 class="mb-0">{{ reporteempleado.medidacautelar }}</h4>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-voice font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body pt-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted">276 mandato judicial</p>
                                            <h4 class="mb-0">{{ reporteempleado.mandatojudicial }}</h4>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-voice font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body pt-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted">CAS suplencia</p>
                                            <h4 class="mb-0">{{ reporteempleado.cassuplencia }}</h4>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-voice font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body pt-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted">276 designado</p>
                                            <h4 class="mb-0">{{ reporteempleado.designado276 }}</h4>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-voice font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>

            </div>

            <!-- <Emailsent /> -->
        </div>
    </div>
</div>
</template>
