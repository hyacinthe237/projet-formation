@extends('admin.body')

@section('head')
  <script>
      var _auth = <?php echo json_encode(Auth::user()->api_token); ?>;
  </script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  let formData = new FormData();
  let req = new XMLHttpRequest();

  function drawChart () {

    var data = google.visualization.arrayToDataTable([
      ['Région', 'Commune touchée'],
      [Adamaoua.name,  Adamaoua.commune_touchees.length],
      [Centre.name, Centre.commune_touchees.length],
      [Est.name,  Est.commune_touchees.length],
      [ExtremeNord.name,  ExtremeNord.commune_touchees.length],
      [Littoral.name,  Littoral.commune_touchees.length],
      [Nord.name,  Nord.commune_touchees.length],
      [NordOuest.name,  NordOuest.commune_touchees.length],
      [Ouest.name,  Ouest.commune_touchees.length],
      [Sud.name, Sud.commune_touchees.length],
      [SudOuest.name, SudOuest.commune_touchees.length]
    ]);

    var options = {
      title: 'POURCENTAGE DE MAIRES TOUCHES PAR REGIONS',
      is3D: true,
    };

    var chart_div = document.getElementById('piechart_1');
    var chart = new google.visualization.PieChart(chart_div);
    // Wait for the chart to finish drawing before calling the getImageURI() method.
      google.visualization.events.addListener(chart, 'ready', function () {
        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';

        formData.append('image', chart.getImageURI());
        req.open("POST", 'admin/settings');
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            req.setRequestHeader('X-CSRF-TOKEN', token.content);
            if (typeof _auth !== 'undefined')
                req.setRequestHeader('Authorization', 'Bearer ' + _auth);
        } else {
            console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
        }
        req.send(formData);
      });

    chart.draw(data, options);
  }


  </script>
