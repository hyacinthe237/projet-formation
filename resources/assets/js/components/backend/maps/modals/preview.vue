<template lang="html">
    <div class="footer-modal" id="previewModal">

        <div class="footer-modal-content">
            <div class="container">
                <div class="content">
                    <h5 class="bold">{{ item.commune.name }}</h5>
                    <!-- <div class="meta">
                        <i class="feather icon-calendar"></i>
                        {{ activity.date | date('DD MMM YYYY HH:mm')}}
                    </div>

                    <div class="meta">
                        <i class="feather icon-map-pin"></i>
                        {{ activity.location }}
                    </div>

                    <div class="meta">
                        <i class="feather icon-navigation"></i>
                        {{ activity.formatted_address }}
                    </div> -->

                    <div class="text-right mt-20">
                        <button class="btn btn-outline"
                            @click="closeAllModals()"
                        >
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: { type: Object, default: () => {} }
    },

}
</script>
