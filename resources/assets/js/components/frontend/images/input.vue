<template lang="html">
        <section>
            <div class="attachments">

                <h5 class="bold">
                    <i class="ion-android-attach mr-5"></i> Téléchargez une photo
                </h5>

                <button class="btn btn-dark" @click="showUpload()" style="margin-top:10px;">
                    <i class="ion-android-upload"></i> Téléchargez
                </button>

                <Files
                    :files="files"
                    :model="model"
                    @fileDeleted="refresh">
                </Files>
            </div>

                <commons-upload
                    :uploadUrl="uploadUrl"
                    @uploaded="refresh"
                    :title="'Téléchargez une photo ici'"
                    :maxFiles="1">
                </commons-upload>

        </section>
</template>

<script>

import { mapGetters } from 'vuex'
import Files from './files/files'


export default {
    name: 'input-files',

    components: { Files },

    mounted () {
        this.model = _model
        this.refresh()
    },

    data: () => ({
        model: {},
        files: []
    }),

    computed: {
        uploadUrl () {
            return '/admin/uploads/model/' + _model.id
        }
    },

    watch: {
        files (val) {
            this.files
        }
    },

    methods: {
        refresh () {
            axios.get(`/models/${_model.id}`)
            .then(response => {
                this.model = response.data
                this.files = response.data.files
            })
            .catch(error => console.log(error))
        },
        /**
         * Show file upload modal
         */
        showUpload () {
            window.$('#uploadModal').modal('show')
        }
    }
}
</script>
