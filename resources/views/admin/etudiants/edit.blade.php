@extends('admin.body')

@section('head')
    <link rel="stylesheet" type="text/css" href="/backend/fancybox/jquery.fancybox.css" media="screen" />
@endsection

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('stagiaires.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Modifier le stagiaire <strong>{{ $etudiant->name }}</strong>
        </div>
    </div>
<section class="container-fluid mt-20">
      {!! Form::model($etudiant, ['method' => 'PATCH', 'route' => ['stagiaires.update', $etudiant->number], 'class' => '_form' ]) !!}

              @include('errors.list')
              {{ csrf_field() }}

              <div class="block">
                  <div class="block-content form">

                      <div class="row mt-20">
                            <div class="col-sm-8">
                              <div class="row">
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Prénom(s)</label>
                                          <input type="text" name="firstname" class="form-control input-lg" value="{{ $etudiant->firstname }}" required>
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Nom(s)</label>
                                          <input type="text" name="lastname" class="form-control input-lg" value="{{ $etudiant->lastname }}">
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Email</label>
                                          <input type="email" name="email" class="form-control input-lg" value="{{ $etudiant->email }}" required>
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Téléphone</label>
                                          <input type="text" name="phone" class="form-control input-lg" value="{{ $etudiant->phone }}">
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Date de naissance</label>
                                          <input type="date" name="dob" class="form-control input-lg date" value="{{ $etudiant->dob }}">
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Année d'expérience</label>
                                          <input type="text" name="an_exp" class="form-control input-lg" value="{{ $etudiant->an_exp }}">
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
                                          <textarea name="desc_fonction" rows="2" cols="80" class="form-control input-lg">{{ $etudiant->desc_fonction }}</textarea>
                                      </div>
                                  </div>

                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label>Autres Formations souhaitées</label>
                                          <textarea name="form_souhaitee" rows="2" cols="80" class="form-control input-lg">{{ $etudiant->form_souhaitee }}</textarea>
                                      </div>
                                  </div>

                                  {{-- <div class="col-sm-12">
                                      <div class="form-group">
                                          <label>Formation complémentire</label>
                                          <textarea name="form_compl" rows="2" cols="80" class="form-control input-lg">{{ $etudiant->form_compl }}</textarea>
                                      </div>
                                  </div> --}}

                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label>Diplôme élevée</label>
                                          <textarea name="diplome_elev" rows="2" cols="80" class="form-control input-lg">{{ $etudiant->diplome_elev }}</textarea>
                                      </div>
                                  </div>


                              </div>
                          </div>

                          <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="form-select grey">
                                        <select name="is_active" class="form-control input-lg">
                                            <option value="0" {{ $etudiant->is_active == 0 ? 'selected' : ''}}>Inactivé</option>
                                            <option value="1" {{ $etudiant->is_active == 1 ? 'selected' : ''}}>Activé</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Structure</label>
                                    <div class="form-select grey">
                                        <select class="form-control input-lg" name="structure_id">
                                          @foreach($communes as $commune)
                                              <option value="{{ $commune->id }}" {{ $etudiant->structure_id == $commune->id ? 'selected' : '' }}>
                                                  {{ $commune->departement_id === 59 ? $commune->name : 'Commune de ' . $commune->name }}
                                              </option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Catégorie</label>
                                    <div class="form-select grey">
                                        <select class="form-control input-lg" name="student_category_id">
                                          @foreach($categories as $item)
                                              <option value="{{ $item->id }}" {{ $etudiant->student_category_id == $item->id ? 'selected' : '' }}>
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
                                              <option value="{{ $item->id }}" {{ $etudiant->fonction_id == $item->id ? 'selected' : '' }}>
                                                  {{ $item->name }}
                                              </option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label>Upload photo</h4>

                                    <input type="hidden" class="form-control" id="photo" name="photo" readonly value="{{ $etudiant->photo }}">
                                    <div id="photo_view" class="mt-20"></div>

                                    <div class="text-right mt-10">
                                        <a href="/backend/filemanager/dialog.php?type=1&field_id=photo" class="iframe-btn btn-dark btn round">
                                            <i class='ion-android-attach mr-10'></i> modifier la photo
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
      {!! Form::close() !!}

        @if (sizeOf($etudiant->formations))
          <h3 class="_block-title mb-20">Formations</h3>
          <div class="block">
              <div class="block-content form">
                <div class="mt-10">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Site</th>
                                <th>Phases</th>
                                <th>Etats</th>
                                <th>Durée</th>
                                <th>Début</th>
                                <th>Fin</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($etudiant->formations as $item)
                                <tr data-href="{{ route('edit.etudiant.formation', $item->id) }}">
                                    <td class="bold td-40">{{ $item->site->formation->title }}</td>
                                    <td class="td-10">{{ $item->site->commune->name }}</td>
                                    <td class="td-15">
                                      <ol>
                                        @foreach ($item->phases as $phase)
                                          <li>{{ $phase->title }}</li>
                                        @endforeach
                                      </ol>
                                    </td>
                                    <td class="td-15">
                                      <ol>
                                        @foreach ($item->etats as $etat)
                                          @if ($etat->name == 'formee')
                                            <li>Formé</li>
                                          @else
                                            <li>Incris</li>
                                          @endif
                                        @endforeach
                                      </ol>
                                    </td>
                                    <td class="td-10">{{ $item->site->duree }}</td>
                                    <td class="td-10">{{ date('d/m/Y H:i', strtotime($item->site->start_date)) }}</td>
                                    <td class="td-10">{{ date('d/m/Y H:i', strtotime($item->site->end_date)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
          </div>
        @endif

        <div class="block">
            <div class="block-content form">
              <div class="mt-20">
                <h3 class="_block-title mb-20">Inscrire le stagiaire à une autre formation</h3>
                {!! Form::model($etudiant, ['method' => 'POST', 'route' => ['inscrire.etudiant.formation', $etudiant->number], 'class' => '_form' ]) !!}
                  <div class="row mt-10">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Sélectionner une formation</label>
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

                      <div class="col-sm-3">
                        {!! Form::label('phases', 'Choix des phases') !!}
                        <div class="form-group">
                          @foreach ($phases as $phase)
                            <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                <input type="checkbox" name="phases[]" value="{{ $phase->id }}">
                                <span class="mr-10"></span> {{ $phase->title }}
                            </label>
                          @endforeach
                        </div>
                      </div>

                      <div class="col-sm-3">
                        {!! Form::label('etats', 'Choix des états') !!}
                        @foreach ($etats as $etat)
                            <div class="form-group">
                                <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                    <input type="checkbox" name="etats[]" value="{{ $etat->id }}">
                                    <span class="mr-10"></span> @if ($etat->name == 'formee') Formé @else Incris @endif
                                </label>
                            </div>
                        @endforeach
                      </div>

                      <div class="col-sm-12">
                        <div class="form-group text-right mb-20 mt-20">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="ion-checkmark"></i> Inscrire le stagiaire
                            </button>
                        </div>
                      </div>

                  </div>
                {!! Form::close() !!}


              </div>
            </div>
        </div>
        @if (Auth::user()->role->name === 'admin')
        <div class="row">
            <div class="col-sm-6 mb-40">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
   </section>

   @include('admin.modals.confirm', [
       'route'    => 'stagiaires.destroy',
       'method'   => 'delete',
       'resource' => $etudiant,
       'confirm'  => 'Oui, je supprime',
       'message'  => 'Voulez-vous de façon permanente supprimer '. $etudiant->name .' ?'
   ])
@endsection

@section('js')
  @include('admin.includes.scripts')
@endsection
