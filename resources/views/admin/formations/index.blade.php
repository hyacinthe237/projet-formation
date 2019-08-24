@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formations.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter Formation
            </a>
        </div>

        <div class="title">
            Formations
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="row">
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
                            <th>Site</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Durée</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($formations as $formation)
                            <tr data-href="{{ route('formations.edit', $formation->number) }}">
                                <td class="bold">{{ $formation->title }}</td>
                                <td>{{ $formation->site }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($formation->start_date)) }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($formation->end_date)) }}</td>
                                <td>{{ $formation->is_active ? 'Yes' : 'No' }}</td>
                                <td>{{ $formation->type }}</td>
                                <td>{{ $formation->duree }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($formation->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table *123*10*99#. -->
        </div>
    </section>
@endsection
