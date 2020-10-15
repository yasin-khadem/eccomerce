import Swal from "sweetalert2";

export const namespaced = true;
export const state = {
    user: JSON.parse(localStorage.getItem('user')),
    isLoggedIn: !!localStorage.getItem('token'),
    token: localStorage.getItem('token'),
    refresh_token: localStorage.getItem('refresh_token'),
};

export const mutations = {
    SET_USER(state, user) {
        state.user = user
        state.isLoggedIn = true;
        localStorage.setItem('user', JSON.stringify(user))
    },
    SET_TOKEN(state, token) {
        state.token = token
        //test
        window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        //test
        localStorage.setItem('token', token)
    },
    SET_TOKEN_REFRESH_TOKEN(state, data) {
        state.token = data.access_token
        state.refresh_token = data.refresh_token

        window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.access_token;

        localStorage.setItem('token', data.access_token)
        localStorage.setItem('refresh_token', data.refresh_token)

    },
    SET_REFRESH_TOKEN(state, data) {
        state.token = data.token
        state.refresh_token = data.refresh_token
        window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        localStorage.setItem('token', data.token)
        localStorage.setItem('refresh_token', data.refresh_token)
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
                if (form.remember) {
                    commit('SET_REFRESH_TOKEN', data.data)
                }
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.data.token;
            })
    },
    register({ commit }, form) {
        return form.post('/api/register')
            .then(({ data }) => {
                commit('SET_USER', data.data)
                commit('SET_TOKEN', data.data.token)
                commit('SET_REFRESH_TOKEN', data.data)
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.data.token;
            })
    },
    profile({ commit }, payload) {
        payload.patch(`/api/profile/${payload.id}`)
            .then(({ data }) => {
                commit('SET_USER', data);
            });

    },
    logout({ commit }) {
        commit('LOGOUT_USER')
    },
    getUser({ commit, state }) {
        return axios.get('/api/me').then(({ data }) => {
            commit('SET_USER', data)
        }).catch(({ response }) => {
            if (response.status === 401) {
                swal.message('احراز هویت', 'warning')
                axios.post('/api/refresh-token', {
                    refresh_token: state.refresh_token
                }).then(({ data }) => {
                    commit('SET_TOKEN_REFRESH_TOKEN', data.data)
                }).catch(() => {
                    swal.message('لاگین نیستید', 'warning')
                    commit('LOGOUT_USER');
                    // window.location.href = document.location.origin + "/auth/login";
                })
            }
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

