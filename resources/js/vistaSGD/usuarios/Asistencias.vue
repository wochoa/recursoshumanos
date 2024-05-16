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
      asistencias:{},
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
            var url = '/aistencias?page=' + page
            axios.get(url, {
                params: this.formData
            }).then(response => {
                this.asistencias = response.data
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
                <input type="search" class="form-control" id="searchTableList" placeholder="DNI ...">
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
                <label for="">Fecha inicio</label>
                <input type="date" name="" value="" class="form-control" placeholder="Fecha Inicio">
              </div>
              <div class="col-xxl-2 col-lg-4">
              <label for="">Fecha fin</label>
                <input type="date" name="" value="" class="form-control" placeholder="Fecha fin">
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
                    <th scope="col">fecha</th>

                    <th scope="col">hora</th>
                    <!-- <th scope="col">Fecha</th> -->
                    <!-- <th scope="col">Término</th> -->
                    <!-- <th scope="col">Estado</th> -->
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="list in asistencias.data" :key="list.idasistencia">
                    <th scope="row">{{ list.idempleado }}</th>
                    <td><small>{{ list.nombres }}</small></td>
                    <td><small> <b>DNI:</b>{{ list.idempleado}}</small></td>
                    <td><small>{{ list.fecha }}</small></td>
                    <!-- <td>California</td> -->
                    <!-- <td>0-2 Years</td> -->
                    <!-- <td>2</td> -->
                    <td><small>{{ list.hora }}</small></td>
                    <!-- <td>02 June 2021</td> -->
                    <!-- <td>15-04-2024</td> -->
                    <!-- <td v-if="list.adm_estado==1"><span class="badge bg-success">Active</span></td>
                    <td v-else="list.adm_estado==1"><span class="badge bg-danger">Active</span></td> -->
                    <td>
                      <ul class="list-unstyled hstack gap-1 mb-0">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View">
                          <router-link to="/jobs/details" class="btn btn-sm btn-soft-primary"><i
                              class="mdi mdi-eye-outline"></i></router-link>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit">
                          <a href="#" class="btn btn-sm btn-soft-info"><i class="mdi mdi-pencil-outline"></i></a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete">
                        <b-button variant="soft-danger" class="btn-sm" @click="listDeleteModal = !listDeleteModal"><i
                              class="mdi mdi-delete-outline"></i></b-button>
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
