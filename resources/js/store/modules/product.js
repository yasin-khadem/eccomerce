import objectToFormData from "object-to-formdata";

export const namespaced = true;
export const state = {
    products: {}
};
export const mutations = {
    SET_PRODUCTS(state, payload) {
        state.products = payload
    },
    DELETE_PRODUCT(state, payload) {
        state.products.data.splice(payload, 1);
    }
};
export const actions = {
    getProducts({ commit }, queries) {
        return axios.get(`/api/admin/product`, {
            params: queries
        }).then(({ data }) => {
            commit('SET_PRODUCTS', data)
            window.history.pushState('products', 'Products', `/admin/product/index?${data.meta.queries}`)
        })
    },
    getUserProducts({ commit }, queries) {
        return axios.get(`/api/product`, {
            params: queries
        }).then(({ data }) => {
            commit('SET_PRODUCTS', data)
            window.history.pushState('products', 'Products', `?${data.meta.queries}`)
        })
    },
    async getProduct({ state }, payload) {
        if (!_.isEmpty(state.products)) {
            let product = state.products.data.find(product => product.slug === payload)
            if (product) {
                return product
            }
        }
        let { data } = await axios.get(`/api/admin/product/${payload}`)
        return data
    },
    store({ commit }, payload) {
        return payload.submit('post', '/api/admin/product', {
            transformRequest: [function (data, header) {
                return objectToFormData(data);
            }]
        })
        // return payload.post('/api/admin/product')
    },

    updateProduct({ commit }, payload) {
        return payload.submit('post', `/api/admin/product/${payload.slug}`, {
            transformRequest: [function (data, header) {
                return objectToFormData(data);
            }]
        })
        // return payload.post(`/api/admin/product/${payload.slug}`)
    },
    deleteProduct({ commit }, payload) {
        axios.delete(`/api/admin/product/${payload.slug}`).then(() => {
            commit('DELETE_PRODUCT', payload.index);
            swal.message('محصول شما حذف شد');
        })

    },
};

