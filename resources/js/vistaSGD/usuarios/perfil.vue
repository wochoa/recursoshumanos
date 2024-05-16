<script>
import Layout from "../../layouts/main.vue";
import PageHeader from "../../components/page-header.vue";

import Profile from "../../components/sistemarrhh/perfil_gral.vue";
import Stat from "../../components/widgets/stat.vue";


/**
 * Contacts-Profile component
 */
export default {
    components: {
        Layout,
        PageHeader,
        Stat,
        Profile
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
            statData: [{
                    icon: "bx bx-check-circle",
                    title: "Completed Projects",
                    value: "125"
                },
                {
                    icon: "bx bx-hourglass",
                    title: "Pending Projects",
                    value: "12"
                },
                {
                    icon: "bx bx-package",
                    title: "Total Revenue",
                    value: "$36,524"
                }
            ]
        };
    }
};
</script>

<template>
<Layout>
    <PageHeader :title="title" :items="items" />
    <div class="row">
        <div class="col-xl-4">

            <Profile />

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Información del personal</h4>

                    <p class="text-muted mb-4">Hola xxxx, estos son tus datos, según nuestros registros</p>
                    <div class="table-responsive mb-0">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th scope="row">Nombres :</th>
                                    <td>Cynthia Price</td>
                                </tr>
                                <tr>
                                    <th scope="row">Telefono :</th>
                                    <td>(123) 123 1234</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail :</th>
                                    <td>cynthiaskote@gmail.com</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dirección :</th>
                                    <td>California, United States</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

        <div class="col-xl-8">
            <div class="row">
                <div v-for="stat of statData" :key="stat.icon" class="col-md-4">
                    <Stat :icon="stat.icon" :title="stat.title" :value="stat.value" />
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Mis asistencias</h4>
                    <div class="table-responsive mb-0">
                        <table class="table table-nowrap table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">NOMBRES</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">MARCACIÓN</th>
                                    <th scope="col">Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <th scope="row">42282733</th>
                                    <td>WILMER OCHOA ALVARADO</td>
                                    <td>2 Sep, 2019</td>
                                    <td>20 Oct, 2019</td>
                                    <td>$506</td>
                                </tr>

                                <tr>
                                    <th scope="row">2</th>
                                    <th scope="row">42282733</th>
                                    <td>WILMER OCHOA ALVARADO</td>
                                    <td>1 Sep, 2019</td>
                                    <td>2 Sep, 2019</td>
                                    <td>$94</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <th scope="row">42282733</th>
                                    <td>WILMER OCHOA ALVARADO</td>
                                    <td>21 Sep, 2019</td>
                                    <td>29 Sep, 2019</td>
                                    <td>$156</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <th scope="row">42282733</th>
                                    <td>WILMER OCHOA ALVARADO</td>
                                    <td>29 Sep, 2019</td>
                                    <td>04 Oct, 2019</td>
                                    <td>$122</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <th scope="row">42282733</th>
                                    <td>WILMER OCHOA ALVARADO</td>
                                    <td>05 Oct, 2019</td>
                                    <td>16 Oct, 2019</td>
                                    <td>$164</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <th scope="row">42282733</th>
                                    <td>WILMER OCHOA ALVARADO</td>
                                    <td>17 Oct, 2019</td>
                                    <td>05 Nov, 2019</td>
                                    <td>$192</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <th scope="row">42282733</th>
                                    <td>WILMER OCHOA ALVARADO</td>
                                    <td>04 Nov, 2019</td>
                                    <td>05 Nov, 2019</td>
                                    <td>$94</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</Layout>
</template>
