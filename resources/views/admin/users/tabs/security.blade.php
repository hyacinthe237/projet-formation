<form class="form" action="{{ route('admin.password') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="user_id" value="{{ $user->id }}">

    <h2>Update Password</h2>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="password" name="password_current" required class="form-control input-lg" placeholder="Current Password">
            </div>
        </div>

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
    </div>

    <div class="mt-10 text-right">
        <button type="submit" class="btn btn-lg btn-green">
            <i class="flaticon-lock"></i> Save New Password
        </button>
    </div>
</form>
