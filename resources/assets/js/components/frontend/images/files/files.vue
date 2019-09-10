<template lang="html">
    <div class="row">
        <div class="col-sm-2" v-for="f in files">
            <div :class="['img-item']">

                <a :href="f.link" target="_blank">
                    <img :src="f.link" :alt="f.name" class="img-responsive">
                </a>

                <div class="_delete" @click="deleteFile(f)"><i class="ion-close"></i></div>

            </div>
        </div>


        <izy-modal :id="'deleteFileModal'">

            <h4>Are you sure you want to delete the attachment:</h4>

            <strong>{{ deletingFile.name }}</strong>


            <div class="mt-20">
                <button class="btn btn-md btn-teal" data-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-md btn-danger pull-right" @click="deleteFileConfirmed()">
                    Delete permanently
                </button>
            </div>
        </izy-modal>

    </div>

</template>

<script>
export default {
    props: ['files', 'model'],

    data: () => ({
        deletingFile: {},
    }),

    methods: {
        async deleteFileConfirmed () {
            const file = this.deletingFile

            let url = 'models/' + this.model.id + '/remove/attachments/' + file.id

            const response = await axios.get(url)
            .catch(error => {
                this.$swal.error(error.response.data.message)
            })

            if (response) {
                this.$toastr.success('File successfully deleted')
                this.closeModal('deleteFileModal')
                this.$emit('fileDeleted')
            }
        },

        deleteFile (file) {
            this.deletingFile = Object.assign({}, file)
            this.openModal({ id: 'deleteFileModal' })
        },
    }
}
</script>
