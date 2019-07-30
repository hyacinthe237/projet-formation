
{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'class' => 'form' ]) !!}

<div class="row pb-20">
    <div class="col-sm-6">
        <label>Status</label>
        <div class="form-select grey">
            <select name="is_active">
                <option value="0" {{ $user->is_active ? '' : 'selected'}}>Inactive</option>
                <option value="1" {{ $user->is_active ? 'selected' : ''}}>Active</option>
            </select>
        </div>
    </div>

    <div class="col-sm-6">
        <label>Role</label>
        <div class="form-select grey">
            <select name="role_id">
                @foreach( $roles as $role )
                    <option value="{{ $role->id}}" {{ $user->role_id == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>First name</label>
            <input type="text" name="firstname" class="form-control input-lg" value="{{ $user->firstname }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Last name</label>
            <input type="text" name="lastname" class="form-control input-lg" value="{{ $user->lastname }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control input-lg" value="{{ $user->email }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="phone" class="form-control input-lg" value="{{ $user->phone }}">
        </div>
    </div>
</div>


<div class="text-right mr-20">
    @if($user->is_verified)
        <a href="{{ route('admin.user.verify', $user->id) }}" class="btrn btn-lg btn-red pull-left">
            <i class="ion-checkmark-circle"></i> Unverify account
        </a>
    @else
        <a href="{{ route('admin.user.verify', $user->id) }}" class="btrn btn-lg btn-green pull-left">
            <i class="ion-checkmark-circle"></i> Verify account
        </a>
    @endif
    
    <button type="submit" class="btn btn-lg btn-blue">
        <i class="ion-checkmark"></i> Update User
    </button>
</div>
{!! Form::close() !!}
