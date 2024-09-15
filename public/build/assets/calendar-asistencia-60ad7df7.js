import{F as h,l as v,i as u,a as p,b,c as x,d as f}from"./index-7a9c9497.js";import{L as g,P as w}from"./page-header-a7ad3f93.js";import{_ as y,g as k,e as C,w as n,r as e,o as F,b as o,a as s,h as z,t as i}from"../js/app2.js";import"./logo-dark2-869291e0.js";import"./logo-dark-139de3ab.js";import"./logo-9faa3827.js";import"./logo-light-47448f26.js";const V={components:{FullCalendar:h,Layout:g,PageHeader:w},data(){return{title:"Asistencia por Calendario",items:[{text:"Asistencias",active:!0},{text:"Record de asistencias",active:!0}],calendarEvents:null,calendarOptions:{locale:v,headerToolbar:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay,listWeek"},plugins:[u,p,b,x,f],initialView:"dayGridMonth",themeSystem:"bootstrap",initialEvents:[],editable:!0,droppable:!0,eventResizableFromStart:!0,weekends:!0,selectable:!0,events:[],selectMirror:!0,dayMaxEvents:!0},datosasistencias:[],dniuser:this.$route.params.dni}},mounted(){this.consultadni()},methods:{consultadni(){var c="/asistenciaxdni";const d={dni:this.dniuser};k.get(c,{params:d}).then(a=>{this.datosasistencias=a.data.resumen,this.calendarOptions.events=a.data.asistencias,this.calendarEvents=a.data.asistencias})}}},A={class:"row"},D={class:"col-sm-6 mb-2"},E={class:"row"},G={class:"col-sm-3"},L={class:"blog-stats-wid card"},M={class:"card-body"},P={class:"d-flex flex-wrap"},B={class:"me-3"},H=s("p",{class:"text-success mb-2"},"Días puntual",-1),N={class:"mb-0"},O=s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-success rounded-circle text-light font-size-20"},[s("i",{class:"bx bx-time-five"})])],-1),S={class:"col-sm-3"},R={class:"blog-stats-wid card"},T={class:"card-body"},W={class:"d-flex flex-wrap"},$={class:"me-3"},j=s("p",{class:"text-info mb-2"},"Días tarde",-1),q={class:"mb-0"},I=s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-info rounded-circle text-light font-size-24"},[s("i",{class:"bx bxs-timer"})])],-1),J={class:"col-sm-3"},K={class:"blog-stats-wid card"},Q={class:"card-body"},U={class:"d-flex flex-wrap"},X={class:"me-3"},Y=s("p",{class:"text-danger mb-2"},"Falta día completo",-1),Z={class:"mb-0"},ss=s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-danger rounded-circle text-light font-size-20"},[s("i",{class:"bx bxs-book-bookmark"})])],-1),ts={class:"col-sm-3"},as={class:"blog-stats-wid card"},es={class:"card-body"},is={class:"d-flex flex-wrap"},os={class:"me-3"},cs=s("p",{class:"text-warning mb-2"},"Falta medio dia",-1),ds={class:"mb-0"},ns=s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-warning rounded-circle text-light font-size-20"},[s("i",{class:"bx bxs-book-bookmark"})])],-1),ls={class:"row"},rs={class:"col-xl-12"},_s={class:"card"},ms={class:"card-body"},hs={class:"app-calendar"};function vs(c,d,a,us,t,ps){const l=e("PageHeader"),r=e("router-link"),_=e("FullCalendar"),m=e("Layout");return F(),C(m,null,{default:n(()=>[o(l,{title:t.title,items:t.items},null,8,["title","items"]),s("div",A,[s("div",D,[o(r,{to:"/usuarios/asistencias",class:"btn btn-sm btn-info"},{default:n(()=>[z("Volver a asistencias")]),_:1})])]),s("div",E,[s("div",G,[s("div",L,[s("div",M,[s("div",P,[s("div",B,[H,s("h5",N,i(t.datosasistencias.diapuntual),1)]),O])])])]),s("div",S,[s("div",R,[s("div",T,[s("div",W,[s("div",$,[j,s("h5",q,i(t.datosasistencias.diastarde),1)]),I])])])]),s("div",J,[s("div",K,[s("div",Q,[s("div",U,[s("div",X,[Y,s("h5",Z,i(t.datosasistencias.faltadiacompleto),1)]),ss])])])]),s("div",ts,[s("div",as,[s("div",es,[s("div",is,[s("div",os,[cs,s("h5",ds,i(t.datosasistencias.faltafaltamediodia),1)]),ns])])])])]),s("div",ls,[s("div",rs,[s("div",_s,[s("div",ms,[s("div",hs,[o(_,{ref:"fullCalendar",options:t.calendarOptions},null,8,["options"])])])])])])]),_:1})}const Cs=y(V,[["render",vs]]);export{Cs as default};