<template lang="html">
    <section class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">

                    <div class="login-form">
                        <div class="logo-name text-center">{{ config.app_name }}</div>
                        <div class="title text-center">Connexion</div>

                         <form class="_form mt-10" @submit.prevent="signin()">
                            <div class="form-group">
                                <input type="email"
                                    name="email"
                                    placeholder="Email"
                                    class="form-control input-lg"
                                    v-model="ghost.email"
                                    v-validate="'required|email'">
                                    <span class="has-error">{{ errors.first('email') }}</span>
                            </div>


                            <div class="form-group">
                                <input type="password"
                                    name="password"
                                    placeholder="Password"
                                    v-validate="'required|min:6'"
                                    v-model="ghost.password"
                                    class="form-control input-lg">
                                    <span class="has-error">{{ errors.first('password') }}</span>
                            </div>


                            <div class="mt-20">
                                <izy-btn :loading="isLoading" :size="'lg'" block elevated>
                                <i class="ion-android-done-all"></i>
                                Connexion
                                </izy-btn>
                            </div>

                            <div class="links">
                                <a href="/admin/forgot">Mot de passe oublié</a>
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
    name: 'admin-add-formation',

    data: () => ({
        config: window.config
    }),

    methods: {
        async signin () {
            const isValid = await this.$validator.validate()
            if (!isValid ) return false;

            this.isLoading = true

            try {
                const response = await webAxios.post('/admin/addFormation', this.ghost)
                window.location = response.data.route
            } catch (e) {
                console.log(e)
                this.$swal.error(e.response.data)
            }

            this.isLoading = false
        }
    }
}
</script>
