export const namespaced = true;
export const state = {
    user: JSON.parse(localStorage.getItem('user')),
    isLoggedIn: !!localStorage.getItem('token'),
    token: localStorage.getItem('token'),
};

export const mutations = {
    SET_USER(state, user) {
        state.user = user
        state.isLoggedIn = true;
        localStorage.setItem('user', JSON.stringify(user))
    },
    SET_TOKEN(state, token) {
        state.token = token
        localStorage.setItem('token', token)
    },
    LOGOUT_USER(state) {
        state.user = null
        state.isLoggedIn = false
        state.token = null
        localStorage.removeItem('user')
        localStorage.removeItem('token')


    }
};
export const actions = {
    login({ commit }, form) {
        return form.post('/api/login')
            .then(({ data }) => {
                commit('SET_USER', data.data)
                commit('SET_TOKEN', data.data.token)
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.data.token;
            })
    },
    register({ commit }, form) {
        return form.post('/api/register')
            .then(({ data }) => {
                commit('SET_USER', data.data)
                commit('SET_TOKEN', data.data.token)
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.data.token;
            })
    },
    logout({ commit }) {
        commit('LOGOUT_USER')
    },
    getUser({commit}){
        return axios.get('/api/me').then(({data})=>{
            commit('SET_USER',data)
        }).catch(()=>{
            commit('LOGOUT_USER');
        })
    }
};
export const getters = {
    user(state) {
        return state.user
    },
    isLoggedIn(state) {
        return state.isLoggedIn
    },
    token(state) {
        return state.token
    },


};

