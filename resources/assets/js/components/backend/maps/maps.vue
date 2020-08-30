<template lang="html">
  <div class="activities">
      <!-- <h4 v-if="activities.length == 0" class="mt-20">No activities</h4> -->

      <div class="activities-map" v-show="isMapView">
          <div id="map_canvas" style="width:100%;height:100vh"></div>
      </div>

      <previewModal :item="selected"></previewModal>
  </div>
</template>

<script>
import mapsService from "../../../services/maps"
import previewModal from "./modals/preview"
import defaultCover from './bg/europe.jpg'

const GOOGLE_API_KEY = 'AIzaSyBs3PrvdiQRO9l436VQ6hecvQE3-wv1ppE'

export default {
    data: () => ({
        google: null,
        latitude: null,
        longitude: null,
        isMapView: true,
        selected: {},
        map: defaultCover,
        payload: {
            lat: null,
            lon: null
        }
    }),

    components: { previewModal },

    async mounted () {
        this.initGoogle()
        this.getDashboard()
    },

    computed: {
        communes () {
            return this.$store.state.communes
        },

        /**
        * Get a list of markers
        *
        * @return {Array}
        */
        markers() {
            if (this.communes && this.communes.length) {
                return this.communes.map(item => {
                    return {
                        position: {
                            lat: item.commune.lat,
                            lng: item.commune.lon
                        }
                    }
                })
            }
            return [];
        },

        /**
        * Get the first marker
        *
        * @return {Object}
        */
        center() {
            if (this.markers.length) return this.markers[0].position
            return null
        }
    },

    watch: {
        center: {
            immediate: true,
            handler: function(val) {
                if (val !== null && this.google !== null) {
                    this.initMap()
                }
            }
        },

        google: {
            immedate: true,
            handler: function(val) {
                if (val !== null && this.center !== null) {
                    this.initMap()
                }
            }
        }
    },

    methods: {

        async initGoogle () {
            this.google = await mapsService()
        },

        /**
         * Get dashboard
         *
         * @return {void}
         */
        async getDashboard () {
            const response = await axios.get('/admin/dashboard')
                .catch(error => console.log(error))

            if (response) {
                console.log(response.data)
                this.$store.commit('SET_COMMUNES', response.data)
            }
        },

        toggleView () {
            this.isMapView = !this.isMapView
        },

        /**
        * Draw map if user is checked in
        *
        * @return {void}
        */
        initMap () {
            setTimeout(() => {
                const _that = this
                const map = new this.google.maps.Map( document.getElementById("map_canvas"), {
                    zoom: 10,
                    center: this.center,
                    disableDefaultUI: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                })

                for (let item of this.communes) {
                    const marker = new this.google.maps.Marker({
                        map,
                        position: { lat: item.commune.lat, lng: item.commune.lon }
                    })

                    const infoWindow = new this.google.maps.InfoWindow({
                        content: `
                            <p>${item.commune.name}</p>
                        `
                    })

                    this.google.maps.event.addListener(marker, 'click', function () {
                        _that.preview(item)
                        marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png')
                    })
                }

                map.setZoom(10)
                map.panTo(this.center)
            }, 500)
        },

        preview (commune) {
          this.selected = commune
          this.openModal('previewModal')
        },

        /**
         * Get static map URL
         *
         * @return {void}
         */
        async getMap (commune) {
            let url = 'https://maps.googleapis.com/maps/api/staticmap?zoom=10&size=400x400'
            url += `&center=${this.commune.lat},${this.commune.lon}&maptype=roadmap`
            url += `&markers=color:green%7C${this.commune.lat},${this.commune.lon}`
            this.map = url += `&key=${GOOGLE_API_KEY}`
        },

    }
}
</script>
