import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'dashboard',
        meta: {
                title: 'Dashboard',
                authRequired: true,
            },
        component: () => import('../vistaSGD/dashborad.vue'),
    },
    {
        path: '/usuarios/lista',
        meta: { authRequired: true, title: 'Lista de usuarios' },
        component: () => import('../vistaSGD/usuarios/listausuarios.vue')
    },
    {
        path: '/usuarios/asistencias',
        meta: { authRequired: true, title: 'Asistencias de usuarios' },
        component: () => import('../vistaSGD/usuarios/Asistencias.vue')
    },
    {
        path: '/usuarios/detalle',
        meta: { authRequired: true, title: 'detalle del usuarios' },
        component: () => import('../vistaSGD/usuarios/detalleusuario.vue')
    },
    {
        path: '/usuarios/movimiento',
        meta: { authRequired: true, title: 'Movimiento del usuarios' },
        component: () => import('../vistaSGD/usuarios/movimiento.vue')
    },
    {
        path: '/usuarios/permisolicencia',
        meta: { authRequired: true, title: 'Permisos y licencias del usuarios' },
        component: () => import('../vistaSGD/usuarios/permiso-licencias.vue')
    },
    {
        path: '/usuarios/vacaciones',
        meta: { authRequired: true, title: 'Vacaciones de los usuarios' },
        component: () => import('../vistaSGD/usuarios/vacaciones.vue')
    },
    {
        path: '/usuarios/honomastico',
        meta: { authRequired: true, title: 'Honomásticos' },
        component: () => import('../vistaSGD/usuarios/honomastico.vue')
    },
    {
        path: '/usuarios/boletaspago',
        meta: { authRequired: true, title: 'Boletas de pago' },
        component: () => import('../vistaSGD/usuarios/boletapago.vue')
    },
    {
        path: '/usuarios/certificados',
        meta: { authRequired: true, title: 'Emisión de certificados/constancias' },
        component: () => import('../vistaSGD/usuarios/certificados.vue')
    },
    {
        path: '/login',
        name: 'login',
        meta: { title: 'Login' },
        component: () => import('../vistaSGD/login.vue')
    },
    {
        path: '/usuario/perfil',
        name: 'Perpil',
        meta: { authRequired: true, title: 'Perfil' },
        component: () => import('../vistaSGD/usuarios/perfil.vue')
    },
    {
        path: '/auth/register',
        name: 'register',
        meta: { title: 'Register' },
        component: () => import('../views/account/register.vue')
    },
    {
        path: '/auth/login-2',
        meta: { authRequired: true, title: 'Login' },
        component: () => import('../views/sample-pages/login-2.vue')
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// Before each route evaluates...
router.beforeEach(async (routeTo, routeFrom, next) => {
    // set title name
    if (routeTo.meta.title != undefined) {
        document.title = "SGD | "+routeTo.meta.title;
    }

    const authRequired = routeTo.matched.some((route) => route.meta.authRequired);
    if (!authRequired) return next();

    if (localStorage.getItem('user')) {
        next();
    } else {
        next({ name: 'login', query: { redirectFrom: routeTo.fullPath } });
    }

});

export default router;
