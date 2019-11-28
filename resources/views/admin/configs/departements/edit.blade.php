@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('users.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit Role
        </div>
    </div>

    <section class="container-fluid mt-20">
        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id], 'class' => '_form' ]) !!}


        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Role name</label>
                            <input type="text" name="name" class="form-control input-lg" value="{{ $role->name }}" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label>Select level</label>
                        <div class="form-select grey">
                            <select name="level" class="form-control input-lg">
                                <option value="1" {{ $role->level === 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $role->level === 2 ? 'selected' : ''}}>Editor</option>
                                <option value="3" {{ $role->level === 3 ? 'selected' : ''}}>Member</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label>Select permissions</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        @if (in_array($permission->id, $tab))
                                            <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" checked>
                                                <span class="mr-10"></span> {{ $permission->name }}
                                            </label>
                                        @else
                                            <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                                <span class="mr-10"></span> {{ $permission->name }}
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control input-lg" rows="8" cols="80">{{ $role->description }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>





    <div class="text-right mr-20">
        <button type="submit" class="btn btn-lg btn-primary">
            <i class="ion-checkmark"></i> Update Role
        </button>
    </div>

{!! Form::close() !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">
                        Delete Role
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

    @include('admin.modals.confirm', [
        'route'    => 'roles.destroy',
        'method'   => 'POST',
        'resource' => $role,
        'confirm'  => 'Yes, delete',
        'message'  => 'Are you sure you want to permanently delete this role?'
    ])
@endsection
