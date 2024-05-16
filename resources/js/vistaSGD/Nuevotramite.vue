<script>
import Layout from "../layouts/main.vue";
import PageHeader from '../components/page-header.vue';

export default {

    components: {
        Layout,
        PageHeader
    },
    data() {
        return {
            title: this.$route.meta.title,
            item: 'false',

            formdocumentos: {
                expediente: '',
                referencias: '',
                array_referencias: [], // referencias al documento
                json_referencias: [], // referencias al documento en formato json
                camporeferencia: '',
                frregistro: 1, // tramite interno 1  externo 2
                codigounidad: '', // captura de tabla admin a donde pertenece el usuario
                nombre_oficina: '',
                tipotramite: false, //o: represnetante oficina 1: tramite personal
                idusercreador: '', // iduser el id de user el que crea
                firma: '',
                cargo: '',
                firmadestino: '', //firma de destino
                cargodestino: '', // cargo destino
                fechatramite: '', // new Date().toISOString().substr(0, 10),
                tipodocumento: '', //codigo del tipo de documento
                correlativodoc: '',
                newcorrelativodoc: '',
                siglasdoucmento: '',
                ciudad: '',
                direccion: '',
                clavedoc: '',
                formarecepcion: 1,
                prioridad: 1,
                folios: '',
                asunto: '',
                formaderivacion: false,
                cod_unidad: '', // codigo unidad a donde derviva
                unidadorganica: '', // nombre unidad a quien se deriva
                detalle: '',
                usuario: '', //codigo de usuario a quien se deriva cuando es en la misma unidad
                proveido: '', // proveido destino
                derivaciones: [], // las unidades dondde derivaran respectivas unidades
                json_derivaciones: [], //las unidades dondde derivaran respectivas unidades en formato json
                operaciones: []
            },
            listadocumento: {},
            datosuser: {},
            listadependencias: {},
            nombredocumento: '',
            nombrearchivo: '', // para verificar si existe la plantilla cargada en word
            nombredoc_export: '',
            listadouser: {},
            representantedestino: {},
            showdiv: false,
            mostrarpdf: true,
            mdlInvoker: true,
            mostrarposicionfrima: false,
            showtabladerivaciones: false,
            isDisabled_btngenerar: false,
            btn_sincronizar: false,
            btn_anexo: true,
            btn_cargarpdf: true,
            btn_cargarword: true,

            modal: false,
            files: [], // principal
            anexosfiles: [],
            /// validaciones /////
            valida_tipodoc: '',
            valida_folios: '',
            valida_asunto: '',
            //  deatalleuser:{}

            // DATOS PARA REFIRMA INVOKER
            iframe: {
                src: null,
                loaded: false,
                type: null
            },
            resultado: {
                documento: '',
                expediente: ''
            },
            // archivo existente para firmar
            ArchivoFirma: '', // retorno del patch de pdf cargado para ser firmado
            Existe: 0, // 0:no existe el archivo para la firma, 1: existe archiv para firma => activamos el boton para firmar
            EstadoFirma: false, // habilitar boton firmar digitalmente
            btngenerartramite: true,
            btngenerarnewtramite: false,
            idfile: '',
            idtramdoc: '',
            formData: {},
            expediente: {
                iddocumentomain: null,
                doc: []
            },
            habilitarboton: false
        }
    },
}
</script>

