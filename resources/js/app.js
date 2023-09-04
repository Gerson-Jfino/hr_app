require('./bootstrap');
window.Vue = require('vue');
import Vuetify from './plugins/vuetify'
import router from './routes/index'

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router
    // render: h => h(App),
})
