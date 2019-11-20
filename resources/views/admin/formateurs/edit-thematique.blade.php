@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formateurs.edit', $formateur_thematique->formateur->id) }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
          Modification de la Thematique <strong>"{{ $formateur_thematique->thematique->name }}"</strong>

          <div class="alert alert-info alert-dismissible mt-10" role="alert">
              Formateur {{ $formateur_thematique->formateur->name }}
          </div>
        </div>
    </div>
<section class="container-fluid mt-20">

@include('errors.list')
    {!! Form::model($formateur_thematique, ['method' => 'POST', 'route' => ['formateur.store.thematique', $formateur_thematique->formateur->id], 'class' => '_form' ]) !!}
      {{ csrf_field() }}

      <div class="block">
          <div class="block-content form">

              <div class="row mt-20">
                    <div class="col-sm-9">
                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label>Date de début</label>
                                  <input type="date" name="start_date" class="form-control input-lg datepicker" value="{{ $formateur_thematique->datesdebut }}" required>
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
                                              <option value="{{ $value }}" {{ $value == $formateur_thematique->heuresdebut ? 'selected' : ''}}>{{ $value }}</option>
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
                                              <option value="{{ $value }}" {{ $value == $formateur_thematique->minutesdebut ? 'selected' : ''}}>
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
                                  <input type="date" name="end_date" class="form-control input-lg datepicker" value="{{ $formateur_thematique->datesfin }}">
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
                                              <option value="{{ $value }}" {{ $value == $formateur_thematique->heuresfin ? 'selected' : ''}}>
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
                                              <option value="{{ $value }}" {{ $value == $formateur_thematique->minutesfin ? 'selected' : ''}}>
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
                            <label>thematiques</label>
                            <div class="form-select grey">
                                <select name="thematique_id" class="form-control input-lg">
                                  @foreach($thematiques as $item)
                                      <option value="{{ $item->id }}" {{ $item->id == $formateur_thematique->thematique_id ? 'selected' : ''}}>
                                        {{ $item->name }}
                                      </option>
                                  @endforeach
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
