import Vue from "vue";
import Vuex from 'vuex';
import Loader from "./Loader/Loader";
import Auth from "./Auth/Auth";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Loader,
        Auth
    }
});
