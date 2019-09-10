@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formation.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Editer une Formation
        </div>
    </div>

{!! Form::model($formation, ['method' => 'PUT', 'route' => ['formation.update', $formation->number], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">

                <div class="row mt-20">
                      <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" name="title" class="form-control input-lg" value="{{ $formation->title }}" required>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Site</label>
                                    <input type="text" name="site" class="form-control input-lg" value="{{ $formation->site }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date de dedut</label>
                                    <input type="date" name="start_date" class="form-control input-lg datepicker" value="{{ $formation->datesdebut }}">
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
                                                <option value="{{ $value }}" {{ $value == $formation->heuresdebut ? 'selected' : ''}}>{{ $value }}</option>
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
                                                <option value="{{ $value }}"{{ $value == $formation->minutesdebut ? 'selected' : ''}}>
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
                                    <input type="date" name="end_date" class="form-control input-lg datepicker" value="{{ $formation->datesfin }}">
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
                                                <option value="{{ $value }}" {{ $value == $formation->heuresfin ? 'selected' : ''}}>
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
                                                <option value="{{ $value }}" {{ $value == $formation->minutesfin ? 'selected' : ''}}>
                                                  {{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-4">
                          <div class="form-group">
                              <label>Nombre de stagiaire</label>
                              <input type="number" name="qte_requis" class="form-control input-lg" value="{{ $formation->qte_requis }}">
                          </div>

                          <div class="form-group">
                              <label>Type</label>
                              <div class="form-select grey">
                                  <select name="type" class="form-control input-lg">
                                      <option value="Besoin" {{ $formation->type == 'Besoin' ? 'selected' : '' }}>Besoins</option>
                                      <option value="Effective" {{ $formation->type == 'Effective' ? 'selected' : '' }}>Effective</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label>Status</label>
                              <div class="form-select grey">
                                  <select name="is_active" class="form-control input-lg">
                                      <option value="0" {{ $formation->is_active == 0 ? 'selected' : '' }}>Inactivée</option>
                                      <option value="1" {{ $formation->is_active == 1 ? 'selected' : '' }}>Activée</option>
                                  </select>
                              </div>
                          </div>


                          <hr>
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