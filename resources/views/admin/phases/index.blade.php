@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('phases.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter Phase
            </a>
        </div>

        <div class="title">
            Phases
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text"
                                name="keywords"
                                class="form-control input-lg"
                                value="{{ Request::get('keywords') }}"
                                placeholder="Recherche...">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @include('errors.list')

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($phases as $phase)
                            <tr data-href="{{ route('phases.edit', $phase->id) }}">
                                <td>{{ $phase->title }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($phase->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
        </div>
    </section>


@endsection
