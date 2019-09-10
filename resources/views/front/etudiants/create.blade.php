@extends('front.templates.default')

@section('head')
    <title>Formulaire d'inscription</title>
@endsection()

@section('body')
{!! Form::open(['method' => 'POST', 'route' => ['inscriptions.store'], 'class' => '_form bg-white' ]) !!}

    <section class="container mt-60">

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <h2 class="_block-title mt-20">Formulaire d'inscription</h2>
            <div class="block-content form">

                <div class="row mt-20">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Prénom(s)</label>
                              <input type="text" name="firstname" class="form-control input-lg" placeholder="prénom(s)" required>
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Nom(s)</label>
                              <input type="text" name="lastname" class="form-control input-lg" placeholder="nom(s)">
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control input-lg" placeholder="Email" required>
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Téléphone</label>
                              <input type="text" name="phone" class="form-control input-lg" placeholder="Téléphone">
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Date de naissance</label>
                              <input type="date" name="dob" class="form-control input-lg datepicker" placeholder="Date de naissance">
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Structure</label>
                              <input type="text" name="structure" class="form-control input-lg" placeholder="Structure">
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Fonction</label>
                              <input type="text" name="fonction" class="form-control input-lg" placeholder="Fonction">
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Année d'expérience</label>
                              <input type="text" name="an_exp" class="form-control input-lg" placeholder="Année d'expérience">
                          </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Formation</label>
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="formation_id">
                                    @foreach($formations as $formation)
                                        <option value="{{ $formation->id }}">{{ $formation->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Résidence</label>
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="location_id">
                                  @foreach($locations as $location)
                                      <option value="{{ $location->id }}">
                                          {{ 'Région: ' . $location->region }}|
                                          {{ 'Département: ' . $location->departement }}|
                                          {{ 'Commune: ' .$location->commune }}
                                      </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Description fonction</label>
                              <textarea name="desc_fonction" rows="4" cols="80" class="form-control input-lg" placeholder="Description fonction"></textarea>
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Formation souhaitée</label>
                              <textarea name="form_souhaitee" rows="4" cols="80" class="form-control input-lg" placeholder="Formation souhaitée"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Formation complémentire</label>
                              <textarea name="form_compl" rows="4" cols="80" class="form-control input-lg" placeholder="Formation complémentire"></textarea>
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Diplôme élevée</label>
                              <textarea name="diplome_elev" rows="4" cols="80" class="form-control input-lg" placeholder="Diplôme élevée"></textarea>
                          </div>
                      </div>
                  </div>
                <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Upload photo</h4>

                            <input type="file" name="photo">
                        </div>
                      </div>

                      <div class="col-sm-6">
                            <div class="form-group">
                                <label>Votre signature</label>
                                <canvas id="etudiantSignature" class="form-control signature-pad"></canvas>
                                <input type="hidden" name="signature_url" id="etudiantData" value="">
                                <button class="btn btn-danger pull-right" id="etudiantClear">Effacer</button>
                            </div>


                            <div class="form-group text-right mt-60">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    <i class="ion-checkmark"></i> Enregistrer
                                </button>
                            </div>
                      </div>
                  </div>


                </div>

            </div>
        </div>
    </section>
{!! Form::close() !!}
@endsection

@section('js')
<script src="{{ asset('/assets/js/scripts.min.js') }}"></script>
@include('front.includes.signature-js')
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
