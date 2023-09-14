import Vue from 'vue'
import VueRouter from 'vue-router';
import Vuex from "vuex";
import store from '../vuex/store'
import Main from "../components/Main.vue"
import mainDetails from "../components/layout/mainDetails.vue"
import Login from "../components/layout/auth/login.vue"


Vue.use(VueRouter)

const routes = [

    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/',
        component: Main,
        // meta: {auth: true},
        children: [
            {
                path: '/',
                component: mainDetails,
                name: 'personal.data'
            }
        ]
    }
]
const router = new VueRouter({
    mode: 'history',
    routes
})
// router.beforeEach((to, from, next) => {
// 	const userAuthenticated = store.state.Auth.authenticated
//     if(to.matched.some(record => record.meta.auth)) {
//       if (userAuthenticated) {
//         next()
//         return
//       }
//       next('/login')
//     } else {
//       next()
//     }
// })
export default router
