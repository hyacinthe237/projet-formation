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

            <div class="col-sm-1 mt-20">
              <div class="form-select grey">
                  <select name="jour" class="form-control input-lg">
                      <option value="">Jour</option>
                      @for($i=1; $i<= 31; $i++)
                        <?php $value = $i < 10 ? '0' . $i :$i ;?>
                        <option value="{{ $value }}"}}>
                          {{ $value }}</option>
                      @endfor
                  </select>
              </div>
            </div>

            <div class="col-sm-2 mt-20">
              <div class="form-select grey">
                  <select name="mois" class="form-control input-lg">
                      <option value="">selectionner un mois</option>
                      <option value="01">Janvier</option><option value="02">Févrirer</option><option value="03">Mars</option>
                      <option value="04">Avril</option><option value="05">Mai</option><option value="06">Juin</option>
                      <option value="07">Juillet</option><option value="08">Août</option><option value="09">Septembre</option>
                      <option value="10">Octobre</option><option value="11">Novembre</option><option value="12">Décembre</option>
                  </select>
              </div>
            </div>

            <div class="col-sm-2 mt-20">
                <div class="form-group">
                    <input type="text" name="annee" class="form-control input-lg" placeholder="Annee">
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
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($search as $item)
                          <tr data-href="">
                              <td class="bold">{{ $item->title }}</td>
                              <td class="text-center">{{ $item->is_active ? 'Active' : 'Non active' }}</td>
                              <td class="text-center">{{ $item->qte_requis }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          @endif
        </div>

        <div class="mt-60">
            <canvas id="canvas"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    $('.year').datepicker({
        format: 'yyyy',
        autoclose: true,
        todayHightlight: true,
    })

    $('.month').datepicker({
        format: 'mm',
        autoclose: true,
        todayHightlight: true,
    })

    $('.day').datepicker({
        format: 'dd',
        autoclose: true,
        todayHightlight: true,
    })
})

$(document).ready(function () {
    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

    var config = {
			type: 'line',
			data: {
				labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
				datasets: [{
					label: 'Tous',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [
						38,
						43,
						36,
						47,
						39,
						44,
						38,
            41,
						43,
						36,
						47,
						39,
					],
					fill: true,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Visits (Sample data)'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
})
</script>
@endsection
