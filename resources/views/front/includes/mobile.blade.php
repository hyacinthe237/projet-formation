<script>
var mobile = 'https://www.m';
mobile += {!! json_encode(config('app.env') !== 'local' ? '' : '.staging') !!};
mobile += '.formationpnfmv.com'

if (screen.width < 699) {
    var intended = window.location.pathname
    mobile += intended
    document.location.href = mobile;
}
</script>
