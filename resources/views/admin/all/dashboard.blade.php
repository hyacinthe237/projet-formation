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

            <div class="col-sm-12 mt-40">
                <h4 class="bold">Taux de couverture</h4>
            </div>
            <div class="col-sm-4">
                <div class="card blue">
                    <h3>{{ $TotalPersonnePrevuFormer . ' %' }}</h3>
                    <h5>Personnes formées</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card green">
                    <h3>{{ $communesToucher . ' %' }}</h3>
                    <h5>Communes touchées</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card dark">
                    <h3>{{ $FormationExecuter . ' %' }}</h3>
                    <h5>Formations exécutées</h5>
                </div>
            </div>
        </div>

        

        <div class="cards row bg-white mt-40">
            <div class="col-sm-6 mt-20">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>Nom de la région</th>
                          <th>Communes touchées</th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($regions as $region)
                          @if (count($region->commune_touchees))
                            <tr>
                                <td class="bold">{{ $region->name }}</td>
                                <td title="@foreach ($region->commune_touchees as $item){{ $communes->where('id', $item->commune_id)->first()->name . ', ' }}@endforeach">{{ count($region->commune_touchees)}}</td>
                            </tr>
                          @endif
                      @endforeach
                  </tbody>
              </table>
            </div>

            <div class="col-sm-6 mt-20">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>Nom du département</th>
                          <th>Communes touchées</th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($departements as $item)
                          @if (count($item->commune_touchees))
                            <tr>
                                <td class="bold">{{ $item->name }}</td>
                                <td title="@foreach ($item->commune_touchees as $itm){{ $communes->where('id', $itm->commune_id)->first()->name . ', ' }}@endforeach">{{ count($item->commune_touchees)}}</td>
                            </tr>
                          @endif
                      @endforeach
                  </tbody>
              </table>
            </div>
        </div>

    </div>
</div>
@endsection
