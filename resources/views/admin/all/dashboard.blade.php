@extends('admin.body')

@section('body')
<div class="page-heading">
    <div class="buttons">
        <a href="#" class="btn btn-lg btn-success" target="_blank">
            <i class="ion-document"></i> Télécharger PDF
        </a>
    </div>

    <div class="title">
        Dashboard

    </div>
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
                    <h3>{{ count($data['etudiants']) }}</h3>
                    <h5>Stagiaires</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card green">
                    <h3>{{ count($data['formateurs']) }}</h3>
                    <h5>Formateurs</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card dark">
                    <h3>{{ count($data['formations']) }}</h3>
                    <h5>Formations</h5>
                </div>
            </div>

            <div class="col-sm-12 mt-40">
                <h4 class="bold">Taux de couverture</h4>
            </div>
            <div class="col-sm-4">
                <div class="card blue">
                    <h3>{{ $data['totalPersonnePrevuFormer'] . ' %' }}</h3>
                    <h5>Personnes formées</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card green">
                    <h3>{{ $data['communesToucher'] . ' %' }}</h3>
                    <h5>Communes touchées</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card dark">
                    <h3>{{ $data['formationExecuter'] . ' %' }}</h3>
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
                      @foreach($data['regions'] as $region)
                          @if (count($region->commune_touchees))
                            <tr>
                                <td class="bold">{{ $region->name }}</td>
                                <td title="@foreach ($region->commune_touchees as $item){{ $data['communes']->where('id', $item->commune_id)->first()->name . ', ' }}@endforeach">{{ count($region->commune_touchees)}}</td>
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
                      @foreach($data['departements'] as $item)
                          @if (count($item->commune_touchees))
                            <tr>
                                <td class="bold">{{ $item->name }}</td>
                                <td title="@foreach ($item->commune_touchees as $itm){{ $data['communes']->where('id', $itm->commune_id)->first()->name . ', ' }}@endforeach">{{ count($item->commune_touchees)}}</td>
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
