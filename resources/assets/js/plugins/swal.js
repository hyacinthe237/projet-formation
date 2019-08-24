
import swal from 'sweetalert2'

var Swal = {}

Swal.install = function (Vue, options) {
    Vue.prototype.$swal = {
        success(title, msg) {
            return swal({
                title,
                text: msg ? msg : '',
                type: 'success'
            })
        },

        error(title, msg) {
            return swal({
                title,
                text: msg ? msg : '',
                type: 'error'
            })
        }
    }
}
 export default Swal
