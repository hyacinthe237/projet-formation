@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formateurs.create') }}" class="btn btn-lg btn-success">
                <i class="ion-plus"></i> Ajouter un nouveau formateur
            </a>

            <a href="{{ route('formation.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Editer une Formation
            <div class="mt-10">
              @if (!$formation->is_active)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Formation non active, bien vouloir l'activer
                </div>
              @endif
            </div>
        </div>
    </div>
    <section class="container-fluid mt-20">

        {!! Form::model($formation, ['method' => 'PUT', 'route' => ['formation.update', $formation->number], 'class' => '_form' ]) !!}

            @include('errors.list')
            {{ csrf_field() }}

            <div class="block">
            <div class="block-content form">

                <div class="row mt-20">
                      <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" name="title" class="form-control input-lg" value="{{ $formation->title }}" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"
                                    class="form-control input-lg" rows="5" cols="80">{{ $formation->description }}</textarea>
                              </div>
                            </div>

                            <div class="col-sm-12">
                                <label>Sélectionnez un ou plusieurs financeurs</label>
                                <div class="row">
                                    @foreach ($financeurs as $financeur)
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                @if (in_array($financeur->id, $tab))
                                                    <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                                        <input type="checkbox" name="financeurs[]" value="{{ $financeur->id }}" checked>
                                                        <span class="mr-10"></span> {{ $financeur->name }}
                                                    </label>
                                                @else
                                                    <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                                        <input type="checkbox" name="financeurs[]" value="{{ $financeur->id }}">
                                                        <span class="mr-10"></span> {{ $financeur->name }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                          <div class="form-group">
                              <label>Status</label>
                              <div class="form-select grey">
                                  <select name="is_active" class="form-control input-lg">
                                      <option value="0" {{ $formation->is_active == 0 ? 'selected' : '' }}>Inactivée</option>
                                      <option value="1" {{ $formation->is_active == 1 ? 'selected' : '' }}>Activée</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label>Catégories</label>
                              <div class="form-select grey">
                                  <select name="category_id" class="form-control input-lg">
                                      <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}" {{ $formation->category_id == $item->id ? 'selected' : '' }}>
                                          {{ $item->name }}
                                        </option>
                                    @endforeach
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

        @if ($formation->is_active)
          @if (sizeOf($formation->etudiants))
            <h3 class="_block-title mb-20">Liste des stagiaires</h3>
            <div class="block">
                <div class="block-content form">
                  <div class="mt-10">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>Nom</th>
                                  <th>Structure</th>
                                  <th>Catégorie</th>
                                  <th>Fonction</th>
                                  <th>Crée le</th>
                              </tr>
                          </thead>

                          <tbody>
                              @foreach($formation->etudiants as $item)
                                  <tr data-href="{{ route('stagiaires.edit', $item->number) }}">
                                      <td class="bold">{{ $item->firstname . ' ' . $item->lastname }}</td>
                                      <td>{{ $communes->where('id',$item->structure_id)->first()->name }}</td>
                                      <td>{{ $students_categories->where('id',$item->student_category_id)->first()->name }}</td>
                                      <td>{{ $fonctions->where('id', $item->fonction_id)->first()->name }}</td>
                                      <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
          @endif
          @if (sizeOf($formation->sites))
            <h3 class="_block-title mb-20">Sites de la formation</h3>
            <div class="block">
                <div class="block-content form">
                  <div class="mt-10">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>Site</th>
                                  <th>Du</th>
                                  <th>Au</th>
                                  <th>Durée</th>
                                  <th>Type</th>
                                  <th>Nombre Requis</th>
                                  <th>Inscris</th>
                              </tr>
                          </thead>

                          <tbody>
                              @foreach($formation->sites as $item)
                                  <tr data-href="{{ route('formation.edit.site', $item->id)}}">
                                      <td class="bold">{{ $item->commune->name }}</td>
                                      <td>{{ date('d/m/Y H:i', strtotime($item->start_date)) }}</td>
                                      <td>{{ date('d/m/Y H:i', strtotime($item->end_date)) }}</td>
                                      <td>{{ $item->duree }}</td>
                                      <td>{{ $item->type }}</td>
                                      <td>{{ $item->qte_requis }}</td>
                                      <td>{{ count($item->etudiants) }}</td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
          @endif

          {!! Form::model($formation, ['method' => 'POST', 'route' => ['formation.store.site', $formation->number], 'class' => '_form' ]) !!}
            {{ csrf_field() }}
            <div class="block">
                <div class="block-content form">
                    <h3>Ajoutez un site à cette formation</h3>
                    <div class="row mt-20">
                          <div class="col-sm-9">
                              <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nombre de stagiaire requis</label>
                                        <input type="number" name="qte_requis" class="form-control input-lg" required>
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
                                  <label>Site</label>
                                  <div class="form-select grey">
                                      <select name="commune_id" class="form-control input-lg">
                                        @foreach($communes as $commune)
                                            <option value="{{ $commune->id }}">
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
                                          <option value="Demande">Demande</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="form-group text-right mb-20">
                                  <button type="submit" class="btn btn-lg btn-primary">
                                      <i class="ion-checkmark"></i> Ajouter un site
                                  </button>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
          {!! Form::close() !!}

          <div class="row">
              <div class="col-sm-4">
                @if (sizeOf($formation->phases))
                  <h3 class="_block-title mb-20">Phases</h3>
                  <div class="block">
                      <div class="block-content form">
                        <div class="mt-10">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Crée le</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($formation->phases as $phase)
                                        <tr data-href="{{ route('phases.edit', $phase->id) }}">
                                            <td class="bold">{{ $phase->title }}</td>
                                            <td>{{ date('d/m/Y H:i', strtotime($phase->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                      </div>
                  </div>
                @endif
              </div>

              <div class="col-sm-8">
                @if (sizeOf($formation->formateurs))
                  <h3 class="_block-title mb-20">Formateurs</h3>
                    <div class="block">
                        <div class="block-content form">
                          <div class="mt-10">

                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Qualification</th>
                                          <th>Type</th>
                                          <th>Crée le</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($formation->formateurs as $item)
                                          <tr data-href="{{ route('formateurs.edit', $item->formateur->id) }}">
                                              <td class="bold">{{ $item->formateur->getNameAttribute() }}</td>
                                              <td>{{ $item->formateur->qualification }}</td>
                                              <td>{{ $item->formateur->type }}</td>
                                              <td>{{ date('d/m/Y H:i', strtotime($item->formateur->created_at)) }}</td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>

                          </div>
                        </div>
                    </div>
                @endif
              </div>
          </div>
        @endif

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
        'route'    => 'formation.delete',
        'method'   => 'delete',
        'resource' => $formation,
        'confirm'  => 'Oui, je supprime',
        'message'  => 'Voulez-vous de façon permanente supprimer cette formation ?'
    ])
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
