import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex)

export default new Vuex.Store({
    strict: true,
    state: {
        user: {},
        communes: []
    },

    mutations: {
        SET_USER (state, user) {
            state.user = user
        },

        SET_COMMUNES (state, payload) {
            state.communes = payload
        }
    },

    modules: {}
})
