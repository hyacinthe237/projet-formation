<template lang="html">
            <div class="row">
                <div class="col-sm-12">

                    <div class="login-form">
                        <div class="title mt-20">Modification mot de passe</div>

                         <form class="_form mt-10" @submit.prevent="reset()">
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label for="password">Mot de Passe</label>
                                     <input type="password"
                                         name="password"
                                         placeholder="Mot de Passe"
                                         v-validate="'required|min:6'"
                                         v-model="ghost.password"
                                         class="form-control input-lg">
                                         <span class="has-error">{{ errors.first('password') }}</span>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label for="password">Confirmation mot de Passe</label>
                                     <input type="password"
                                         name="confirmation"
                                         placeholder="Confirmation mot de passe"
                                         v-validate="'required|min:6'"
                                         v-model="ghost.confirmation"
                                         class="form-control input-lg">
                                         <span class="has-error">{{ errors.first('confirmation') }}</span>
                                 </div>
                             </div>

                            <div class="mt-20 pull-right">
                                <izy-btn :loading="isLoading" block>
                                <i class="ion-android-create"></i>
                                    Modifier
                                </izy-btn>
                            </div>

                       </form>
                    </div>

                </div>
            </div>
</template>

<script>
export default {
    name: 'admin-reset-password',

    data: () => ({
        user: {}
    }),

    mounted () {
        this.user = _user || {}
    },

    methods: {
        async reset () {
            const isValid = await this.$validator.validate()
            if (!isValid ) return false;

            this.isLoading = true

            try {
                const response = await webAxios.post(`/admin/users/${this.user.email}/reset`, this.ghost)
                this.$swal.success('Mot de passe modifié !')
                this.resetGhost()
            } catch (e) {
                console.log(e)
                this.$swal.error(e.response.data)
            }

            this.isLoading = false
        },

        resetGhost() {
            this.ghost = {
                password: ''
            }
        }
    }
}
</script>
