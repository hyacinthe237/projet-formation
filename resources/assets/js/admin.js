
window.Vue = require('vue');
window.eventBus = new Vue()

import globalMixins from './mixins/global'
import swal from './plugins/swal'
import toastr from './plugins/toastr'
// import VeeValidate from 'vee-validate'

require('./bootstrap')


window.Vue = require('vue')
window.eventBus = new Vue()

require('./ui')
Vue.use(swal)
Vue.use(toastr)
// Vue.use(VeeValidate)
Vue.use(VueFlashMessage);


// Vue.component('admin-add-formation', require('./components/backend/formations/add-formation'))

const app = new Vue({
    el: '#app'
});