<template>
<Layout>
    <PageHeader :title="title" :items="items" />

    <div class="container-fluid">
        <div class="row mt-10">
            <div class="col-lg-6 col-10">
                <router-link :to="'/Tramites/Enproceso'" class="btn btn-info btn-sm"><i class="fa-regular fa-circle-left"></i>Volver a documentos en proceso</router-link>
            </div>

        </div>

        <div class="row justify-content-center mt-2">

            <div class="col-8">
                <div class="card card-primary card-outline card-revenue-budget">

                    <div class="card-body pb-0">

                        <div class="row">

                            <div class="col-sm-12 revenue-report-wrapper">
                                <div class="border border rounded p-1">
                                    <div class="form-group row">
                                        <label class="col-sm-3">Expediente:</label>
                                        <div class="col-sm-3">
                                            <input type="number" v-if="expediente.iddocumentomain" disabled class="form-control form-control-sm" placeholder="N°" v-model="formdocumentos.expediente">
                                            <input type="number" v-else class="form-control form-control-sm" placeholder="N°" v-model="formdocumentos.expediente">
                                        </div>
                                        <div class="col-sm-6">
                                            Expediente de respuesta
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Referencias:</label>
                                        <div class="col-sm-9">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td width="185"><input type="number" class="form-control form-control-sm" placeholder="Reg. documento" v-model="formdocumentos.camporeferencia"></td>
                                                            <td class="text-center" @click.prevent="agregarreferenias"><i class="bx bxs-zoom-in"></i></td>
                                                        </tr>
                                                        <tr v-for="(find, index) in formdocumentos.array_referencias">
                                                            <td width="90%">
                                                                <input v-model="find.value" :key="index" class="form-control form-control-sm text-uppercase" placeholder="Referencia"></td>
                                                            <td>
                                                                <button class="btn btn-default btn-sm" @click.prevent="eliminarefe(index)"><i class="fa-solid fa-trash-can"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="border border rounded p-1 mt-1">
                                    <div class="form-group row">
                                        <label class="col-sm-3">Forma de registro <span class="text-red">(*)</span>:</label>
                                        <div class="col-sm-9">
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline" style="margin-top: 0rem !important;">
                                                    <input type="radio" name="inlineRadioOptions" value="1" checked v-model="formdocumentos.frregistro" />
                                                    <label class="form-check-label">Interno</label>
                                                </div>
                                                <div class="form-check form-check-inline" style="margin-top: 0rem !important;">
                                                    <input type="radio" name="inlineRadioOptions" value="2" v-model="formdocumentos.frregistro" />
                                                    <label class="form-check-label">Para externo</label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Tipo <span class="text-red">(*)</span>:</label>

                                        <div class="col-sm-6">
                                            <div class="demo-inline-spacing">

                                                <div class="form-check form-check-inline" style="margin-top: 0rem !important;">
                                                    <!-- {{ persona() }} -->
                                                    <input type="checkbox" v-model="formdocumentos.tipotramite" @change="tipostramite" disabled />
                                                    <label class="form-check-label">Documento Personal</label>
                                                </div>
                                                <!-- <div class="form-check form-check-inline" style="margin-top: 0rem !important;" v-else>
                                                        <input type="checkbox" v-model="formdocumentos.tipotramite" @change="tipostramite" />
                                                        <label class="form-check-label">Documento Personal</label>
                                                    </div> -->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Unidad Org:</label>
                                        <div class="col-sm-9">
                                            {{ formdocumentos.codigounidad }} - {{ formdocumentos.nombre_oficina }}
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Firma:</label>
                                        <div class="col-sm-9">
                                            {{ formdocumentos.firma }}
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Cargo:</label>
                                        <div class="col-sm-9">
                                            {{ formdocumentos.cargo}}
                                        </div>

                                    </div>
                                </div>
                                <div class="border border rounded p-1 mt-1">
                                    <div class="form-group row">
                                        <label class="col-sm-3">Fecha <span class="text-red">(*)</span>:</label>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control form-control-sm" placeholder="N°" v-model="formdocumentos.fechatramite" id="fechadate">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Tipo de Documento <span class="text-red">(*)</span>:</label>
                                        <div class="col-sm-9">

                                            <select v-model="formdocumentos.tipodocumento" :class="'form-control form-control-sm '+valida_tipodoc" placeholder="Elijir el documento" @change="nomdoc" required>
                                                <option v-for="list in listadocumento" :key="list.idtdoc" :value="list.idtdoc">{{ list.tdoc_descripcion }}</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Número y Siglas <span class="text-red">(*)</span>:</label>
                                        <div class="col-sm-2" v-if="formdocumentos.correlativodoc!=1">
                                            <input type="text" class="form-control form-control-sm" v-model="formdocumentos.correlativodoc" readonly>
                                        </div>
                                        <div class="col-sm-2" v-else>
                                            <input type="text" class="form-control form-control-sm" v-model="formdocumentos.newcorrelativodoc">
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" readonly="readonly" v-model="formdocumentos.siglasdoucmento">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Forma Recepción:</label>
                                        <div class="col-sm-3">
                                            <select class="form-control form-control-sm" v-model="formdocumentos.formarecepcion">
                                                <option value="1">DIRECTA</option>
                                                <option value="2">FAX</option>
                                                <option value="3">VIA WEB</option>
                                                <option value="5">CEN.MED. S.M.CAUTIVO</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-3">Prioridad:</label>
                                        <div class="col-sm-3">
                                            <select class="form-control form-control-sm" v-model="formdocumentos.prioridad">
                                                <option value="1">NORMAL</option>
                                                <option value="2">URGENTE</option>
                                                <option value="2">DOCU MINEDU</option>
                                                <option value="2">DOCU DRE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Folios <span class="text-red">(*)</span>:</label>
                                        <div class="col-sm-3">
                                            <input type="number" :class="'form-control form-control-sm  '+ valida_folios" placeholder="N°" v-model="formdocumentos.folios" min="1" pattern="^[0-9]+">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Asunto <span class="text-red">(*)</span>:</label>
                                        <div class="col-sm-9">
                                            <textarea :class="'form-control form-control-sm text-uppercase '+ valida_asunto" rows="2" placeholder="Asunto" v-model="formdocumentos.asunto"></textarea>
                                        </div>

                                    </div>

                                    <!-- mostrar los archivos cargados -->
                                    <div class="form-group  mt-1">

                                        <div v-for="(file, key) in files" class="row border-top">

                                            <div class="col-sm-7" v-if="getFileExtension3(file.name)=='pdf'">

                                                <i class="fa-regular fa-file-pdf"></i>
                                                <small class="text-primary">{{ file.name }} <span class="badge float-right badge-light-info badge-pill">{{tamaniofile(file.size)}}</span></small>
                                            </div>
                                            <div class="col-sm-7" v-else>

                                                <i class="fa-regular fa-file-word"></i><small class="text-primary">{{ file.name }} <span class="badge float-right badge-light-info badge-pill">{{tamaniofile(file.size)}}</span></small>
                                            </div>
                                            <div class="col-sm-3 pt-1">
                                                <!-- <div class="progress" style="height: 6px;"><div role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" class="progress-bar" style="width: 50%;"></div></div> -->

                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                        <!-- <span class="sr-only">60% Complete (warning)</span> -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 ">
                                                <span class="badge badge-primary">p</span>
                                                <span class="badge float-right badge-light-danger badge-pill" v-on:click="removeFile( key )"><i class="fa-solid fa-trash-can"></i></span>
                                            </div>

                                        </div>
                                        <!-- para anexos -->
                                        <div v-for="(file_a, key) in anexosfiles" class="row border-top">

                                            <div class="col-sm-7" v-if="getFileExtension3(file_a.name)=='pdf'">

                                                <i class="fa-regular fa-file-pdf"></i>
                                                <small class="text-primary">{{ file_a.name }} <span class="badge float-right badge-light-info badge-pill">{{tamaniofile(file_a.size)}}</span></small>
                                            </div>
                                            <div class="col-sm-7" v-else>

                                                <i class="fa-regular fa-file-word"></i><small class="text-primary">{{ file_a.name }} <span class="badge float-right badge-light-info badge-pill">{{tamaniofile(file_a.size)}}</span></small>
                                            </div>
                                            <div class="col-sm-3 pt-1">
                                                <!-- <div class="progress" style="height: 6px;"><div role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" class="progress-bar" style="width: 50%;"></div></div> -->

                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                        <!-- <span class="sr-only">60% Complete (warning)</span> -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 ">
                                                <span class="badge badge-warning">A</span>
                                                <span class="badge float-right badge-light-danger badge-pill" v-on:click="removeFileanexos( key )"><i class="fa-solid fa-trash-can"></i></span>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header p-1 bg-secondary">
                                        <h6 class="pl-2">Derivación de documento</h6>
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label class="col-sm-3">Forma:</label>

                                            <div class="col-sm-6">
                                                <div class="demo-inline-spacing">

                                                    <div class="form-check form-check-inline" style="margin-top: 0rem !important;">
                                                        <input class="form-check-input" type="checkbox" value="unchecked" v-model="formdocumentos.formaderivacion" />
                                                        <label class="form-check-label">Copia</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">U.Organica <span class="text-red">(*)</span>:</label>
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control form-control-sm" placeholder="Cod." v-model="formdocumentos.cod_unidad" @keyup="capturaiddepe($event)">
                                            </div>
                                            <div class="col-sm-7">
                                                <select class="form-control form-control-sm" v-model="formdocumentos.cod_unidad" @change="capturaiddepe($event)">
                                                    <option v-for="lista in listadependencias" :key="lista.iddependencia" v-text="lista.depe_nombre" :value="lista.iddependencia"></option>
                                                </select>
                                                <!-- <el-select v-model="formdocumentos.cod_unidad" @change="capturaiddepe()" filterable placeholder="Seleccione la dependencia" style="width: 100%;" size="small">
                                                        <el-option v-for="(dependencia, indexDepe) in listadependencias" :key="indexDepe" :label="recortacadena(dependencia.depe_nombre)" :value="dependencia.iddependencia">
                                                        </el-option>
                                                    </el-select> -->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Detalle:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm text-uppercase" placeholder="N°" v-model="formdocumentos.detalle">
                                            </div>

                                        </div>
                                        <div class="form-group row" id="divusers" v-show="showdiv">
                                            <label class="col-sm-3">Usuario <span class="text-red">(*)</span>:</label>

                                            <div class="col-sm-9">
                                                <select class="form-control form-control-sm" v-model="formdocumentos.usuario" @change="detalleuser">
                                                    <template v-for="itemuser in listadouser">
                                                        <!-- <option v-if="itemuser.id!==datosuser.user_representante.iduser" v-text="itemuser.adm_name+' '+itemuser.adm_lastname" :value="itemuser.id"></option> -->
                                                        <option v-if="itemuser.id!=formdocumentos.idusercreador && itemuser.adm_email!='SUPERADMIN'" v-text="itemuser.adm_name+' '+itemuser.adm_lastname" :value="itemuser.id"></option>

                                                    </template>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-3">
                                                <label>Proveido de atención <span class="text-red">(*)</span>:</label>
                                                <button type="button" class="btn btn-outline-primary btn-sm " @click.prevent="agregarderivacion"><i class="fa-regular fa-calendar-plus"></i> Añadir</button>
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea class="form-control form-control-sm text-uppercase" rows="2" v-model="formdocumentos.proveido"></textarea>

                                                <!-- <button type="button" class="btn btn-outline-danger btn-sm "><i class="fa-regular fa-trash-can"></i><small>Limpiar</small></button> -->
                                            </div>

                                        </div>
                                        <div class="form-group row" v-show="showtabladerivaciones">
                                            <table id="tabla" class="table table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr class="bg-info disabled color-palette">
                                                        <th><small>FORMA</small></th>
                                                        <th><small>UNIDAD ORGANICA</small></th>
                                                        <th><small>DETALLE</small></th>
                                                        <th><small>USUARIO</small></th>
                                                        <th><small>PROVEIDO DE ATENCIÓN</small></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(der, index) in formdocumentos.derivaciones">

                                                        <td><small>{{ der.textforma }}</small></td>
                                                        <td><small>{{ der.vnomoficina }}</small></td>
                                                        <td><small>{{ der.vdetalle }}</small></td>
                                                        <td><small>{{ der.vnombreuser }}</small></td>
                                                        <td><small>{{ der.vproveido }}</small></td>
                                                        <td><button class="btn btn-default btn-sm" @click.prevent="eliminaderivacion(index)"><i class="fa-solid fa-trash-can"></i></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer p-1 justify-content-between">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm" @click="generar_tramite" v-show="btngenerartramite" :disabled="habilitarboton"><i class="fa-regular fa-floppy-disk"></i> Generar trámite</button>

                            <button type="submit" class="btn btn-danger btn-sm" @click.stop="firmadigital({idfile:idfile, id_documento:idtramdoc,'ruta_archivo':ArchivoFirma,'existearchivo':Existe})" v-show="EstadoFirma"><i class="fa fa-eyedropper"></i> Firmar digitalmente</button>
                            <button class="btn btn-dark btn-sm" @click="generarnuevotramite" v-show="btngenerarnewtramite"> <i class="fa-regular fa-file"></i> Generar nuevo tramite</button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mt-1 pt-1">
                            <label class="col-sm-12">Archivo(principal en PDF):</label>
                            <div class="col-sm-12" v-show="btn_cargarpdf">

                                <button class="btn btn-success btn-sm">
                                    <input type="file" name="docu_archivo" accept=".pdf" style="position: absolute; z-index: 2; top: 0px; left: 10%; opacity: 0; line-height: 2;background-color: transparent; color: transparent;max-width: 60%;max-width: 68%;" id="files" ref="files" @change="handleFilesUpload( $event )"><i class="fa-regular fa-file-pdf"></i> Cargar
                                </button>
                            </div>

                            <div class="col-sm-4" v-show="btn_cargarword" v-if="nombrearchivo">
                                <button class="btn btn-outline-primary btn-sm " @click.prevent="exporta_word">
                                    <i class="fa-regular fa-file-word"></i> Generar
                                </button>
                            </div>
                            <div class="col-sm-4" v-show="btn_sincronizar">

                                <button class="btn btn-success btn-sm">
                                    <input type="file" name="docu_archivo" accept=".pdf" style="position: absolute; z-index: 2; top: 0px; left: 10%; opacity: 0; line-height: 2;background-color: transparent; color: transparent;max-width: 60%;max-width: 68%;" id="files" ref="files" @change="handleFilesUpload( $event )">
                                    <!-- <input type="file" name="docu_archivo" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" style="position: absolute; z-index: 2; top: 0px; left: 10%; opacity: 0; line-height: 2;background-color: transparent; color: transparent;max-width: 60%;max-width: 68%;" id="files" multiple ref="files" @change="handleFilesUpload( $event )"> -->
                                    <i class="fa-regular fa-file-word"></i> Sincronizar
                                </button>
                            </div>

                        </div>

                        <div class="form-group row mt-1" v-show="btn_anexo">
                            <label class="col-sm-12">Anexos( máx.4 archivos):</label>
                            <div class="col-sm-12">
                                <button class="btn btn-warning btn-sm">
                                    <input type="file" name="docu_archivo" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" style="position: absolute; z-index: 2; top: 0px; left: 10%; line-height: 2; opacity: 0; background-color: transparent; color: transparent;max-width: 68%;" id="anexos" multiple ref="anexos" @change="carganexos( $event )"><i class="fa-regular fa-file-pdf"></i> Cargar
                                </button>
                            </div>
                            <div class="col-sm-12">
                                <small>(PDF, Imágenes, Word y Excel)</small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</Layout>
</template>
