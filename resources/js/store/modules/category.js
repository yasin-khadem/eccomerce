import Axios from "axios";

export const namespaced = true;

export const mutations = {

};
export const actions = {
    storeCategory({commit},payload){
        return payload.post(`/api/admin/categories`,payload);
    },
    getCategory({commit},payload){
        return axios.get(`/api/admin/categories/${payload}`);
    },
    updateCategory({ commit }, payload) {
        return payload.patch(`/api/admin/categories/${payload.slug}`);
    }
};