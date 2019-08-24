
window.Vue = require('vue');
window.eventBus = new Vue()

import globalMixins from './mixins/global'
import swal from './plugins/swal'
import toastr from './plugins/toastr'
// import VeeValidate from 'vee-validate'

require('./bootstrap')


window.Vue = require('vue')
window.eventBus = new Vue()

// require('./ui')
Vue.use(swal)
Vue.use(toastr)
// Vue.use(VeeValidate)
// Vue.use(VueFlashMessage);


// Vue.component('admin-forgot-password', require('./components/backend/auth/forgot-password'))
// Vue.component('admin-reset-password', require('./components/backend/auth/reset-password'))
// Vue.component('admin-auth-signin', require('./components/backend/auth/signin'))

const app = new Vue({
    el: '#app'
});
