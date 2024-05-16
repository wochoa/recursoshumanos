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
            var url = '/listausuarios?page=' + page
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
            <div class="row g-3">
              <div class="col-xxl-4 col-lg-6">
                <input type="search" class="form-control" id="searchTableList" placeholder="Registro SGD ..." value="04723012">
              </div>

              <div class="col-xxl-2 col-lg-4">
                <button type="button" class="btn btn-secondary w-100"><i class="mdi mdi-account-search align-middle"></i>
                  Buscar</button>
              </div>
            </div>
          </div>
          <div class="card-body pt-0 pb-0">
            <div class="table-responsive">
              <table class="table align-middle dt-responsive nowrap w-100 table-check table-hover table-bordered table-sm" id="job-list">
                <thead>
                  <tr>
                    <th scope="col">REGISTRO<br>EXPEDIENTE </th>
                    <th scope="col">DOCUMENTO</th>
                    <th scope="col">DESTINO</th>
                    <th scope="col">ARCHIVO</th>
                    <th scope="col">ACCIONES</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><small>Reg. 04723012<br>
                                    Exp. 02773151
                                    REGISTRADO</small>
                    </th>

                    <td>
                        <small>
                        Fecha:2024-04-10 16:10:01 <br>
                        Forma:ORIGINAL<br>
                        Folios:1<br>
                        Proveido:
                        Tipo:
                    </small>
                    <br>
                    <small>
                        Doc:MEMORANDUM MULTIPLE 000198-2024-GRH/GGR <br> Firma:LESLIE CAROL ZEVALLOS QUINTEROS<br>Cargo:GERENTE GENERAL REGIONAL<br>Asunto:ASISTENCIA TÉCNICA PARA EL USO DE LA FIRMA DIGITALDependencia:GERENCIA GENERAL REGIONAL
                        </small></td>
                    <td><small>....s.</small></td>

                    <td><span class="badge badge-soft-success"><button data-v-757b3b11="" type="button" class="btn btn-xs btn-link doc-link"><span data-v-757b3b11="" style="color: blue; font-size: 80%;">180.89 KB</span> <span data-v-757b3b11="" class="badge badge-danger">
                                P
                              </span> <span data-v-757b3b11="" class="glyphicon glyphicon-file"></span>
                              MEMO MUL 198 2024.pdf
                            </button></span>
                    </td>
                    <td>
                    <button class="btn btn-primary btn-sm" @click="listDeleteModal = !listDeleteModal"> <i class="bx bx-user-voice"></i> Atender </button>
                    </td>
                  </tr>

                </tbody>
              </table>
              <!-- end table -->
            </div>

            <!-- end table responsive -->
          </div>
          <!-- end card body -->
        </div><!--end card-->
      </div><!--end col-->
    </div>

    <!-- The modal -->
    <b-modal v-model="listDeleteModal" hide-footer title="Atender certificado/constancia" class="v-modal-custom" size="lg">
      <div class="form-group row">
            <label for="" class="col-sm-3">Solicitante</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" placeholder="Nombres del solicitante" value="WILMER OCHAO ALVARADO">
            </div>
      </div>
      <div class="form-group row">
            <label for="" class="col-sm-3">Incio de contrato</label>
            <div class="col-sm-3">
                <input type="date" class="form-control form-control-sm" placeholder="Nombres del solicitante" value="WILMER OCHAO ALVARADO">
            </div>
            <label for="" class="col-sm-3">Fin de contrato</label>
            <div class="col-sm-3">
                <input type="date" class="form-control form-control-sm" placeholder="Nombres del solicitante" value="WILMER OCHAO ALVARADO">
            </div>
      </div>
      <div class="modal-footer v-modal-footer mt-2">
        <b-button type="button" variant="light" @click="listDeleteModal = false">Cerrar
        </b-button>
        <b-button type="button" variant="success">Registros</b-button>
      </div>
    </b-modal>
  </Layout>
</template>
