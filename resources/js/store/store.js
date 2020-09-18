import Vue from 'vue'
import Vuex from 'vuex'
import * as auth from './modules/auth';
import * as category from './modules/category';
import * as product from './modules/product';
Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        auth,
        category,
        product
    }
})