<script type="text/javascript" src="{{ asset('/backend/js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('/backend/fancybox/jquery.fancybox.js') }}"></script>
<script>
$(document).ready(function() {
    // $('.js-example-basic-multiple').select2({
    //     placeholder: 'Saisie au choix'
    // })

    $('.iframe-btn').fancybox({
        'width'     : 900,
        'maxHeight' : 600,
        'minHeight'    : 400,
        'type'      : 'iframe',
        'autoSize'      : false
    });

    $('.date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHightlight: true,
    })

    $("body").hover(function() {
        var profilePic = $("input[name='photo']").val();
        if(profilePic)
            $('#photo_view').html("<img class='thumbnail img-responsive mb-10' src='" + profilePic +"'/>");
    });
})
</script>