@endsection

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
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="container-fluid">
        <div class="cards row mt-20">
            <div class="col-sm-12 mb-10">
                <h4 class="bold">Taux de couverture</h4>
            </div>
            <div class="col-sm-3">
                <div class="card green">
                    <h3>{{ $data['totalPersonnesIncrites'] }}</h3>
                    <h5>Nombre d'inscription</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card red">
                    <h3>{{ $data['totalPersonnesFormees'] }}</h3>
                    <h5>Nombre Stagiaire formés</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card warning">
                    <h3>{{ $data['communesToucher'] . ' %' }}</h3>
                    <h5>Communes touchées</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card dark">
                    <h3>{{ $data['formationExecuter'] . ' %' }}</h3>
                    <h5>Formations exécutées</h5>
                </div>
            </div>
        </div>

        <div class="cards row mt-20">
            <div class="col-sm-12">
              <h4 class="mt-20 mb-20 text-center">STATISTIQUE DE L'ACTION PEDAGOGIQUE EN {{ $session->name }}</h4>
            </div>
            <div class="col-sm-12 bg-white mt-20">
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
                    {{-- LIster les regions --}}
                      <input type="hidden" id="Adamaoua" value="{{ $data['Adamaoua'] }}">
                      <input type="hidden" id="Sud" value="{{ $data['Sud'] }}">
                      <input type="hidden" id="Est" value="{{ $data['Est'] }}">
                      <input type="hidden" id="Ouest" value="{{ $data['Ouest'] }}">
                      <input type="hidden" id="Nord" value="{{ $data['Nord'] }}">
                      <input type="hidden" id="Littoral" value="{{ $data['Littoral'] }}">
                      <input type="hidden" id="NordOuest" value="{{ $data['NordOuest'] }}">
                      <input type="hidden" id="SudOuest" value="{{ $data['SudOuest'] }}">
                      <input type="hidden" id="ExtremeNord" value="{{ $data['ExtremeNord'] }}">
                      <input type="hidden" id="Centre" value="{{ $data['Centre'] }}">

                      {{-- compter le nombre de SG dans chaque region --}}
                      <input type="hidden" id="NombreSGAdamaoua" value="{{ count($data['Adamaoua']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGSud" value="{{ count($data['Sud']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGEst" value="{{ count($data['Est']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGOuest" value="{{ count($data['Ouest']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGNord" value="{{ count($data['Nord']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGLittoral" value="{{ count($data['Littoral']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGNordOuest" value="{{ count($data['NordOuest']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGSudOuest" value="{{ count($data['SudOuest']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGExtremeNord" value="{{ count($data['ExtremeNord']->personnes_sg) }}">
                      <input type="hidden" id="NombreSGCentre" value="{{ count($data['Centre']->personnes_sg) }}">
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

        <div class="cards row mt-20">
          @if (count($data['evaluations']) > 0)
            <div class="col-sm-12">
              <h4 class="mt-20 mb-20 text-center">RECAPUTILATIF DES EVALUATIONS PAR FORMQTION ET COMMUNE</h4>
            </div>
            <div class="col-sm-12" style="max-height: 300px; overflow: auto;">
                <table class="table table-striped bg-white">
                    <thead>
                      <tr>
                        <th>Formation</th>
                        <th>Commune</th>
                        <th>Nombre d'évaluations</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data['evaluations'] as $item)
                        <tr>
                            <td class="bold td-5">{{ $item->com_form->formation->title }}</td>
                            <td class="td-5">{{ $item->com_form->commune->name }}</td>
                            <td class="td-5">{{ $item->total }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
          @endif

          @if (count($data['regions']) > 0)
            <div class="col-sm-12">
              <h4 class="mt-20 mb-20 text-center">TABLEAU GLOBAL DES CTD TOUCHEES</h4>
            </div>
              <div class="col-sm-12" style="max-height: 300px; overflow: auto;">
                <table class="table table-striped bg-white">
                    <thead>
                      <tr>
                        <th>Régions</th>
                        <th>Nombres de CTD touchées</th>
                        <th>Nombre de CTD pas encore touchées</th>
                        <th>Taux de couverture (en %)</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data['regions'] as $region)
                        <tr>
                            <td class="bold td-5">{{ $region->name }}</td>
                            <td class="td-5">{{ count($region->commune_touchees) }}</td>
                            <td class="td-5">{{ $region->nontouchees }}</td>
                            <td class="td-5">{{ number_format($region->couverture, 2) }} %</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
          @endif

            <div class="col-sm-12">
              <h4 class="mt-20 mb-20 text-center">SYNTHESES DES CTD ATTEINTES EN {{ $data['session']->name }}</h4>
            </div>
            <div class="col-sm-12" style="max-height: 300px; overflow: auto;">
              <table class="table table-striped bg-white">
                  <tbody>
                      <tr>
                          <td class="bold td-5">Synthèses des CTD atteintes en {{ $data['session']->name }}</td>
                          <td class="td-5">{{ $data['stat_touchees'] . ' %' }}</td>
                      </tr>
                      <tr>
                          <td class="bold td-5">CTD nouvellement atteintes en {{ $data['session']->name }}</td>
                          <td class="td-5">{{ $data['stat_new'] . ' %' }}</td>
                      </tr>
                      <tr>
                          <td class="bold td-5">CTD touchés plus d'une fois en {{ $data['session']->name }}</td>
                          <td class="td-5">{{ $data['stat_plus'] . ' %' }}</td>
                      </tr>
                      <tr>
                          <td class="bold td-5">CTD touchés depuis 2015</td>
                          <td class="td-5">{{ $data['stat_2015'] . ' %' }}</td>
                      </tr>
                      <tr>
                          <td class="bold td-5">CTD restants à atteindre en {{ $data['session']->name }}</td>
                          <td class="td-5">{{ $data['stat_restantes'] . ' %' }}</td>
                      </tr>
                  </tbody>
              </table>
            </div>

            @if (count($data['allFormations']) > 0)
              <div class="col-sm-12">
                <h4 class="mt-20 mb-20 text-center">TABLEAU GLOBAL DES FORMATIONS</h4>
              </div>
              <div class="col-sm-12" style="max-height: 300px; overflow: auto;">
                <table class="table table-striped bg-white">
                    <thead>
                      <tr>
                        <th>Titre de la formation</th>
                        <th>Nombre de stagiaires prévus</th>
                        <th>Nombre de stagiaires effectif</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data['allFormations'] as $item)
                        <tr>
                            <td class="bold td-5">{{ $item->title }}</td>
                            <td class="td-5">{{ $item->nb_prevus }}</td>
                            <td class="td-5">{{ $item->nb_effectif }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            @endif

            @if (count($data['regions']) > 0)
              <div class="col-sm-12">
                <h4 class="mt-20 mb-20 text-center">POURCENTAGE DES SG TOUCHES PAR REGION</h4>
              </div>
              <div class="col-sm-12" style="max-height: 300px; overflow: auto;">
                <table class="table table-striped bg-white">
                    <thead>
                      <tr>
                        <th>Regions</th>
                        <th>Pourcentages</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data['regions'] as $item)
                        <tr>
                            <td class="bold td-5">{{ $item->name }}</td>
                            @if ($data['totalPersonnesSG']>0)
                              <td class="td-5">{{ number_format((count($item->personnes_sg)/$data['totalPersonnesSG'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            @endif

            @if (count($data['personnes_diplome']) > 0)
              <div class="col-sm-12">
                <h4 class="mt-20 mb-20 text-center">TABLEAU DES PERSONNES PAR DIPLOME</h4>
              </div>
              <div class="col-sm-12" style="max-height: 300px; overflow: auto;">
                <table class="table table-striped bg-white">
                    <thead>
                      <tr>
                        <th>Diplomes</th>
                        <th>Effectifs</th>
                        <th>Pourcentages</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data['personnes_diplome'] as $item)
                        <tr>
                            <td class="bold td-5">{{ $item->diplome_elev ? $item->diplome_elev : 'Uncategorized'}}</td>
                            <td class="td-5">{{ $item->total }}</td>
                            <td class="td-5">{{ $item->pourcentage . '%' }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            @endif

            @if (count($data['personnes_age']) > 0)
              <div class="col-sm-12">
                <h4 class="mt-20 mb-20 text-center">TABLEAU DES PERSONNES PAR AGE</h4>
              </div>
              <div class="col-sm-12" style="max-height: 300px; overflow: auto;">
                <table class="table table-striped bg-white">
                    <thead>
                      <tr>
                        <th>Ages</th>
                        <th>Effectifs</th>
                        <th>Pourcentages</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($data['personnes_age']['pers_20_30'])>0)
                        <tr>
                            <td class="bold td-5">De 20 à 30 ans</td>
                            <td class="td-5">{{ count($data['personnes_age']['pers_20_30']) }}</td>
                            @if ($data['personnes_age']['personnes'] > 0)
                              <td class="td-5">{{ number_format((count($data['personnes_age']['pers_20_30'])/$data['personnes_age']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif
                        </tr>
                      @endif

                      @if (count($data['personnes_age']['pers_31_40'])>0)
                        <tr>
                            <td class="bold td-5">De 31 à 40 ans</td>
                            <td class="td-5">{{ count($data['personnes_age']['pers_31_40']) }}</td>
                            @if ($data['personnes_age']['personnes'] > 0)
                              <td class="td-5">{{ number_format((count($data['personnes_age']['pers_31_40'])/$data['personnes_age']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif
                        </tr>
                      @endif

                      @if (count($data['personnes_age']['pers_41_50'])>0)
                        <tr>
                            <td class="bold td-5">De 41 à 50 ans</td>
                            <td class="td-5">{{ count($data['personnes_age']['pers_41_50']) }}</td>
                            @if ($data['personnes_age']['personnes'] > 0)
                              <td class="td-5">{{ number_format((count($data['personnes_age']['pers_41_50'])/$data['personnes_age']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif
                        </tr>
                      @endif

                      @if (count($data['personnes_age']['pers_51_60'])>0)
                        <tr>
                            <td class="bold td-5">De 51 à 60 ans</td>
                            <td class="td-5">{{ count($data['personnes_age']['pers_51_60']) }}</td>
                            @if ($data['personnes_age']['personnes'] > 0)
                              <td class="td-5">{{ number_format((count($data['personnes_age']['pers_51_60'])/$data['personnes_age']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif
                        </tr>
                      @endif

                    </tbody>
                </table>
              </div>
            @endif

            @if (count($data['personnes_agesex']) > 0)
              <div class="col-sm-12">
                <h4 class="mt-20 mb-20 text-center">TABLEAU DES PERSONNES PAR AGE ET PAR SEXE</h4>
              </div>
              <div class="col-sm-12" style="max-height: 300px; overflow: auto;">
                <table class="table table-striped bg-white">
                    <thead>
                      <tr>
                        <th>Ages</th>
                        <th>Effectifs</th>
                        <th>Pourcentages</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if ((count($data['personnes_agesex']['pers_20_30_male'])>0) || (count($data['personnes_agesex']['pers_20_30_female'])>0))
                        <tr>
                            <td class="bold td-5" rowspan="2">De 20 à 30 ans</td>
                            <td class="td-5">{{ count($data['personnes_agesex']['pers_20_30_male']) .' Masculin' }}</td>
                            @if ($data['personnes_agesex']['personnes']>0)
                              <td class="td-5">{{ number_format((count($data['personnes_agesex']['pers_20_30_male'])/$data['personnes_agesex']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif

                        </tr>
                        <tr>
                            <td class="td-5">{{ count($data['personnes_agesex']['pers_20_30_female']) .' Féminin' }}</td>
                            @if ($data['personnes_agesex']['personnes']>0)
                              <td class="td-5">{{ number_format((count($data['personnes_agesex']['pers_20_30_female'])/$data['personnes_agesex']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif

                        </tr>
                      @endif

                      @if ((count($data['personnes_agesex']['pers_31_40_male'])>0) || (count($data['personnes_agesex']['pers_31_40_female'])>0))
                        <tr>
                            <td class="bold td-5" rowspan="2">De 31 à 40 ans</td>
                            <td class="td-5">{{ count($data['personnes_agesex']['pers_31_40_male']) .' Masculin' }}</td>
                            @if ($data['personnes_agesex']['personnes']>0)
                              <td class="td-5">{{ number_format((count($data['personnes_agesex']['pers_31_40_male'])/$data['personnes_agesex']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif

                        </tr>
                        <tr>
                            <td class="td-5">{{ count($data['personnes_agesex']['pers_31_40_female']) .' Féminin' }}</td>
                            @if ($data['personnes_agesex']['personnes']>0)
                              <td class="td-5">{{ number_format((count($data['personnes_agesex']['pers_31_40_female'])/$data['personnes_agesex']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif

                        </tr>
                      @endif

                      @if ((count($data['personnes_agesex']['pers_41_50_male'])>0) || (count($data['personnes_agesex']['pers_41_50_female'])>0))
                        <tr>
                            <td class="bold td-5" rowspan="2">De 41 à 50 ans</td>
                            <td class="td-5">{{ count($data['personnes_agesex']['pers_41_50_male']) .' Masculin' }}</td>
                            @if ($data['personnes_agesex']['personnes']>0)
                              <td class="td-5">{{ number_format((count($data['personnes_agesex']['pers_41_50_male'])/$data['personnes_agesex']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif

                        </tr>
                        <tr>
                            <td class="td-5">{{ count($data['personnes_agesex']['pers_41_50_female']) .' Féminin' }}</td>
                            @if ($data['personnes_agesex']['personnes']>0)
                              <td class="td-5">{{ number_format((count($data['personnes_agesex']['pers_41_50_female'])/$data['personnes_agesex']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif

                        </tr>
                      @endif

                      @if ((count($data['personnes_agesex']['pers_51_60_male'])>0) || (count($data['personnes_agesex']['pers_51_60_female'])>0))
                        <tr>
                            <td class="bold td-5" rowspan="2">De 51 à 60 ans</td>
                            <td class="td-5">{{ count($data['personnes_agesex']['pers_51_60_male']) .' Masculin' }}</td>
                            @if ($data['personnes_agesex']['personnes']>0)
                              <td class="td-5">{{ number_format((count($data['personnes_agesex']['pers_51_60_male'])/$data['personnes_agesex']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif

                        </tr>
                        <tr>
                            <td class="td-5">{{ count($data['personnes_agesex']['pers_51_60_female']) .' Féminin' }}</td>
                            @if ($data['personnes_agesex']['personnes']>0)
                              <td class="td-5">{{ number_format((count($data['personnes_agesex']['pers_51_60_female'])/$data['personnes_agesex']['personnes'])*100,2) . '%' }}</td>
                            @else
                              <td class="td-5">{{ 0.00 . '%' }}</td>
                            @endif
                        </tr>
                      @endif
                    </tbody>
                </table>
              </div>
            @endif

        </div>

        <div class="row mt-40 mb-20">
            <h4>Représentation Géographique</h4>
            <div class="mt-20" id="map" style="width: 100%; height: 600px;"></div>
        </div>

        <div class="row mt-40 mb-20">
            <h4>Représentation Graphique</h4>
            <div class="col-sm-6">
                <div id="piechart_1" class="mt-20" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
  <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript">
    var InputCentre = document.getElementById('Centre').value
    var InputNord = document.getElementById('Nord').value
    var InputNordOuest = document.getElementById('NordOuest').value
    var InputAdamaoua = document.getElementById('Adamaoua').value
    var InputEst = document.getElementById('Est').value
    var InputOuest = document.getElementById('Ouest').value
    var InputLittoral = document.getElementById('Littoral').value
    var InputSud = document.getElementById('Sud').value
    var InputExtremeNord = document.getElementById('ExtremeNord').value
    var InputSudOuest = document.getElementById('SudOuest').value

    var Centre = JSON.parse(InputCentre);
    var Nord = JSON.parse(InputNord);
    var NordOuest = JSON.parse(InputNordOuest);
    var Adamaoua = JSON.parse(InputAdamaoua);
    var Est = JSON.parse(InputEst);
    var Ouest = JSON.parse(InputOuest);
    var Littoral = JSON.parse(InputLittoral);
    var Sud = JSON.parse(InputSud);
    var ExtremeNord = JSON.parse(InputExtremeNord);
    var SudOuest = JSON.parse(InputSudOuest);

    // recuperation du nombre de sg par region
    var InputNombreSGCentre = document.getElementById('NombreSGCentre').value
    var InputNombreSGNord = document.getElementById('NombreSGNord').value
    var InputNombreSGNordOuest = document.getElementById('NombreSGNordOuest').value
    var InputNombreSGAdamaoua = document.getElementById('NombreSGAdamaoua').value
    var InputNombreSGEst = document.getElementById('NombreSGEst').value
    var InputNombreSGOuest = document.getElementById('NombreSGOuest').value
    var InputNombreSGLittoral = document.getElementById('NombreSGLittoral').value
    var InputNombreSGSud = document.getElementById('NombreSGSud').value
    var InputNombreSGExtremeNord = document.getElementById('NombreSGExtremeNord').value
    var InputNombreSGSudOuest = document.getElementById('NombreSGSudOuest').value

    var locations = [
      // [name, lat, lon, id, commune_touchees, personnes_inscrite, personnes_formee],
      [Adamaoua.name, Adamaoua.lat, Adamaoua.lon, 1, Adamaoua.commune_touchees.length, Adamaoua.personnes_inscrite.length, Adamaoua.personnes_formee.length],
      [Centre.name, Centre.lat, Centre.lon, 2, Centre.commune_touchees.length, Centre.personnes_inscrite.length, Centre.personnes_formee.length],
      [Est.name, Est.lat, Est.lon, 3, Est.commune_touchees.length, Est.personnes_inscrite.length, Est.personnes_formee.length],
      [ExtremeNord.name, ExtremeNord.lat, ExtremeNord.lon, 4, ExtremeNord.commune_touchees.length, ExtremeNord.personnes_inscrite.length, ExtremeNord.personnes_formee.length],
      [Littoral.name, Littoral.lat, Littoral.lon, 5, Littoral.commune_touchees.length, Littoral.personnes_inscrite.length, Littoral.personnes_formee.length],
      [Nord.name, Nord.lat, Nord.lon, 6, Nord.commune_touchees.length, Nord.personnes_inscrite.length, Nord.personnes_formee.length],
      [NordOuest.name, NordOuest.lat, NordOuest.lon, 7, NordOuest.commune_touchees.length, NordOuest.personnes_inscrite.length, NordOuest.personnes_formee.length],
      [Ouest.name, Ouest.lat, Ouest.lon, 8, Ouest.commune_touchees.length, Ouest.personnes_inscrite.length, Ouest.personnes_formee.length],
      [Sud.name, Sud.lat, Sud.lon, 9, Sud.commune_touchees.length, Sud.personnes_inscrite.length, Sud.personnes_formee.length],
      [SudOuest.name, SudOuest.lat, SudOuest.lon, 10, SudOuest.commune_touchees.length, SudOuest.personnes_inscrite.length, SudOuest.personnes_formee.length],
    ];


    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      center: new google.maps.LatLng(3.868987, 11.521334),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent('<div class="card">' +
            '<div class="card-body">' +
              '<h5 class="card-title">' + locations[i][0] + '</h5>' +
              '<ul class="unstyled">' +
              '<li> Communes Touchées ' + locations[i][4] + '</li>' +
              '<li> Personnes Inscrites ' + locations[i][5] + '</li>' +
              '<li> Personnes Formées ' + locations[i][6] + '</li>' +
              '</ul>' +
            '</div>' +
          '</div>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
@endsection
