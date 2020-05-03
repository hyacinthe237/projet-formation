@extends('admin.body')

@section('head')
    <link rel="stylesheet" type="text/css" href="/backend/fancybox/jquery.fancybox.css" media="screen" />
@endsection

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('stagiaires.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Nouveau stagiaire
        </div>
    </div>

{!! Form::open(['method' => 'POST', 'route' => ['stagiaires.store'], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">

                <div class="row mt-10">
                      <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Prénom(s)</label>
                                    <input type="text" value="{{ old('firstname')}}" name="firstname" class="form-control input-lg" placeholder="prénom(s)" required>
                                    <input type="hidden" name="phase_id" value="{{ $phase->id }}">
                                    <input type="hidden" name="etat_id" value="{{ $etat->id }}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nom(s)</label>
                                    <input type="text" value="{{ old('lastname')}}" name="lastname" class="form-control input-lg" placeholder="nom(s)">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" value="{{ old('email')}}" name="email" class="form-control input-lg" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="text" value="{{ old('phone')}}" name="phone" class="form-control input-lg" placeholder="Téléphone">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date de naissance</label>
                                    <input type="date"  value="{{ old('dob')}}" name="dob" class="form-control input-lg date" placeholder="Date de naissance">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Année d'expérience</label>
                                    <input type="text"  value="{{ old('an_exp')}}" name="an_exp" class="form-control input-lg" placeholder="Année d'expérience">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Formation</label>
                                    <div class="form-select grey">
                                        <select class="form-control input-lg" name="commune_formation_id">
                                            @foreach($formations as $item)
                                                <option value="{{ $item->id }}">
                                                  {{ $item->formation->title }} de {{ $item->commune->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Description fonction</label>
                                    <textarea name="desc_fonction"  value="{{ old('desc_fonction')}}" rows="2" cols="80" class="form-control input-lg" placeholder="Description fonction"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Autres Formations souhaitées</label>
                                    <textarea name="form_souhaitee" value="{{ old('form_souhaitee')}}" rows="2" cols="80" class="form-control input-lg" placeholder="Formation souhaitée"></textarea>
                                </div>
                            </div>

                            {{-- <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Formation complémentire</label>
                                    <textarea name="form_compl" value="{{ old('form_compl')}}" rows="2" cols="80" class="form-control input-lg" placeholder="Formation complémentire"></textarea>
                                </div>
                            </div> --}}

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Diplôme élevée</label>
                                    <textarea name="diplome_elev" value="{{ old('diplome_elev')}}" rows="2" cols="80" class="form-control input-lg" placeholder="Diplôme élevée"></textarea>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-sm-4">
                          <div class="form-group">
                              <label>Status</label>
                              <div class="form-select grey">
                                  <select name="is_active" class="form-control input-lg">
                                      <option value="1">Activé</option>
                                      <option value="0">Inactivé</option>
                                  </select>
                              </div>
                          </div>

                          {{-- <div class="form-group">
                              <label>Catégorie</label>
                              <div class="form-select grey">
                                  <select class="form-control input-lg" name="student_category_id">
                                      @foreach($categories as $item)
                                          <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                          </div> --}}

                          <div class="form-group">
                              <label>Fonction</label>
                              <div class="form-select grey">
                                  <select class="form-control input-lg" name="fonction_id">
                                      @foreach($fonctions as $item)
                                          <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label>Structure</label>
                              <div class="form-select grey">
                                  <select class="form-control input-lg" name="structure_id">
                                      <option value="">Sélectionnez la structure</option>
                                    @foreach($communes as $commune)
                                        <option value="{{ $commune->id }}">
                                          {{ 'Commune de ' . $commune->name }}
                                        </option>
                                    @endforeach
                                  </select>
                              </div>
                          </div>

                          {{-- <div class="form-group">
                              <label>Upload photo</h4>

                              <input type="hidden" class="form-control" id="photo" name='photo' readonly value="{{ old('photo') }}">
                              <div id="photo_view" class="mt-20"></div>

                              <div class="text-right mt-10">
                                  <a href="/backend/filemanager/dialog.php?type=1&field_id=photo" class="iframe-btn btn-dark btn round">
                                      <i class='ion-android-attach mr-10'></i> Uploader une photo
                                  </a>
                              </div>
                          </div> --}}

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
    </section>
{!! Form::close() !!}
@endsection

@section('js')
<script type="text/javascript" src="/backend/js/scripts.js"></script>
<script type="text/javascript" src="/backend/fancybox/jquery.fancybox.js"></script>
<script>
$(document).ready(function() {
    $('.iframe-btn').fancybox({
        'width'     : 900,
        'maxHeight' : 600,
        'minHeight'    : 400,
        'type'      : 'iframe',
        'autoSize'      : false
    });

    $('.date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    })

    $("body").hover(function() {
        var profilePic = $("input[name='photo']").val();
        if(profilePic)
            $('#photo_view').html("<img class='thumbnail img-responsive mb-10' src='" + profilePic +"'/>");
    });
})
</script>
@endsection
