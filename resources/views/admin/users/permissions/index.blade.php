@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('roles.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-grid"></i> Roles
            </a>
            <a href="{{ route('permissions.create') }}" class="btn btn-lg btn-success">
                <i class="ion-plus"></i> Add Permission
            </a>
        </div>

        <div class="title">
            Permissions
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
                            <th>Name</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($permissions as $permission)
                            <tr data-href="{{ route('permissions.edit', $permission->id) }}">
                                <td class="bold">{{ title_case(str_replace('_', ' ', $permission->name)) }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($permission->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
        </div>

        <div class="mt-20 text-center">
            {{ $permissions->links() }}
        </div>
    </section>


@endsection
