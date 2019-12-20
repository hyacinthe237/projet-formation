@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('stagiaires.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter nouveau etudiant
            </a>
            <a href="{{ route('formation.edit', $site->formation->number) }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
          Modification du site <strong>"{{ $site->commune->name }}"</strong>

          <div class="alert alert-info alert-dismissible mt-10" role="alert">
              Formation <strong>"{{ $site->formation->title }}"</strong>
          </div>
        </div>
    </div>
<section class="container-fluid mt-20">

@include('errors.list')
    {!! Form::model($site, ['method' => 'POST', 'route' => ['formation.update.site', $site->id], 'class' => '_form' ]) !!}
      {{ csrf_field() }}

      <div class="block">
          <div class="block-content form">

              <div class="row mt-20">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                  <label>Nombre de stagiaire</label>
                                  <input type="number" name="qte_requis" class="form-control input-lg" value="{{ $site->qte_requis }}">
                              </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" name="formation_id" value="{{ $site->formation_id }}">
                                <div class="form-group">
                                    <label>Date de début</label>
                                    <input type="date" name="start_date" class="form-control input-lg datepicker" value="{{ $site->datesdebut }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Heure</label>
                                          <select class="form-control input-lg" name="start_heure">
                                              @for($i=0; $i< 24; $i++)
                                                <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                                <option value="{{ $value }}" {{ $value == $site->heuresdebut ? 'selected' : ''}}>{{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Minutes</label>
                                          <select class="form-control input-lg" name="start_minutes">
                                              @for($i=0; $i< 60; $i+=5)
                                                <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                                <option value="{{ $value }}" {{ $value == $site->minutesdebut ? 'selected' : ''}}>
                                                  {{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date de fin</label>
                                    <input type="date" name="end_date" class="form-control input-lg datepicker" value="{{ $site->datesfin }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Heure</label>
                                          <select class="form-control input-lg" name="end_heure">
                                              @for($i=0; $i< 24; $i++)
                                                <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                                <option value="{{ $value }}" {{ $value == $site->heuresfin ? 'selected' : ''}}>
                                                  {{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Minutes</label>
                                          <select class="form-control input-lg" name="end_minutes">
                                              @for($i=0; $i< 60; $i+=5)
                                                <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                                <option value="{{ $value }}" {{ $value == $site->minutesfin ? 'selected' : ''}}>
                                                  {{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                  </div>

                  <div class="col-sm-3">
                        <div class="form-group">
                            <label>Site</label>
                            <div class="form-select grey">
                                <select name="commune_id" class="form-control input-lg">
                                  @foreach($communes as $commune)
                                      <option value="{{ $commune->id }}" {{ $commune->id == $site->commune_id ? 'selected' : ''}}>
                                        {{ $commune->name }}
                                      </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Type</label>
                            <div class="form-select grey">
                                <select name="type" class="form-control input-lg">
                                    <option value="Effective">Effective</option>
                                    <option value="Besoin">Besoins</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group text-right mb-20">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="ion-checkmark"></i> Enregistrer
                            </button>
                        </div>
                  </div>
              </div>
          </div>
      </div>
  {!! Form::close() !!}

    @if (sizeOf($site->etudiants))
      <h3 class="_block-title mb-20">Liste des stagiaires</h3>
      <div class="block">
          <div class="block-content form">
            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nom</th>
                            <th>Structure</th>
                            <th>Fonction</th>
                            <th>Etat</th>
                            <th>Crée le</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($site->etudiants as $item)
                            <tr data-href="{{ route('stagiaires.edit', $item->etudiant->number) }}">
                                <td> <img src="{{ $item->etudiant->getImgAttribute() }}" alt="" width="50px" height="50px" class="img-round"> </td>
                                <td class="bold">{{ $item->etudiant->getNameAttribute() }}</td>
                                <td>{{ $item->etudiant->structure }}</td>
                                <td>{{ $item->etudiant->fonction }}</td>
                                <td>{{ $item->etat }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($item->etudiant->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
      </div>
    @endif

    <div class="col-sm-6 block">
        <div class="block-content form">
          <div class="mt-10">
            <h3 class="_block-title mb-20">Inscrire un stagiaire</h3>
            {!! Form::model($site->formation, ['method' => 'POST', 'route' => ['ajouter.etudiant.formation', $site->id], 'class' => '_form' ]) !!}
              <div class="row mt-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                        <label>Sélectionner un stagiare</label>
                        <div class="form-select grey">
                            <select class="form-control input-lg" name="etudiant_id">
                                @foreach($etudiants as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group text-right mb-20">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="ion-checkmark"></i> Ajouter un stagiare
                        </button>
                    </div>
                  </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
    </div>

</section>

@endsection

@section('js')
<script>
$(document).ready(function() {
    $('.datepicker').datepicker({
        startdate: 'd',
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHightlight: true,
    })
})
</script>
@endsection
