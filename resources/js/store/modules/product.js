export const namespaced = true;
export const state = {

};
export const mutations = {

};
export const actions = {
    store({commit},payload){
        return payload.post('/api/admin/product')
    }
};

