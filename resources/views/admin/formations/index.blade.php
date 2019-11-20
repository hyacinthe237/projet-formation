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
                          {{-- <div class="form-select grey">
                              <select name="is_active" class="form-control input-lg">
                                  <option value="">Tous les status</option>
                                  <option value="0" {{ Request::get('is_active') == 0 ? 'selected' : '' }}>Inactivée</option>
                                  <option value="1" {{ Request::get('is_active') == 1 ? 'selected' : '' }}>Activée</option>
                              </select>
                          </div> --}}
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

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Status</th>
                            <th>Nbre formateurs</th>
                            <th>Nbre sites</th>
                            <th>Nbre places</th>
                            <th>Nbre phases</th>
                            <th>Cree le</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($formations as $formation)
                            <tr data-href="{{ route('formation.edit', $formation->number) }}">
                                <td class="bold td-40">{{ $formation->title }}</td>
                                <td class="td-10">{{ $formation->is_active ? 'Active' : 'Non active' }}</td>
                                <td class="td-10">{{ count($formation->formateurs) }}</td>
                                <td class="td-10">{{ count($formation->sites) }}</td>
                                <td class="td-10">{{ $formation->qte_requis }}</td>
                                <td class="td-10">{{ count($formation->phases) }}</td>
                                <td class="td-10">{{ date('d/m/Y H:i', strtotime($formation->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table *123*10*99#. -->
        </div>
    </section>
@endsection
