<template>
  <div id="map"></div>
</template>
<script>
export default {
  name: "Maps",
  data: () => ({

  }),

  mounted () {
    this.initMap()
  },

  methods: {

    initMap () {
      var map
      var mapOptions = {
        zoom: 8,
        center: { lat: -34.397, lng: 150.644 }
      };
      map = new google.maps.Map(document.getElementById("map"), mapOptions);

      var marker = new google.maps.Marker({
        // The below line is equivalent to writing:
        // position: new google.maps.LatLng(-34.397, 150.644)
        position: { lat: -34.397, lng: 150.644 },
        map: map
      });

      // You can use a LatLng literal in place of a google.maps.LatLng object when
      // creating the Marker object. Once the Marker object is instantiated, its
      // position will be available as a google.maps.LatLng object. In this case,
      // we retrieve the marker's position using the
      // google.maps.LatLng.getPosition() method.
      var infowindow = new google.maps.InfoWindow({
        content: "<p>Marker Location:" + marker.getPosition() + "</p>"
      });

      google.maps.event.addListener(marker, "click", function() {
        infowindow.open(map, marker);
      });
    }
  }
}
</script>
