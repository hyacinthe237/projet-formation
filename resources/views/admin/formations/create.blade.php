@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formation.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Nouvelle Formation
        </div>
    </div>

    {!! Form::model(['method' => 'POST', 'route' => ['formation'], 'class' => '_form' ]) !!}

        <section class="container-fluid mt-20">

            @include('errors.list')

            {{ csrf_field() }}

            <div class="block">
                <div class="block-content form">

                    <div class="row mt-20">
                          <div class="col-sm-9">
                              <div class="row">
                                  <div class="col-sm-9">
                                      <div class="form-group">
                                          <label>Titre</label>
                                          <input type="text" name="title" class="form-control input-lg" placeholder="Titre" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-3">
                                      <div class="form-group">
                                          <label>Site</label>
                                          <input type="text" name="site" class="form-control input-lg" placeholder="Site" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Date de début</label>
                                          <input type="date" name="start_date" class="form-control input-lg datepicker" placeholder="Date de début" required>
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
                                                      <option value="{{ $value }}" {{ $value == '08' ? 'selected' : ''}}>{{ $value }}</option>
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
                                                      <option value="{{ $value }}">
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
                                          <input type="date" name="end_date" class="form-control input-lg datepicker" placeholder="Date de fin">
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
                                                      <option value="{{ $value }}" {{ $value == '19' ? 'selected' : ''}}>
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
                                                      <option value="{{ $value }}">
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
                                  <label>Nombre de stagiaire</label>
                                  <input type="number" name="qte_requis" class="form-control input-lg" placeholder="Nombre de stagiaire">
                              </div>

                              <div class="form-group">
                                  <label>Type</label>
                                  <div class="form-select grey">
                                      <select name="type" class="form-control input-lg">
                                          <option value="Besoin">Besoins</option>
                                          <option value="Effective">Effective</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label>Status</label>
                                  <div class="form-select grey">
                                      <select name="is_active" class="form-control input-lg">
                                          <option value="0">Inactivée</option>
                                          <option value="1">Activée</option>
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

@endsection

@section('js')
<script>
$(document).ready(function() {
    $('.datepicker').datepicker({
        startdate: 'd',
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHightlight: true,
    })
})
</script>
@endsection
