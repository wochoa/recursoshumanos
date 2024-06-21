<script>
import Layout from "../../layouts/main.vue";
import PageHeader from "../../components/page-header.vue";
import Datepicker from "vue3-datepicker";
import Resumenempleado from "./Resuempleados.vue";
import Paginate from 'vuejs-paginate-next';

import axios from 'axios';
/**
 * Starter component
 */
export default {
  page: {
    title: "Jobs List",
  },
  components: { Layout, PageHeader, Datepicker,Resumenempleado,paginate: Paginate, },
  data() {
    return {
      title: this.$route.meta.title,
      listDeleteModal: false,
      items: [
        {
          text: "Usuarios",
          href: "/"
        },
        {
          text: this.$route.meta.title,
          active: true
        }
      ],
      datepickervalue: new Date(),
      empleados:{},
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
    methods:{
        Buscarusuarios(page = 1) {
            var url = '/empleados?page=' + page
            axios.get(url, {
                params: this.formData
            }).then(response => {
                this.empleados = response.data
            })
            //     } else {
            //         console.log('incompleto')
            //     }
            // })
        },
        primeraletra(string)
        {
            return string.charAt(0).toUpperCase();
        }
    }
};
</script>
<template>
  <Layout>
    <PageHeader :title="title" :items="items" />
    <Resumenempleado />
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
              <h5 class="mb-0 card-title flex-grow-1">{{ $route.meta.title }}</h5>
              <div class="flex-shrink-0">
                <a href="#!" class="btn btn-primary me-1"> <i class="mdi mdi-account-plus"></i> Nuevo empleado</a>
                <a href="#!" class="btn btn-light me-1"><i class="mdi mdi-refresh"></i> Sincronizar</a>
                <div class="dropdown d-inline-block">

                  <button type="menu" class="btn btn-success" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Exportar pdf</a></li>
                                    <li><a class="dropdown-item" href="#">Exportar excel</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body border-bottom">
            <div class="row g-3">
              <div class="col-xxl-4 col-lg-6">
                <input type="search" class="form-control" id="searchTableList" placeholder="Buscar ...">
              </div>
              <div class="col-xxl-2 col-lg-6">
                <select class="form-select" id="idStatus" aria-label="Default select example">
                  <option value="all">Estado</option>
                  <option value="Active">Active</option>
                  <option value="New">Nuevo</option>
                  <option value="Close">Desactivado</option>
                </select>
              </div>
              <div class="col-xxl-2 col-lg-4">
                <select class="form-select" id="idType" aria-label="Default select example">
                  <option value="all">Tipo Regimen</option>
                  <option value="Full Time">276</option>
                  <option value="Part Time">1057</option>
                  <option value="Part Time">728</option>
                </select>
              </div>
              <div class="col-xxl-2 col-lg-4">
                <div id="datepicker1">
                  <!-- <Datepicker placeholder="Fecha" class="form-control" :first-day-of-week="1" lang="en" confirm>
                  </Datepicker> -->
                  <input type="date" class="form-control">
                </div>
              </div>
              <div class="col-xxl-2 col-lg-4">
                <button type="button" class="btn btn-secondary w-100"><i class="mdi mdi-filter-outline align-middle"></i>
                  Filtrar</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table align-middle dt-responsive nowrap w-100 table-check table-hover" id="job-list">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">DNI/CEL</th>
                    <th scope="col">F.Nacimiento</th>
                    <!-- <th scope="col">Location</th> -->
                    <!-- <th scope="col">Experience</th> -->
                    <!-- <th scope="col">Position</th> -->
                    <th scope="col">Regimen</th>
                    <th scope="col">Vinculo</th>
                    <!-- <th scope="col">Término</th> -->
                    <th scope="col">Sexo</th>
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="list in empleados.data" :key="list.id">
                    <th scope="row">{{ list.id }}</th>
                    <td><small>{{ list.nombres }} {{ list.apellidos}}<br><b>Cargo actual:</b>{{ list.cargoactual}} </small></td>
                    <td><small> <b>DNI:</b>{{ list.dni}} <br><b>Cel:</b>{{ list.celular}}</small></td>
                    <td><small>{{ list.nacimiento }}</small></td>
                    <!-- <td>California</td> -->
                    <!-- <td>0-2 Years</td> -->
                    <!-- <td>2</td> -->
                    <!-- <td><span class="badge badge-soft-success">Indeterminado</span></td> -->
                    <td><small>{{ list.regimen }}</small></td>
                    <td><small>{{ list.vinculo }}</small></td>
                    <!-- <td>25 June 2021</td> -->
                    <td v-if="list.sexo=='MA'"><span class="me-1 badge bg-primary rounded-pill">Masculino</span></td>
                    <td v-else><span class="me-1 badge bg-danger rounded-pill">Femenino</span></td>
                    <!-- <td v-else="list.adm_estado==1"><span class="badge bg-danger">Active</span></td> -->
                    <td>
                      <ul class="list-unstyled hstack gap-1 mb-0">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View">
                          <router-link to="/usuarios/detalle" class="btn btn-sm btn-soft-primary" title="Ver"><i
                              class="mdi mdi-eye-outline"></i></router-link>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit">
                          <a href="#" class="btn btn-sm btn-soft-info" title="Editar"><i class="mdi mdi-pencil-outline"></i></a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit">
                          <a href="#" class="btn btn-sm btn-soft-warning" title="Movimiento"><i class="mdi mdi-human-capacity-decrease"></i></a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit">
                          <a href="#" class="btn btn-sm btn-soft-success" title="Vacaciones"><i class="mdi mdi-calendar"></i></a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit">
                          <a href="#" class="btn btn-sm btn-soft-danger" title="Permisos y licencias"><i class="mdi mdi-account-heart"></i></a>
                        </li>

                      </ul>
                    </td>
                  </tr>

                </tbody>
              </table>
              <!-- end table -->
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-auto me-auto">
                            <p class="text-muted mb-0">Mostrando <b>{{ empleados.from }}</b> a <b>{{ empleados.to }}</b> de <b>{{ empleados.last_page }}</b> datos</p>
                        </div>
              <div class="col-auto">
                <div class="card d-inline-block ms-auto mb-0">
                  <div class="card-body p-2">
                    <paginate :page-count="empleados.last_page" :page-range="3" :margin-pages="2" :click-handler="Buscarusuarios" :prev-text="'<<'" :next-text="'>>'" :container-class="'pagination mb-0'" :page-class="'page-item'"></paginate>

                  </div>
                </div>
              </div>
              <!--end col-->
            </div>
            <!-- end table responsive -->
          </div>
          <!-- end card body -->
        </div><!--end card-->
      </div><!--end col-->
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
