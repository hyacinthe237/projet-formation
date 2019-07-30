@extends('admin.body')

@section('head')
    <script>
        var _set = <?php echo json_encode($set); ?>;
    </script>
@endsection

@section('body')
    <div class="page-heading">
        <div class="title">
            Home Slider
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">

            <div class="row mt-40">
                <div class="col-sm-12">
                    <div class="block">
                        <div class="block-content">

                            <slider-files></slider-files>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
