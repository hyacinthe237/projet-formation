import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex)

export default new Vuex.Store({
    strict: true,
    state: {
        user: {}
    },

    mutations: {
        SET_USER (state, user) {
            state.user = user
        }
    },

    modules: {}
})
