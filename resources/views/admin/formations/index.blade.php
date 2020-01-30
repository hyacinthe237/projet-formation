@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formations.download')}}" class="btn btn-lg btn-success" target="_blank">
                <i class="ion-document"></i> PDF Liste
            </a>

            <a href="{{ route('formation.create') }}" class="btn btn-lg btn-primary">
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
                      <div class="col-sm-2">
                          <div class="form-select grey">
                              <select name="is_active" class="form-control input-lg">
                                  <option value="">Tous les status</option>
                                  <option value="0" {{ Request::get('is_active') == false ? 'selected' : '' }}>Inactivée</option>
                                  <option value="1" {{ Request::get('is_active') == true ? 'selected' : '' }}>Activée</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-8">
                          <div class="form-group">
                              <input type="text"
                              name="keywords"
                              class="form-control input-lg"
                              value="{{ Request::get('keywords') }}"
                              placeholder="Recherche...">
                          </div>
                      </div>

                      <div class="col-sm-2">
                          <button type="submit" class="btn btn-lg btn-primary btn-block">
                              Filtrer
                          </button>
                      </div>
                    </form>
                </div>
            </div>

            @include('errors.list')

            {{-- <div class="row">
                <div class="col-sm-4 text-center">
                    <p>{{ count($formations) > 1 ? count($formations) . ' Formations' : count($formations) . ' Formation' }} </p>

                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">

                    <p>{{ $stagiaires > 1 ? $stagiaires . ' Stagiares' : $stagiaires . ' Stagiare' }} </p>
                </div>
            </div> --}}

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="bold td-40">Titre</th>
                            <th class="td-5">Status</th>
                            <th class="td-10">Nbre. formateurs</th>
                            <th class="td-10">Nbre. sites</th>
                            <th class="td-10">Nbre. Stagiares</th>
                            <th class="td-10">Nbre. Inscris</th>
                            <th class="td-10">Nbre. Formés</th>
                            <th class="td-15">Crée le</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($formations as $formation)
                            <tr data-href="{{ route('formation.edit', $formation->number) }}">
                                <td class="bold td-40">{{ $formation->title }}</td>
                                <td class="td-5">{{ $formation->is_active ? 'Actif' : 'Non actif' }}</td>
                                <td class="td-10">{{ count($formation->formateurs) }}</td>
                                <td class="td-10">{{ count($formation->sites) }}</td>
                                <td class="td-10">{{ count($formation->etudiants) }}</td>
                                <td class="td-10">{{ count($formation->etudiants) }}</td>
                                <td class="td-10">{{ count($formation->formes) }}</td>
                                <td class="td-15">{{ date('d/m/Y H:i', strtotime($formation->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table *123*10*99#. -->
        </div>
    </section>
@endsection
