import { createStore } from "vuex";
import { auth } from "./auth.module";
import { usuarios } from "./usuarios.modulo";

const store = createStore({
  modules: {
    auth,
    usuarios,
  },
});

export default store;
