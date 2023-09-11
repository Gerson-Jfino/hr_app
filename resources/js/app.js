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
