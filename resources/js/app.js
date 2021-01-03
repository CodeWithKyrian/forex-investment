window.Vue = require('vue');
require('./plugins/filter');
require('./plugins/progressbar');
require('./plugins/swal');
require('./plugins/customEvents');

import Vuex from 'vuex'
import App from './App.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueFinalModal from 'vue-final-modal'
import storeData from "./store"
import router from './plugins/router'

Vue.use(Vuex)
Vue.use(VueFinalModal())
Vue.component('font-awesome-icon', FontAwesomeIcon)

const store = new Vuex.Store(storeData)
window.store = store
window.axios = require('axios');
axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.getters.getToken;


const app = new Vue({
    render: h => h(App),
    el: '#app',
    store,
    router
});