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
            <div class="col-sm-12 mb-10">
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
            <div class="col-sm-12 bg-white mt-20">
              <h4 class="mt-20 mb-20 text-center">STATISTIQUE DE L'ACTION PEDAGOGIQUE EN {{ $session->name }}</h4>

              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="td-3">#</th>
                          <th class="td-10">Régions</th>
                          <th class="td-30">(Nbre) Communes</th>
                          <th class="td-5">Nbre. Pers. Inscrites</th>
                          <th class="td-5">Nbre. Pers. Formées</th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($data['regions'] as $region)
                          @if (count($region->commune_touchees))
                            <tr>
                                <td class="td-3">{{ $region->id }}</td>
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
        </div>

    </div>
</div>
@endsection
