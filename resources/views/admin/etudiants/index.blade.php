@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('etudiants.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter Etudiant
            </a>
        </div>

        <div class="title">
            Etudiants
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="location_id">
                                    <option value="">Toutes les lieux de résidence</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}"
                                          {{ Request::get('location_id') == $location->id ? 'selected' : '' }}>
                                            {{ 'Région: ' . $location->region }}|
                                            {{ 'Département: ' . $location->departement }}|
                                            {{ 'Commune: ' .$location->commune }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="formation_id">
                                    <option value="">Toutes les formations</option>
                                    @foreach($formations as $formation)
                                        <option value="{{ $formation->id }}"
                                          {{ Request::get('formation_id') == $formation->id ? 'selected' : '' }}>
                                            {{ $formation->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
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
                        </div>
                    </form>
                </div>
            </div>

            @include('errors.list')

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Structure</th>
                            <th>Fonction</th>
                            <th>Active</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr data-href="{{ route('etudiants.edit', $etudiant->number) }}">
                                <td> <img src="{{ $etudiant->getImgAttribute() }}" alt="" width="70px" height="70px" class="img-round"> </td>
                                <td class="bold">{{ $etudiant->getNameAttribute() }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>{{ $etudiant->structure }}</td>
                                <td>{{ $etudiant->fonction }}</td>
                                <td>{{ $etudiant->is_active ? 'Yes' : 'No'}}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($etudiant->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table *123*10*99#. -->
        </div>
    </section>


@endsection
