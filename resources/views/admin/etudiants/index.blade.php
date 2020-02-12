@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('stagiaires.download')}}" class="btn btn-lg btn-success" target="_blank">
                <i class="ion-document"></i> PDF Liste
            </a>
            <a href="{{ route('stagiaires.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter stagiaire
            </a>
        </div>

        <div class="title">
            Stagiaires
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="residence_id">
                                    <option value="">Lieux de résidence</option>
                                    @foreach($data['communes'] as $item)
                                        <option value="{{ $item->id }}"
                                          {{ Request::get('residence_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="commune_formation_id">
                                    <option value="">Toutes les formations</option>
                                    @foreach($data['formations'] as $item)
                                        <option value="{{ $item->id }}"
                                          {{ Request::get('commune_formation_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->formation->title }} de {{ $item->commune->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="structure_id">
                                    <option value="">Toutes les structures</option>
                                    @foreach($data['structures'] as $item)
                                        <option value="{{ $item->id }}"
                                          {{ Request::get('structure_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="fonction_id">
                                    <option value="">Toutes les fonctions</option>
                                    @foreach($data['fonctions'] as $item)
                                        <option value="{{ $item->id }}"
                                          {{ Request::get('fonction_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-10">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text"
                                        name="keywords"
                                        class="form-control input-lg"
                                        value="{{ Request::get('keywords') }}"
                                        placeholder="Rechercher nom, prénom">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        Filtrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>

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
                            <th>Etat</th>
                            <th>Résident à</th>
                            <th>Nbre Form.</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data['etudiants'] as $etudiant)
                            <tr data-href="{{ route('stagiaires.edit', $etudiant->number) }}">
                                <td> <img src="{{ $etudiant->getImgAttribute() }}" alt="" width="70px" height="70px" class="img-round"> </td>
                                <td class="bold">{{ $etudiant->getNameAttribute() }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>{{ $etudiant->structure }}</td>
                                <td>{{ $etudiant->fonction }}</td>
                                <td>{{ $etudiant->is_active ? 'Actif' : 'Non Actif'}}</td>
                                <td>{{ $etudiant->residence ? $etudiant->residence->name : 'Non defini' }}</td>
                                <td>{{ count($etudiant->formations) }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($etudiant->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection
