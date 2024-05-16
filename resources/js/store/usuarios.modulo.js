import axios from 'axios';
import authHeader from "../services/auth-header";

// const userall = JSON.parse(localStorage.getItem("userall"));

// const cargadatos = userall ? userall  : { };

export const usuarios = {
    namespaced: true,

    state: {
        totaluser: {},//cargadatos,
        rutabase:import.meta.env.VITE_API_BASE_URL || '/api'
    },

    mutations: {
        TOTAL_USUARIO(state,user)
        {
            state.totaluser=user;
        }
    },
    actions: {
        Totalusuarios({commit}) {
            var url='/listausuarios';
            axios.get(url,{ headers: authHeader() }).then(res=>{
                // console.log(res.data)
                commit('TOTAL_USUARIO',res.data);
                // localStorage.setItem('userall', JSON.stringify(res.data));
                // document.cookie = "userall="+(res.data||"")+"; expires=0; path=/;";
                // setCookie('userall', myItem, 7);
            })
        },

    },
    getters: {

        getAllusuarios : state => {
            return (state.totaluser !== undefined) ? state.totaluser : null
          },
    },
};
