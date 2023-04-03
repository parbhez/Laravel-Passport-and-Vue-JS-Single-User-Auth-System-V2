import { createStore } from 'vuex'
import axios from 'axios'

// axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1';
// Create a new store instance.
const store = createStore({
    state: {
        token: localStorage.getItem('accessToken') || null,
        user: {},
        status: '',
        search_str: ''
    },

    getters: {
        //For User
        loggedIn(state) {
            return state.token !== null;
        },
        isLoggedIn: state => !!state.token,
        getUser: state => state.user,

        authStatus(state) {
            return state.status;
        },

    },

    actions: {
        register(contex, formdata) {
            return new Promise((resolve, reject) => {
                axios.post('/register', {
                        name: formdata.name,
                        email: formdata.email,
                        password: formdata.password
                    })
                    .then((response) => {
                        resolve(response.data);
                    })
                    .catch((error) => {
                        reject(error);
                    })
            })
        },

        login(contex, credential) {
            return new Promise((resolve, reject) => {
                contex.commit('auth_request');
                axios.post('/login', {
                        email: credential.email,
                        password: credential.password
                    })
                    .then((response) => {
                        const token = 'Bearer ' + response.data.data.access_token;
                        const user = response.data.data;
                        axios.defaults.headers.common['Authorization'] = token;
                        localStorage.setItem('accessToken', token);
                        contex.commit('user_token_set', token);
                        contex.commit('set_user', user);
                        resolve(response.data);
                    })
                    .catch((error) => {
                        localStorage.removeItem('accessToken');
                        reject(error);
                    })
            })
        },

        logout(contex) {
            axios.defaults.headers.common['Authorization'] = contex.state.token;
            return new Promise((resolve, reject) => {
                axios.post('/logout')
                    .then((response) => {
                        localStorage.removeItem('accessToken');
                        delete axios.defaults.headers.common['Authorization'];
                        contex.commit('removeToken');
                        resolve(response.data);
                    })
                    .catch((error) => {
                        reject(error);
                    })
            })
        },

        //user me route wise...................
        //get reauthrnticated token
        getUser({ commit, state }, token) {

            if (token) {
                commit('user_token_set', token);
            }

            if (!state.token) {
                return;
            }

            // console.log(state.token);
            return new Promise((resolve, reject) => {
                //url name always must be single
                //do not accepted users/me
                //only accepted user/me
                axios.get('/user/me')
                    .then((response) => {
                        //console.log(response.data.data);
                        const user = response.data.data;
                        commit('set_user', response.data.data);
                        resolve(response.data);
                    })
                    .catch((error) => {
                        //console.log("Error222")
                        //console.log(error)
                        localStorage.removeItem('accessToken');
                        commit('set_user', null);
                        commit('user_token_set', null);
                        reject(error);
                    })
            });
        },

        //For Filter any column
        updateSearchStr({ commit }, payload) {
            let { search_str } = payload
            commit('setSearchStr', search_str)
        },

    },

    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },

        user_token_set(state, token) {
            // console.log(localStorage.getItem('accessToken'))
            // return console.log(token)
            if (token) {
                axios.defaults.headers.common['Authorization'] = token;
                state.status = 'success';
                state.token = token;
            } else {
                axios.defaults.headers.common['Authorization'] = null;
                state.status = '';
                state.token = '';
                localStorage.removeItem('accessToken');
            }
        },

        set_user(state, user) {
            // console.log(user);
            state.user = user;
        },

        logout(state) {
            state.status = '';
            state.token = '';
        },
        removeToken(state) {
            state.token = null;
            state.user = null;
        },

        //For Filter
        setSearchStr(state, data) {
            state.search_str = data
        },
    }
})

export default store;
