@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('stagiaires.download',
              [
                'structure' => Request::get('structure'),
                'commune_formation' => Request::get('commune_formation'),
                'fonction' => Request::get('fonction'),
                'keywords' => Request::get('keywords'), 
              ])}}" class="btn btn-lg btn-success" target="_blank">
                <i class="ion-document"></i> PDF Liste
            </a>
            <a href="{{ route('fonctions.index') }}" class="btn btn-lg btn-dark">
                <i class="ion-ios-keypad"></i> Fonctions
            </a>
            <a href="{{ route('structures.index') }}" class="btn btn-lg btn-warning">
                <i class="ion-ios-keypad"></i> Structures
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
                                <select class="form-control input-lg" name="structure">
                                    <option value="">Toutes les structures</option>
                                    @if (is_array($data['communes']) || is_object($data['communes']))
                                      @foreach($data['communes'] as $item)
                                          <option value="{{ $item->id }}"
                                            {{ Request::get('structure') == $item->id ? 'selected' : '' }}>
                                              {{ 'Commune de ' . $item->name }}
                                          </option>
                                      @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="commune_formation">
                                    <option value="">Toutes les formations</option>
                                    @if (is_array($data['formations']) || is_object($data['formations']))
                                        @foreach($data['formations'] as $item)
                                            <option value="{{ $item->id }}"
                                              {{ Request::get('commune_formation') == $item->id ? 'selected' : '' }}>
                                                {{ $item->formation->title }} de {{ $item->commune->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="student_category">
                                    <option value="">Toutes les catégories</option>
                                    @foreach($data['categories'] as $item)
                                        <option value="{{ $item->id }}"
                                          {{ Request::get('student_category') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="fonction">
                                    <option value="">Toutes les fonctions</option>
                                    @if (is_array($data['fonctions']) || is_object($data['fonctions']))
                                        @foreach($data['fonctions'] as $item)
                                            <option value="{{ $item->id }}"
                                              {{ Request::get('fonction') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
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
                            <th>Téléphone</th>
                            <th>Structure</th>
                            <th>Fonction</th>
                            <th>Etat</th>
                            <th>Nbre Form.</th>
                            <th>Créé le</th>
                        </tr>
                    </thead>

                    <tbody>
                      @if (is_array($data['etudiants']) || is_object($data['etudiants']))
                              @foreach($data['etudiants'] as $etudiant)
                                  <tr data-href="{{ route('stagiaires.edit', $etudiant->number) }}">
                                      <td> <img src="{{ $etudiant->getImgAttribute() }}" alt="" width="70px" height="70px" class="img-round"> </td>
                                      <td class="bold">{{ $etudiant->getNameAttribute() }}</td>
                                      <td>{{ $etudiant->email }}</td>
                                      <td>{{ $etudiant->phone }}</td>
                                      <td>{{ $etudiant->structure ? 'Commune de ' . $etudiant->structure->name : '---' }}</td>
                                      <td>{{ $etudiant->fonction ? $etudiant->fonction->name : '---' }}</td>
                                      <td>{{ $etudiant->is_active ? 'Actif' : 'Non Actif'}}</td>
                                      <td>{{ count($etudiant->formations) }}</td>
                                      <td>{{ date('d/m/Y H:i', strtotime($etudiant->created_at)) }}</td>
                                  </tr>
                              @endforeach
                      @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection
