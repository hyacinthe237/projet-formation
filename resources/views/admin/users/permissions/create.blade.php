@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('permissions.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            New Permission
        </div>
    </div>
{!! Form::open(['method' => 'POST', 'route' => ['permissions.store'], 'class' => '_form' ]) !!}
    <section class="container-fluid mt-20">

        @include('errors.list')

        <div class="block">
            <div class="block-content form">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Permission name</label>
                            <input type="text" name="name" class="form-control input-lg" placeholder="Permission's name" required>
                        </div>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="ion-checkmark"></i> Add Permission
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

{!! Form::close() !!}
@endsection
