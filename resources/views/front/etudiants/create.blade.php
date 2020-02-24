@extends('front.templates.default')

@section('head')
    <title>Inscription Stagiaire</title>
@endsection()

@section('body')
{!! Form::open(['method' => 'POST', 'route' => ['front.stagiaires.store'], 'class' => '_form bg-white' ]) !!}

    <section class="container">

        <div class="mt-20 mb-20">
          @include('errors.list')
        </div>

        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                <div class="row mt-20">
                  <div class="row">
                      <input type="hidden" name="phase_id" value="{{ $phase->id }}">
                      <input type="hidden" name="etat_id" value="{{ $etat->id }}">
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
                              <input type="text" name="phone" class="form-control input-lg" placeholder="Téléphone" required>
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
                              <label>Année d'expérience</label>
                              <input type="text" name="an_exp" class="form-control input-lg" placeholder="Année d'expérience">
                          </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Formation</label>
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="commune_formation_id" required>
                                    <option value="">Sélectionnez une formation</option>
                                    @foreach($formations as $item)
                                        <option value="{{ $item->id }}">
                                          {{ $item->formation->title }} de {{ $item->commune->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Structure</label>
                          <div class="form-select grey">
                              <select class="form-control input-lg" name="structure_id" required>
                                  <option value="">Sélectionnez la structure</option>
                                @foreach($communes as $commune)
                                    <option value="{{ $commune->id }}">
                                      {{ 'Commune de ' .$commune->name }}
                                    </option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Catégorie</label>
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="student_category_id" required>
                                    <option value="">Sélectionnez une Catégorie</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}">
                                          {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fonction</label>
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="fonction_id" required>
                                    <option value="">Sélectionnez une fonction</option>
                                    @foreach($fonctions as $item)
                                        <option value="{{ $item->id }}">
                                          {{ $item->name }}
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
                              <textarea name="desc_fonction" rows="3" cols="80" class="form-control input-lg" placeholder="Description fonction"></textarea>
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Formation souhaitée</label>
                              <textarea name="form_souhaitee" rows="3" cols="80" class="form-control input-lg" placeholder="Formation souhaitée"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Formation complémentire</label>
                              <textarea name="form_compl" rows="3" cols="80" class="form-control input-lg" placeholder="Formation complémentire"></textarea>
                          </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Diplôme élevée</label>
                              <textarea name="diplome_elev" rows="3" cols="80" class="form-control input-lg" placeholder="Diplôme élevée"></textarea>
                          </div>
                      </div>
                  </div>
                <div class="row">
                      {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label>Upload photo</h4>

                            <input type="file" name="photo" class="form-control input-lg">
                        </div>
                      </div> --}}

                      <div class="col-sm-6">
                            <div class="form-group">
                                <label>Votre signature</label>
                                <canvas id="etudiantSignature" class="form-control signature-pad"></canvas>
                                <input type="hidden" name="signature_url" id="etudiantData" value="">
                                <button class="btn btn-danger pull-right" id="etudiantClear">Effacer</button>
                            </div>
                      </div>
                  </div>

                  <div class="row mt-60">
                      <div class="col-sm-4"></div>
                      <div class="col-sm-4">
                          <div class="form-group">
                              <button type="submit" class="btn btn-lg btn-block btn-success bold">
                                  Je valide mon inscription
                              </button>
                          </div>
                      </div>
                      <div class="col-sm-4"></div>
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
