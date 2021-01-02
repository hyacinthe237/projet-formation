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

        <div class="row mt-40 mb-20">
          Google Maps
            <div class="mt-20" id="map" style="width: 100%; height: 600px;"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
  <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
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
