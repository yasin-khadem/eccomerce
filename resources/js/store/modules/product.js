
export const namespaced = true;
export const state = {
    products: {}
};
export const mutations = {
    SET_PRODUCTS(state, payload) {
        state.products = payload
    },
    DELETE_PRODUCT(state,payload){
        state.products.data.splice(payload,1);
    }
};
export const actions = {
    getProducts({ commit }, payload = 1) {
        axios.get(`/api/admin/product?page=${payload}`).then(({ data }) => {
            commit('SET_PRODUCTS', data)
            window.history.pushState('products', 'Products',`/admin/product/index?page=${payload}`)
        })
    },
    store({ commit }, payload) {
        return payload.post('/api/admin/product')
    },
    deleteProduct({commit},payload){
         axios.delete(`/api/admin/product/${payload.slug}`).then(()=>{
            commit('DELETE_PRODUCT',payload.index);
            swal.message('محصول شما حذف شد');
        })

    }
};

