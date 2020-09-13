require('./bootstrap');
require('bootstrap-material-design');

// require('./plugin/material-dashboard.min.js'); 
import VueMeta from 'vue-meta'
import router from './router/router' 
import store from './store/store' 

window.Vue = require('vue');
Vue.use(VueMeta);


const files = require.context('./components', true, /Base[A-Z]\w+\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app',
    router,
    store
});
