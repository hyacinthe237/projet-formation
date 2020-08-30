import moment from 'moment'
import mapsService from '@/services/maps'
import profile from '@/assets/images/profile.jpg'
import defaultCover from '@/assets/images/maps/europe.jpg'

export default {
    data: () => ({
        google: null,
        showAddress: false,
        ghost: {
            postcode: '',
            address: '',
            country: '',
            state: '',
            city: '',
        },
        map: defaultCover,
        image: '',
        options: {
            quality: 70,
            correctOrientation: true
        },

        camera: 'camera',
        platform: 'browser'
    }),

    mounted () {
        this.initGoogle()
        const auth = this.$store.state.auth
        this.$set(this.ghost, 'organizer', `${auth.firstname} ${auth.lastname}`)

        document.addEventListener("deviceready", () => {
            this.camera = navigator.camera
            this.platform = window.device.platform
        }, false)
    },

    computed: {
        categories () {
            return this.$store.state.lists['categories']
        },
    },

    methods: {
        async initGoogle () {
            this.google = await mapsService()
            this.initAutocomplete()
        },

        initAutocomplete () {
            const _that = this
            let input = document.getElementById('address')
            let autocomplete = new this.google.maps.places.Autocomplete(input)
            autocomplete.setFields(['address_components', 'geometry', 'formatted_address'])

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace()
                const comp  = place.address_components
                console.log('place ==> ', place)
                _that.$set(_that.ghost, 'address', _that.extractAddress(comp))
                _that.$set(_that.ghost, 'city', _that.extractCity(comp))
                _that.$set(_that.ghost, 'state', _that.extractFields(comp, 'administrative_area_level_1', false))
                _that.$set(_that.ghost, 'country', _that.extractFields(comp, 'country'))
                _that.$set(_that.ghost, 'postcode', _that.extractFields(comp, 'postal_code'))
                _that.$set(_that.ghost, 'lat', place.geometry.location.lat())
                _that.$set(_that.ghost, 'lon', place.geometry.location.lng())
                _that.$set(_that.ghost, 'formatted_address', place.formatted_address)
            })
        },

        /**
         * Extract field from array
         *
         * @return {String}
         */
        extractFields(components, type, long = true) {
            return components.filter((component) => component.types.includes(type))
                .map((item) => item[long ? 'long_name' : 'short_name']).pop() || ''
        },

        /**
         * Extract address from components
         *
         * @return {String}
         */
        extractAddress(comp) {
            let house  = this.extractFields(comp, 'street_number')
            let street = this.extractFields(comp, 'route')
            street = street || this.extractFields(comp, 'sublocality_level_1')

            let str = house ? house + ' ' : ''
            str += street
            str = str == '' ? this.extractCity(comp) : str
            return str
        },

        /**
         * Find city from components
         *
         * @return {String}
         */
        extractCity (comp) {
            let city = this.extractFields(comp, 'locality')
            return city || this.extractFields(comp, 'administrative_area_level_2')
        },

        /**
         * take picture
         * @return {Promise} [description]
         */
        async takePicture () {
            const self = this

            const options = {
                quality: 70,
                cameraDirection: Camera.Direction.FRONT,
                sourceType: Camera.PictureSourceType.SAVEDPHOTOALBUM,
                mediaType: Camera.MediaType.PICTURE
            }

            if (this.platform !== 'browser') {
                this.camera.getPicture((response) => {
                    self.imageSuccess(response)
                }, (error) => {
                    console.log('camera error => ', error)
                }, options)
            }
        },

        imageSuccess (response) {
            const self = this

            var xhr = new XMLHttpRequest();
            let imageLink = window.Ionic.WebView.convertFileSrc(response)
            xhr.onload = function() {
                var reader = new FileReader()

                reader.onloadend = function() {
                    console.log('reader.result => ', reader.result)
                    self.image = reader.result
                    self.ghost.image = reader.result
                }

                reader.readAsDataURL(xhr.response)
            }

            xhr.open('GET', imageLink)
            xhr.responseType = 'blob';
            xhr.send()
        },

        /**
         * Get static map URL
         *
         * @return {void}
         */
        async getMap () {
            let url = 'https://maps.googleapis.com/maps/api/staticmap?zoom=10&size=400x400'
            url += `&center=${this.activity.lat},${this.activity.lon}&maptype=roadmap`
            url += `&markers=color:green%7C${this.activity.lat},${this.activity.lon}`
            this.map = url += `&key=${this.$config.get('google_api_key')}`
        },
    }
}
