import axios from 'axios'
import { BASE_URL } from '../../config/api'

export default {
    namespaced: true,

    state: {
        user: {
            name: 'lol'
        },
        authenticated: false,
        urlBack: 'site.welcome',
        paramsUrlBack: {},
    },

    mutations: {
        AUTH_USER_OK(state, payload) {
            // console.log(payload);
            state.authenticated = true
            state.user = payload.user
        },

        UPDATE_URL_BACK(state, payload) {
            state.urlBack = payload.route_name
            state.paramsUrlBack = payload.params
        },

        AUTH_USER_LOGOUT(state) {
            state.user = {},
            state.authenticated = false
        }
    },
    actions: {
        login({ commit }, params) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            // console.log('a');
            return new Promise((resolve, reject) => {

                axios.post(`${BASE_URL}login`, params)
                    .then(response => {
                        // console.log(response.data);
                        const token = response.data.access_token
                        let user = response.data.user
                        let payload = {
                            user: {
                                id: user.id,
                                name: user.name,
                                email: user.email
                            }
                        }

                        commit('AUTH_USER_OK', payload)

                        sessionStorage.setItem('TOKEN_AUTH', token)
                        window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
                        resolve(response)

                    })
                    .catch(error => {
                        reject(error)
                    })
                    .finally(() => commit('Loader/CHANGE_LOADING', false, { root: true }))
            })


        },
        checkAuthenticated({commit}) {
            const config = {
                headers: {
                    Authorization: `Bearer ${sessionStorage.getItem('TOKEN_AUTH')}`,
                }
            }
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                axios.get(`${BASE_URL}me`, config)
                .then(res => {
                    // console.log(res.data)
                    // const token = sessionStorage.getItem('TOKEN_AUTH')
                    //console.log(token)
                    const payload = {
                        user: res.data
                    }
                    commit('AUTH_USER_OK', payload)
                    resolve(res)
                })
                .catch(err => {
                    sessionStorage.removeItem('token')
                    reject(err)
                })
                .finally(() => {
                    commit('Loader/CHANGE_LOADING', false, { root: true })
                })
            })
        },
        autoRegisto({commit}, params) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                axios.post(`${BASE_URL}/users/register`, params)
                    .then(res => {
                        resolve(res)
                        sessionStorage.removeItem('token')
                    })
                    .catch(err => {
                        reject(err)
                    })
                    .finally(() => {commit('Loader/CHANGE_LOADING', false, { root: true })})
            })
        },
        logout({commit}) {
            commit('Loader/CHANGE_LOADING', true, { root: true })
            return new Promise((resolve, reject) => {
                
				console.log('out');
                axios.post(`${BASE_URL}logout`, {})
                    .then(res => {
                        resolve(res)
                        commit('AUTH_USER_LOGOUT', res)
                        sessionStorage.removeItem('token')

                    }).catch(err => {
                        reject(err)
                    }).finally(() => {
                        commit('Loader/CHANGE_LOADING', false, { root: true })
                    })
            })
        },
    }
}
