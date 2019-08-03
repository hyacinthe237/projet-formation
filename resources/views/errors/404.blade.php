@extends('front.templates.app.default')

@section('head')
<title>404 | Izylearn</title>
@endsection


@section('body')
<section class="container">
    <div class="mt-100 pb-80 text-center">
        <h1>@lang('app.page_not_found')</h1>
    </div>
</section>

@endsection
