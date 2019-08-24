<template lang="html">
    <section class="login-page">
        <flash-message transitionIn="animated swing"></flash-message>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="login-form">
                        <div class="logo-name text-center">Boukarou</div>
                        <div class="title text-center">Mot de passe oublié</div>

                         <form class="_form mt-10" @submit.prevent="forgot()">
                            <div class="form-group">
                                <input type="email"
                                    name="email"
                                    placeholder="Votre adresse email"
                                    class="form-control input-lg"
                                    v-model="ghost.email"
                                    v-validate="'required|email'">
                                    <span class="has-error">{{ errors.first('email') }}</span>
                            </div>


                            <div class="mt-20">
                                <izy-btn :loading="isLoading" :size="'lg'" block elevated>
                                <i class="ion-paper-airplane"></i>
                                Envoyez le lien
                                </izy-btn>
                            </div>

                            <div class="links">
                                <a href="/admin/login">Connexion</a>
                            </div>

                       </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'admin-forgot-password',

    methods: {
        async forgot () {
            const isValid = await this.$validator.validate()
            if (!isValid ) return false;

            this.isLoading = true

            try {
                const response = await webAxios.post('/admin/forgot', this.ghost)
                this.flash(response.data.message, response.data.type);
                //console.log(response)
                //window.location = response.data.route
            } catch (e) {
                console.log(e)
                this.$swal.error(e.response.data)
            }

            this.isLoading = false
        }
    }
}
</script>

