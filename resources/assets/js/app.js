
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import store from './store/store'
import globalMixins from './mixins/global'
import swal from './plugins/swal'
import toastr from './plugins/toastr'

// require('./bootstrap')

window.Vue = require('vue')
window.eventBus = new Vue()

// import VeeValidate from 'vee-validate'

Vue.use(swal)
Vue.use(toastr)
// Vue.use(VeeValidate)

// require('./ui')

// Vue.component('input-files', require('./components/frontend/images/input'))

const app = new Vue({
    el: '#app'
})
