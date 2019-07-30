@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('users.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit User

            @if ($user->is_verified)
                <div class="verify">
                    <i class="ion-checkmark"></i> Verified Account
                </div>
            @endif
        </div>
    </div>

{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')

        <div class="block">
            <div class="block-content form">

                <div class="row pb-20">
                    <div class="col-sm-3">
                        <label>Status</label>
                        <div class="form-select grey">
                            <select name="is_active" class="form-control input-lg">
                                <option value="0" {{ $user->is_active ? '' : 'selected'}}>Inactive</option>
                                <option value="1" {{ $user->is_active ? 'selected' : ''}}>Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label>Role</label>
                        <div class="form-select grey">
                            <select name="role_id" class="form-control input-lg">
                                @foreach( $roles as $role )
                                    <option value="{{$role->id}}" {{ $user->role_id == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label>Location</label>
                        <div class="form-select grey">
                            <select name="location_id" class="form-control input-lg">
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}" {{ $user->location_id == $location->id ? 'selected' : ''}}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" name="firstname" class="form-control input-lg" value="{{ $user->firstname }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" name="lastname" class="form-control input-lg" value="{{ $user->lastname }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control input-lg" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="phone" class="form-control input-lg" required value="{{ $user->phone }}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Driving Licence</label>
                            <input type="text" name="licence_number" class="form-control input-lg" value="{{ $user->licence_number }}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Licence Expiry Date</label>
                            <input type="text" name="license_expiry_date"
                                class="form-control input-lg date"
                                value="{{ $user->license_expiry_date }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('Country of issue') !!}

                            <select class="form-control input-lg" name="license_issued_place">
                                <option value="Australia">Australia</option>
                                 <option disabled>-------------------------------------</option>
                                @foreach ($countries as $c)
                                    <option value="{{ $c->name }}"
                                        {{ ($user && $user->license_issued_place == $c->name) ? 'selected' : '' }}
                                    >
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control input-lg" value="{{ $user->address }}">
                </div>

            </div>
        </div>
    </section>




    <div class="text-right mr-20">
        <button type="submit" class="btn btn-lg btn-primary">
            <i class="ion-checkmark"></i> Update User
        </button>
    </div>

{!! Form::close() !!}


<section class="mt-40">

    <form class="_form" action="{{ route('admin.password') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="container-fluid">
            <div class="block">
                <div class="block-content">
                    <h4>Update Password</h4>

                    <div class="row mt-20">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="password" name="password" required class="form-control input-lg" placeholder="New Password">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="password" name="password_confirm" required class="form-control input-lg" placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-lg btn-success btn-block">
                                <i class="flaticon-lock"></i> Save New Password
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
</section>
@endsection

@section('js')
<script type="text/javascript" src="/backend/js/scripts.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('.date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    })
})
</script>
@endsection
