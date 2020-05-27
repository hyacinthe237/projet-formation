
import globalMixins from './mixins/global'
import swal from './plugins/swal'
import toastr from './plugins/toastr'

require('./bootstrap')
require('./ui')

window.Vue = require('vue')
window.eventBus = new Vue()

Vue.use(swal)
Vue.use(toastr)

// Vue.component('charts', require('./components/backend/charts/charts'))

const app = new Vue({
    el: '#app'
});
