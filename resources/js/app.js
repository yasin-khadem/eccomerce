require('./bootstrap');
require('bootstrap-material-design');

// require('./plugin/material-dashboard.min.js'); 
import VueMeta from 'vue-meta'
import router from './router/router' 
import store from './store/store' 

window.Vue = require('vue');
Vue.use(VueMeta);

if (process.env.MIX_APP_ENV === 'production'){
    Vue.config.devtools = false;
    Vue.config.debug = false;
    Vue.config.silent = true;
}


const files = require.context('./components', true, /Base[A-Z]\w+\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagination', require('laravel-vue-pagination'));

import Notify from "@/components/Notify"

const app = new Vue({
    el: '#app',
    components:{
        Notify
    },
    router,
    store
});
