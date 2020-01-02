@extends('admin.body')

@section('body')
<div class="page-heading">
    <div class="buttons">
        <a href="{{ route('dashboard.statistiques') }}" class="btn btn-lg btn-success" target="_blank">
            <i class="ion-document"></i> Télécharger PDF
        </a>
    </div>

    <div class="title">
        Dashboard - Session {{ $data['session']->name }}

    </div>
</div>

<div class="dashboard">
    <div class="container-fluid">
        <div class="cards row mt-20">
            {{-- <div class="col-sm-3">
                <div class="card blue">
                    <h3>{{ count($users) }}</h3>
                    <h5>Utilisateurs</h5>
                </div>
            </div> --}}

            <div class="col-sm-4">
                <div class="card red">
                    <h3>{{ count($data['etudiants']) }}</h3>
                    <h5>Stagiaires</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card green">
                    <h3>{{ count($data['formateurs']) }}</h3>
                    <h5>Formateurs</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card dark">
                    <h3>{{ count($data['formations']) }}</h3>
                    <h5>Formations</h5>
                </div>
            </div>

            <div class="col-sm-12 mt-40 mb-10">
                <h4 class="bold">Taux de couverture</h4>
            </div>
            <div class="col-sm-4">
                <div class="card green">
                    {{-- <i class="ion-users"></i> --}}
                    <h3>{{ $data['totalPersonnePrevuFormer'] . ' %' }}</h3>
                    <h5>Personnes formées</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card red">
                    {{-- <i class="ion-city"></i> --}}
                    <h3>{{ $data['communesToucher'] . ' %' }}</h3>
                    <h5>Communes touchées</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card warning">
                    {{-- <i class="ion-mark"></i> --}}
                    <h3>{{ $data['formationExecuter'] . ' %' }}</h3>
                    <h5>Formations exécutées</h5>
                </div>
            </div>
        </div>



        <div class="cards row mt-40">
            <div class="col-sm-12 bg-white">
              <h4 class="mt-20">Participation des communes par formations </h4>

              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="td-5">#</th>
                          <th class="td-30">Formations</th>
                          <th class="td-30">Communes</th>
                          <th class="td-5">Pers. Formée</th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($data['allFormations'] as $formation)
                        <tr>
                            <td class="bold td-5">{{ $formation->number }}</td>
                            <td class="bold td-30">{{ $formation->title }}</td>
                            <td class="td-30">
                              @if ($formation->communes)
                                  @foreach ($formation->communes as $item)
                                    {{ $item->name . ', '}}
                                  @endforeach
                              @endif
                            </td>
                            <td class="td-5">{{ count($formation->personnes_formee) }}</td>
                        </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>

            <div class="col-sm-12 bg-white mt-20">
              <h4 class="mt-20">Participation des communes par régions</h4>

              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="td-10">Régions</th>
                          <th class="td-30">(Nbre) Communes</th>
                          <th class="td-5">Pers. Inscrites</th>
                          <th class="td-5">Pers. Formées</th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($data['regions'] as $region)
                          @if (count($region->commune_touchees))
                            <tr>
                                <td class="bold td-10">{{ $region->name }}</td>
                                <td class="td-30">({{count($region->commune_touchees)}}) @foreach ($region->commune_touchees as $item){{ $data['communes']->where('id', $item->commune_id)->first()->name . ', ' }}@endforeach</td>
                                <td class="td-5">{{count($region->personnes_inscrite)}}</td>
                                <td class="td-5">{{count($region->personnes_formee)}}</td>
                            </tr>
                          @endif
                      @endforeach
                  </tbody>
              </table>
            </div>

            <div class="col-sm-12 bg-white mt-20">
              <h4 class="mt-20">Participation des communes par départements</h4>

              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="td-10">Départements</th>
                          <th class="td-10">(Nbre) Communes</th>
                          <th class="td-10">Pers. Inscrites</th>
                          <th class="td-10">Pers. Formées</th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($data['departements'] as $item)
                          @if (count($item->commune_touchees))
                            <tr>
                                <td class="bold td-10">{{ $item->name }}</td>
                                <td class="bold td-10">({{ count($item->commune_touchees)}}) @foreach ($item->commune_touchees as $itm){{ $data['communes']->where('id', $itm->commune_id)->first()->name . ', ' }}@endforeach</td>
                                <td class="td-10">{{count($item->personnes_inscrite)}}</td>
                                <td class="td-10">{{count($item->personnes_formee)}}</td>
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
