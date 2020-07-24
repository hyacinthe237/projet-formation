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
            <div class="col-sm-3">
                <div class="card green">
                    {{-- <i class="ion-users"></i> --}}
                    <h3>{{ $data['totalPersonnesIncrites'] }}</h3>
                    <h5>Nombre d'inscription</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card red">
                    {{-- <i class="ion-users"></i> --}}
                    <h3>{{ $data['totalPersonnesFormees'] }}</h3>
                    <h5>Nombre Stagiaire formés</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card warning">
                    {{-- <i class="ion-city"></i> --}}
                    <h3>{{ $data['communesToucher'] . ' %' }}</h3>
                    <h5>Communes touchées</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card dark">
                    {{-- <i class="ion-mark"></i> --}}
                    <h3>{{ $data['formationExecuter'] . ' %' }}</h3>
                    <h5>Formations exécutées</h5>
                </div>
            </div>
        </div>

        <div class="mt-20">
            {{-- <chartjs-line></chartjs-line> --}}
            
        </div>

        <div class="cards row mt-20">
            <div class="col-sm-12 bg-white mt-20">
              <h4 class="mt-20 mb-20 text-center">STATISTIQUE DE L'ACTION PEDAGOGIQUE EN {{ $session->name }}</h4>

              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="td-3">#</th>
                          <th class="td-5">Régions</th>
                          <th class="td-5">Communes</th>
                          <th class="td-5">Pers. Inscrites</th>
                          <th class="td-5">Pers. Formées</th>
                          <th class="td-5">Pers. CU</th>
                          <th class="td-5">Pers. Mairie</th>
                          <th class="td-5">SG</th>
                          <th class="td-5">Cadre Com Tech</th>
                          <th class="td-5">Pers. SDE</th>
                          <th class="td-5">Pers. Scte Civil</th>
                          <th class="td-5">Pers. FEICOM</th>
                          <th class="td-5">Pers. Autres proj/prog</th>
                          <th class="td-5">Pers. Assoc Com</th>
                          <th class="td-5">Pers. C2D</th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($data['regions'] as $region)
                        <tr>
                            <td class="td-3">{{ $region->id }}</td>
                            <td class="bold td-5">{{ $region->name }}</td>
                            <td class="td-5">{{ count($region->commune_touchees) }}</td>
                            <td class="td-5">{{ count($region->personnes_inscrite) }}</td>
                            <td class="td-5">{{ count($region->personnes_formee) }}</td>
                            <td class="td-5">{{ count($region->personnes_cu) }}</td>
                            <td class="td-5">{{ count($region->personnes_mairie) }}</td>
                            <td class="td-5">{{ count($region->personnes_sg) }}</td>
                            <td class="td-5">{{ count($region->personnes_cct) }}</td>
                            <td class="td-5">{{ count($region->personnes_sde) }}</td>
                            <td class="td-5">{{ count($region->personnes_sc) }}</td>
                            <td class="td-5">{{ count($region->personnes_feicom) }}</td>
                            <td class="td-5">{{ count($region->personnes_autres) }}</td>
                            <td class="td-5">{{ count($region->personnes_asscom) }}</td>
                            <td class="td-5">{{ count($region->personnes_c2d) }}</td>
                        </tr>
                      @endforeach

                        <tr>
                          <td class="td-3"></td>
                          <td class="td-5 bold">TOTAUX</td>
                          <td class="td-5">{{ $data['totalCommunesToucher'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesIncrites'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesFormees'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesCU'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesMairie'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesSG'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesCadreComTech'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesSDE'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesScteCivil'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesFEICOM'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesAutresProjProg'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesAssocCom'] }}</td>
                          <td class="td-5">{{ $data['totalPersonnesC2D'] }}</td>
                        </tr>
                  </tbody>
              </table>
            </div>
        </div>

        {{-- <div class="cards row mt-20">
            <div class="col-sm-12 bg-white mt-20">
              <h4 class="mt-20 mb-20 text-center">SYNTHESES DES CTD ATTEINTES EN {{ $session->name }}</h4>

              <table class="table table-striped">
                  <tbody>
                      <tr>
                          <td class="td-5">CTD formés en {{ $session->name }}</td>
                          <td class="td-5">{{ $data['totalCommunesToucher'] }}</td>
                      </tr>
                      <tr>
                          <td class="td-5">CTD nouvelles atteintes en {{ $session->name }}</td>
                          <td class="td-5">{{ $data['totalCommunesToucher'] }}</td>
                      </tr>
                      <tr>
                          <td class="td-5">CTD touchés plus d'une fois en {{ $session->name }}</td>
                          <td class="td-5">{{ $data['totalCommunesToucher'] }}</td>
                      </tr>
                      <tr>
                          <td class="td-5">CTD touchés depuis 2015</td>
                          <td class="td-5">{{ $data['totalCommunesToucher'] }}</td>
                      </tr>
                      <tr>
                          <td class="td-5">CTD restants à atteindre en {{ $session->name }}</td>
                          <td class="td-5">{{ $data['totalCommunesToucher'] }}</td>
                      </tr>
                  </tbody>
              </table>
            </div>
        </div> --}}


    </div>
</div>
@endsection
