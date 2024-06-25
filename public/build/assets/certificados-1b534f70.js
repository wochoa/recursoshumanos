import{L as b,P as _}from"./page-header-a7ad3f93.js";import{L as h}from"./vue3-datepicker-5325aadd.js";import{_ as v,g as A,e as f,w as a,r as c,o as E,b as r,a as t,h as o}from"../js/app2.js";import"./logo-dark2-869291e0.js";import"./logo-dark-139de3ab.js";import"./logo-9faa3827.js";import"./logo-light-47448f26.js";const g={page:{title:"Jobs List"},components:{Layout:b,PageHeader:_,Datepicker:h},data(){return{title:this.$route.meta.title,listDeleteModal:!1,items:[{text:"Usuarios",href:"/"},{text:this.$route.meta.title,active:!0}],datepickervalue:new Date,getAllusuarios:{}}},computed:{},mounted(){this.Buscarusuarios()},methods:{Buscarusuarios(l=1){var e="/listausuarios?page="+l;A.get(e,{params:this.formData}).then(n=>{this.getAllusuarios=n.data})},primeraletra(l){return l.charAt(0).toUpperCase()}}},L={class:"row"},R={class:"col-lg-12"},O={class:"card"},I=t("div",{class:"card-body border-bottom"},[t("div",{class:"row g-3"},[t("div",{class:"col-xxl-4 col-lg-6"},[t("input",{type:"search",class:"form-control",id:"searchTableList",placeholder:"Registro SGD ...",value:"04723012"})]),t("div",{class:"col-xxl-2 col-lg-4"},[t("button",{type:"button",class:"btn btn-secondary w-100"},[t("i",{class:"mdi mdi-account-search align-middle"}),o(" Buscar")])])])],-1),D={class:"card-body pt-0 pb-0"},N={class:"table-responsive"},y={class:"table align-middle dt-responsive nowrap w-100 table-check table-hover table-bordered table-sm",id:"job-list"},C=t("thead",null,[t("tr",null,[t("th",{scope:"col"},[o("REGISTRO"),t("br"),o("EXPEDIENTE ")]),t("th",{scope:"col"},"DOCUMENTO"),t("th",{scope:"col"},"DESTINO"),t("th",{scope:"col"},"ARCHIVO"),t("th",{scope:"col"},"ACCIONES")])],-1),M=t("th",{scope:"row"},[t("small",null,[o("Reg. 04723012"),t("br"),o(" Exp. 02773151 REGISTRADO")])],-1),x=t("td",null,[t("small",null,[o(" Fecha:2024-04-10 16:10:01 "),t("br"),o(" Forma:ORIGINAL"),t("br"),o(" Folios:1"),t("br"),o(" Proveido: Tipo: ")]),t("br"),t("small",null,[o(" Doc:MEMORANDUM MULTIPLE 000198-2024-GRH/GGR "),t("br"),o(" Firma:LESLIE CAROL ZEVALLOS QUINTEROS"),t("br"),o("Cargo:GERENTE GENERAL REGIONAL"),t("br"),o("Asunto:ASISTENCIA TÉCNICA PARA EL USO DE LA FIRMA DIGITALDependencia:GERENCIA GENERAL REGIONAL ")])],-1),G=t("td",null,[t("small",null,"....s.")],-1),T=t("td",null,[t("span",{class:"badge badge-soft-success"},[t("button",{"data-v-757b3b11":"",type:"button",class:"btn btn-xs btn-link doc-link"},[t("span",{"data-v-757b3b11":"",style:{color:"blue","font-size":"80%"}},"180.89 KB"),o(),t("span",{"data-v-757b3b11":"",class:"badge badge-danger"}," P "),o(),t("span",{"data-v-757b3b11":"",class:"glyphicon glyphicon-file"}),o(" MEMO MUL 198 2024.pdf ")])])],-1),S=t("i",{class:"bx bx-user-voice"},null,-1),w=t("div",{class:"form-group row"},[t("label",{for:"",class:"col-sm-3"},"Solicitante"),t("div",{class:"col-sm-9"},[t("input",{type:"text",class:"form-control form-control-sm",placeholder:"Nombres del solicitante",value:"WILMER OCHAO ALVARADO"})])],-1),V=t("div",{class:"form-group row"},[t("label",{for:"",class:"col-sm-3"},"Incio de contrato"),t("div",{class:"col-sm-3"},[t("input",{type:"date",class:"form-control form-control-sm",placeholder:"Nombres del solicitante",value:"WILMER OCHAO ALVARADO"})]),t("label",{for:"",class:"col-sm-3"},"Fin de contrato"),t("div",{class:"col-sm-3"},[t("input",{type:"date",class:"form-control form-control-sm",placeholder:"Nombres del solicitante",value:"WILMER OCHAO ALVARADO"})])],-1),k={class:"modal-footer v-modal-footer mt-2"};function P(l,e,n,U,s,H){const u=c("PageHeader"),d=c("b-button"),m=c("b-modal"),p=c("Layout");return E(),f(p,null,{default:a(()=>[r(u,{title:s.title,items:s.items},null,8,["title","items"]),t("div",L,[t("div",R,[t("div",O,[I,t("div",D,[t("div",N,[t("table",y,[C,t("tbody",null,[t("tr",null,[M,x,G,T,t("td",null,[t("button",{class:"btn btn-primary btn-sm",onClick:e[0]||(e[0]=i=>s.listDeleteModal=!s.listDeleteModal)},[S,o(" Atender ")])])])])])])])])])]),r(m,{modelValue:s.listDeleteModal,"onUpdate:modelValue":e[2]||(e[2]=i=>s.listDeleteModal=i),"hide-footer":"",title:"Atender certificado/constancia",class:"v-modal-custom",size:"lg"},{default:a(()=>[w,V,t("div",k,[r(d,{type:"button",variant:"light",onClick:e[1]||(e[1]=i=>s.listDeleteModal=!1)},{default:a(()=>[o("Cerrar ")]),_:1}),r(d,{type:"button",variant:"success"},{default:a(()=>[o("Registros")]),_:1})])]),_:1},8,["modelValue"])]),_:1})}const Q=v(g,[["render",P]]);export{Q as default};
