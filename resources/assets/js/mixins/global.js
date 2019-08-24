import Vue from 'vue'

export default Vue.mixin({
    data: () => ({
        ghost: {},
        isLoading: false
    }),

    methods: {
        async validateForm () {
            const isValid = await this.$validator.validate()

            if (!isValid ) {
                const firstError = this.$validator.errors.items[0].msg

                if (firstError) {
                    this.$swal.error(firstError)
                }

                return false;
            }

            return true
        },

        closeAllModals () {
            window.$('.modal').modal('hide')
        },

        closeModal (id) {
            window.$('#' + id).modal('hide')
        },

        openModal (params) {
            setTimeout (() => {
                window.$('#' + params.id).modal('show')
            }, params.timeout ? params.timeout : 100)
        },

        stopLoading () {
            this.isLoading = false
        },

        startLoading () {
            this.isLoading = true
        }
    }
})
