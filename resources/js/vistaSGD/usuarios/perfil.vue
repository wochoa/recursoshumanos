<script>
import Layout from "../../layouts/main.vue";
import PageHeader from "../../components/page-header.vue";

import Profile from "../../components/sistemarrhh/perfil_gral.vue";
import Stat from "../../components/widgets/stat.vue";

import MarcacionesPersonal from "../calendario/MarcacionesPersonal.vue";
import MarcacionesPersonalcalendario from '../calendario/MarcacionesPersonalcalendario.vue';
import Infoperresumen from './Infoperresumen.vue';
import axios from 'axios';
/**
 * Contacts-Profile component
 */
export default {
    components: {
        Layout,
        PageHeader,
        Stat,
        Profile,
        MarcacionesPersonal,
        MarcacionesPersonalcalendario,
        Infoperresumen
    },
    data() {
        return {

            title: this.$route.meta.title,
            items: [{
                    text: "Contacts",
                    href: "/"
                },
                {
                    text: "Profile",
                    active: true
                }
            ],
            datospersonal: [],

        };
    },
    mounted() {
        this.misdatosescalafon();
    },
    computed: {
        datosdeluser() {
            return this.$store.state.auth.user.user;
        }
    },
    methods: {
        misdatosescalafon() {
            var url='/empleadoxdni'
            const params={
                dni:this.datosdeluser.adm_dni
            }
            axios.get(url,{
                params
            }).then(res=>{
                // console.log(res.data)
                this.datospersonal=res.data[0]
            })

        }
    }
};
</script>

<template>
<Layout>
    <PageHeader :title="title" :items="items" />
    <div class="row">
        <div class="col-xl-3">

            <Profile />

            <Infoperresumen :datosdeluser="datosdeluser" :datospersonal="datospersonal" />
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Experiencia</h4>
                    <div class>
                        <ul class="verti-timeline list-unstyled">
                            <li class="event-list active">
                                <div class="event-timeline-dot">
                                    <i class="bx bx-right-arrow-circle bx-fade-right"></i>
                                </div>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="bx bx-server h4 text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="font-size-15">
                                                <a href="javascript: void(0);" class="text-dark">Back end Developer</a>
                                            </h5>
                                            <span class="text-primary">2016 - 19</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="event-list">
                                <div class="event-timeline-dot">
                                    <i class="bx bx-right-arrow-circle"></i>
                                </div>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="bx bx-code h4 text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="font-size-15">
                                                <a href="javascript: void(0);" class="text-dark">Front end Developer</a>
                                            </h5>
                                            <span class="text-primary">2013 - 16</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="event-list">
                                <div class="event-timeline-dot">
                                    <i class="bx bx-right-arrow-circle"></i>
                                </div>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="bx bx-edit h4 text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="font-size-15">
                                                <a href="javascript: void(0);" class="text-dark">UI /UX Designer</a>
                                            </h5>
                                            <span class="text-primary">2011 - 13</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>

        <div class="col-xl-9">

            <MarcacionesPersonalcalendario :dni="datosdeluser.adm_dni" />
            <MarcacionesPersonal :dni="datosdeluser.adm_dni" />

        </div>
    </div>
    <!-- end row -->
</Layout>
</template>
