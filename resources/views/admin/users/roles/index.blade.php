@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('users.index') }}" class="btn btn-lg btn-primary">
                <i class="ion-android-people"></i> Users
            </a>
            <a href="{{ route('permissions.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-grid"></i> Persmissions
            </a>

            <a href="{{ route('roles.create') }}" class="btn btn-lg btn-success">
                <i class="ion-plus"></i> Add Role
            </a>
        </div>

        <div class="title">
            Roles
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-4">

                        </div>

                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <input type="text"
                                        name="keywords"
                                        class="form-control input-lg"
                                        value="{{ Request::get('keywords') }}"
                                        placeholder="Find role">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Level</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($roles as $role)
                            <tr data-href="{{ route('roles.edit', $role->id) }}">
                                <td class="bold">{{ $role->name }}</td>
                                <td>
                                    @if ($role->level === 1)
                                        Admin
                                    @endif

                                    @if ($role->level === 2)
                                        Editor
                                    @endif

                                    @if ($role->level === 3)
                                        Member
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y H:i', strtotime($role->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
        </div>

        <div class="mt-20 text-center">
            {{ $roles->links() }}
        </div>
    </section>


@endsection
