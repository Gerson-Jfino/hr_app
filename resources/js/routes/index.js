import Vue from 'vue'
import VueRouter from 'vue-router';
import Vuex from "vuex";
import store from '../vuex/store'
import Main from "../components/Main.vue"
import mainDetails from "../components/layout/mainDetails.vue"
import colaboradores from "../components/layout/colaboradores.vue"
import Login from "../components/layout/auth/login.vue"
import colaboradorDetalhes from "../components/layout/colaboradorDetails.vue"


Vue.use(VueRouter)

const routes = [

    {
        path: '/',
        component: Login,
        name: 'login'
    },
    {
        path: '/minha-ficha',
        component: Main,
        meta: {auth: true},
        children: [
            {
                path: '/minha-ficha',
                component: mainDetails,
                name: 'personal.data'
            },
            {
                path: '/colaboradores',
                component: colaboradores,
                name: 'colaboradores.data'
            },
            {
                path: '/colaboradores/:id/detalhes',
                component: colaboradorDetalhes,
                name: 'colaborador.details',
                props: true
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
    if(to.matched.some(record => record.meta.auth)) {
      if (userAuthenticated) {
        next()
        return
      }
      next('/')
    } else {
      next()
    }
})
export default router
