@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('roles.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            New Role
        </div>
    </div>
{!! Form::open(['method' => 'POST', 'route' => ['roles.store'], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')

        <div class="block">
            <div class="block-content form">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Role name</label>
                            <input type="text" name="name" class="form-control input-lg" placeholder="Role's name" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Select level</label>
                            <select class="form-control input-lg" name="level">
                                <option value="1">Admin</option>
                                <option value="2">Editor</option>
                                <option value="3">Member</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label>Select permissions</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                            <span class="mr-10"></span> {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control input-lg" rows="8" cols="80" placeholder="role description"></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <div class="text-right mr-20">
        <button type="submit" class="btn btn-lg btn-primary">
            <i class="ion-checkmark"></i> Add role
        </button>
    </div>

{!! Form::close() !!}
@endsection
