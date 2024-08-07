<script>
import Layout from "../../layouts/main.vue";
import PageHeader from "../../components/page-header.vue";
import Datepicker from "vue3-datepicker";

import axios from 'axios';
/**
 * Starter component
 */
export default {
  page: {
    title: "Jobs List",
  },
  components: { Layout, PageHeader, Datepicker },
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
      getAllusuarios:{},
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
            var url = '/nuevoscas?page=' + page
            axios.get(url, {
                params: this.formData
            }).then(response => {
                this.getAllusuarios = response.data
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
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
              <h5 class="mb-0 card-title flex-grow-1">{{ $route.meta.title }}</h5>
              <div class="flex-shrink-0">
                <a href="#!" class="btn btn-primary me-1">Nuevo usuario</a>
                <a href="#!" class="btn btn-light me-1"><i class="mdi mdi-refresh"></i></a>
                <div class="dropdown d-inline-block">

                  <button type="menu" class="btn btn-success" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
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
              <!-- <div class="col-xxl-2 col-lg-4">
                <div id="datepicker1">
                  <Datepicker placeholder="Fecha" class="form-control" :first-day-of-week="1" lang="en" confirm>
                  </Datepicker>
                </div>
              </div> -->
              <div class="col-xxl-2 col-lg-4">
                <button type="button" class="btn btn-secondary w-100"><i class="mdi mdi-filter-outline align-middle"></i>
                  Filtrar</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table align-middle dt-responsive nowrap w-100 table-check table-hover table-bordered" id="job-list">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">DNI/CEL</th>
                    <th scope="col">N.PROCESO:</th>
                    <!-- <th scope="col">Location</th> -->
                    <!-- <th scope="col">Experience</th> -->
                    <!-- <th scope="col">Position</th> -->
                    <th scope="col">Tipo</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Término</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="list in getAllusuarios.data" :key="list.id">
                    <th scope="row">{{ list.iduser }}</th>
                    <td><small>{{ list.nombres }} {{ list.ap_paterno }} {{ list.ap_materno }} <br> <b>Correo:</b>{{ list.correo }} </small></td>
                    <td><small> <b>DNI:</b>{{ list.num_doc}} <br><b>Cel:</b>{{ list.telefono}}</small></td>
                    <td><small>..</small></td>
                    <!-- <td>California</td> -->
                    <!-- <td>0-2 Years</td> -->
                    <!-- <td>2</td> -->
                    <td><span class="badge badge-soft-success">Indeterminado</span></td>
                    <td>02 June 2021</td>
                    <td>25 June 2021</td>
                    <td v-if="list.adm_estado==1"><span class="badge bg-success">Active</span></td>
                    <td v-else="list.adm_estado==1"><span class="badge bg-danger">Active</span></td>
                    <td>
                      <ul class="list-unstyled hstack gap-1 mb-0">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View">
                          <router-link to="/usuarios/detalle" class="btn btn-sm btn-soft-primary" title="Ver"><i
                              class="mdi mdi-eye-outline"></i></router-link>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit">
                          <a href="#" class="btn btn-sm btn-soft-info" title="Editar"><i class="mdi mdi-pencil-outline"></i></a>
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
                <p class="text-muted mb-0">Showing <b>1</b> to <b>12</b> of <b>45</b> entries</p>
              </div>
              <div class="col-auto">
                <div class="card d-inline-block ms-auto mb-0">
                  <div class="card-body p-2">
                    <nav aria-label="Page navigation example" class="mb-0">
                      <ul class="pagination mb-0">
                        <li class="page-item">
                          <a class="page-link" href="javascript:void(0);" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                          </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">...</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">12</a></li>
                        <li class="page-item">
                          <a class="page-link" href="javascript:void(0);" aria-label="Next">
                            <span aria-hidden="true">»</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
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
