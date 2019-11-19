@extends('admin.body')



@section('body')
<div class="page-title">
    <h3>Dashboard</h3>
</div>

<div class="dashboard">
    <div class="container-fluid">
        <div class="cards row">
            <div class="col-sm-3">
                <div class="card blue">
                    <h3>{{ count($users) }}</h3>
                    <h5>Utilisateurs</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card red">
                    <h3>{{ count($etudiants) }}</h3>
                    <h5>Stagiaires</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card green">
                    <h3>{{ count($formateurs) }}</h3>
                    <h5>Formateurs</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card dark">
                    <h3>{{ count($formations) }}</h3>
                    <h5>Formations</h5>
                </div>
            </div>
        </div>

        <div class="row mt-20 bg-white">
          <form class="_form pt-20" action="" method="get">
            <div class="col-sm-3">
                <div class="form-select grey">
                    <select name="region_id" class="form-control input-lg">
                        <option value="">Toutes les régions</option>
                        @foreach ($regions as $item)
                            <option value="{{ $item->id }}" {{ Request::get('region_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-select grey">
                    <select name="departement_id" class="form-control input-lg">
                        <option value="">Tous les départements</option>
                        @foreach ($departements as $item)
                            <option value="{{ $item->id }}" {{ Request::get('departement_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-select grey">
                    <select name="commune_id" class="form-control input-lg">
                        <option value="">Toutes les communes</option>
                        @foreach ($communes as $item)
                            <option value="{{ $item->id }}"{{ Request::get('commune_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-select grey">
                    <select name="thematique_id" class="form-control input-lg">
                        <option value="">Toutes les thématiques</option>
                        @foreach ($thematiques as $item)
                            <option value="{{ $item->id }}"{{ Request::get('thematique_id') == $item->id ? 'selected' : '' }}>{{ $item->name }} : {{ $item->duree }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-3 mt-20">
                <div class="form-group">
                    <input type="datetime-local" name="start_date" class="form-control input-lg">
                </div>
            </div>

            <div class="col-sm-3 mt-20">
                <div class="form-group">
                    <input type="datetime-local" name="end_date" class="form-control input-lg">
                </div>
            </div>

            <div class="col-sm-3 mt-20">
                <button type="submit" class="btn btn-lg btn-primary btn-block bold">
                    Rechercher
                </button>
            </div>
          </form>

          @if ($search)
            <div class="col-sm-12 mt-40">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>Titre</th>
                          <th>Status</th>
                          <th>Nbre places</th>
                          <th>Cree le</th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($search as $item)
                          <tr data-href="">
                              <td class="bold">{{ $item->title }}</td>
                              <td class="text-center">{{ $item->is_active ? 'Active' : 'Non active' }}</td>
                              <td class="text-center">{{ $item->qte_requis }}</td>
                              <td class="text-center">{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          @endif
        </div>
    </div>
</div>


@endsection
