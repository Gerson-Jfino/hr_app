import Vue, { triggerRef } from 'vue'
import VueRouter from 'vue-router';
import Vuex from "vuex";
import store from '../vuex/store'
import Main from "../components/Main.vue"
import mainDetails from "../components/layout/mainDetails.vue"
import colaboradores from "../components/layout/colaboradores.vue"
import Login from "../components/layout/auth/login.vue"
import register from "../components/layout/auth/register.vue"
import colaboradorDetalhes from "../components/layout/colaboradorDetails.vue"
import asseduidade from "../components/layout/asseduidade.vue"
import users from "../components/layout/users.vue"
import desempenho from "../components/layout/desempenho.vue"
import relatorios from "../components/layout/relatorios.vue"
import colaboradorForm from "../components/layout/colaboradorForm.vue"


Vue.use(VueRouter)

const routes = [

    {
        path: '/',
        component: Login,
        name: 'login'
    },
    {
        path: '/criar-conta',
        component: register,
        name: 'register'
    },
    {
        path: '/minha-ficha',
        component: Main,
        meta: {auth: true},
        children: [
            {
                path: '/minha-ficha',
                component: mainDetails,
                name: 'personal.data',
            },
            {
                path: '/colaboradores',
                component: colaboradores,
                name: 'colaboradores.data',
                meta: {admin: true}
            },
            {
                path: '/relatorios',
                component: relatorios,
                name: 'admin.relatorios',
                meta: {admin: true}
            },
            {
                path: '/gestao-asseduidade',
                component: asseduidade,
                name: 'colaborador.asseduidade',
                meta: {admin: true}

            },
            {
                path: '/users',
                component: users,
                name: 'admin.users',
                meta: {admin: true}

            },
            {
                path: '/desempenho',
                component: desempenho,
                name: 'admin.desempenho',
                meta: {admin: true}

            },
            {
                path: '/colaboradores/:id/detalhes',
                component: colaboradorDetalhes,
                name: 'colaborador.details',
                props: true,
                meta: {admin: true}
            },
            {
                path: '/colaboradores/adicionar',
                component: colaboradorForm,
                name: 'colaborador.create',
                props: true,
                meta: {admin: true}
            },
        ]
    }
]
const router = new VueRouter({
    mode: 'history',
    routes
})
router.beforeEach((to, from, next) => {
	const userAuthenticated = store.state.Auth.authenticated
    const user = store.state.Auth.user
    if(to.matched.some(record => record.meta.auth)) {
        if (userAuthenticated) {
          if(to.matched.some(record => record.meta.admin)) {
            if(user.role_id == 1) {
                next()
                return
            }
            else {
                next('/minha-ficha')
                return
            }
          }
        next()
        return
      }
      next('/')
    } else {
      next()
    }
})
export default router
