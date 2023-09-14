require('./bootstrap');
window.Vue = require('vue');
import Vuetify from './plugins/vuetify'
import router from './routes/index'
import store from './vuex/store';

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router,
    store
    // render: h => h(App),
})

const token_auth = sessionStorage.getItem('TOKEN_AUTH')
// if(token_auth) {
//     store.dispatch('Auth/checkAuthenticated')
//         .then( () => {
//             console.log('ok');
//             // router.push({ name: 'activities' })
//         }).catch(() => {
//             console.log("err");
//             router.push({name: 'login'})
//         })
// }
if(token_auth)
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${token_auth}`;
