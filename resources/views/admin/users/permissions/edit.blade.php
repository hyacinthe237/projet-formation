@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('permissions.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit Permission
        </div>
    </div>

    <section class="container-fluid mt-20">
        {!! Form::model($permission, ['method' => 'PATCH', 'route' => ['permissions.update', $permission->id], 'class' => '_form' ]) !!}


        @include('errors.list')

        <div class="block">
            <div class="block-content form">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Permission name</label>
                            <input type="text" name="name" class="form-control input-lg" value="{{ str_replace('_', ' ', $permission->name) }}" required>
                        </div>
                    </div>

                    <div class="col-sm-3 pull-right">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="ion-checkmark"></i> Update permission
                        </button>
                    </div>
                </div>

            </div>
        </div>

{!! Form::close() !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">
                        Delete permission
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

    @include('admin.modals.confirm', [
        'route'    => 'permissions.destroy',
        'method'   => 'POST',
        'resource' => $permission,
        'confirm'  => 'Yes, delete',
        'message'  => 'Are you sure you want to permanently delete this permission?'
    ])
@endsection
