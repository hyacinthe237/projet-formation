@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formateurs.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit Formateur
        </div>
    </div>
<section class="container-fluid mt-20">
    {!! Form::model($formateur, [
        'method' => 'PUT',
        'route' => ['formateurs.update', $formateur->id],
        'enctype' => 'multipart/form-data',
        'class' => '_form'
        ]) !!}

            @include('errors.list')
            {{ csrf_field() }}

            <div class="block">
                <div class="block-content form">
                      <div class="row mt-20">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Prénom(s)</label>
                                <input type="text" name="firstname" class="form-control input-lg" value="{{ $formateur->firstname }}" required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Nom(s)</label>
                                <input type="text" name="lastname" class="form-control input-lg" value="{{ $formateur->lastname }}" required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Qualification</label>
                                <input type="text" name="qualification" class="form-control input-lg" value="{{ $formateur->qualification }}" required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Type</label>
                                <div class="form-select grey">
                                    <select name="type" class="form-control input-lg" required>
                                        <option value="Expert" {{ $formateur->type == 'Expert' ? 'selected' : '' }}>Expert</option>
                                        <option value="Personnels PNMFV" {{ $formateur->type == 'Personnels PNMFV' ? 'selected' : '' }}>Personnels PNMFV</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="cv">Téléchargez votre CV</label>
                                <input type="file" name="cv" class="form-control input-lg" id="chooseFile">
                            </div>
                            {{-- {{ dd(public_path(). '' .$formateur->cv) }} --}}
                            @if ($formateur->cv !== null)
                                <iframe src="{{ $formateur->cv }}" border="0" type="application/pdf" width="100%" height="500px"></iframe>
                            @endif

                        </div>

                        <div class="col-sm-12">
                            <div class="form-group text-right mt-20">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    <i class="ion-checkmark"></i> Enregistrer
                                </button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
    {!! Form::close() !!}

@if (sizeOf($formateur->formations))
  <h3 class="_block-title mb-20">Formations</h3>
  <div class="block">
      <div class="block-content form">
        <div class="mt-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Etat</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($formateur->formations as $item)
                        <tr data-href="{{ route('formateur.edit.formation', $item->id) }}">
                            <td class="bold">{{ $item->formation->title }}</td>
                            <td>{{ $item->formation->is_active ? 'Active' : 'Non active' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-20">
          <form class="_form" action="{{ route('formateur.store.formation', $formateur->id) }}" method="post">
            {{ csrf_field() }}

            <div class="block">
                <div class="block-content form">

                    <div class="row mt-20">
                        <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Choisissez une formation</label>
                                  <div class="form-select grey">
                                      <select name="formation_id" class="form-control input-lg">
                                        @foreach($formations as $item)
                                            <option value="{{ $item->id }}">
                                              {{ $item->title }}
                                            </option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>

                              <div class="form-group text-right mb-20">
                                  <button type="submit" class="btn btn-lg btn-primary">
                                      <i class="ion-checkmark"></i> Ajouter cette formation
                                  </button>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
@endif

@if (sizeOf($formateur->thematiques))
  <h3 class="_block-title mb-20">Thematiques</h3>
  <div class="block">
      <div class="block-content form">
        <div class="mt-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Durée</th>
                        <th>Début</th>
                        <th>Fin</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($formateur->thematiques as $item)
                        <tr data-href="{{ route('formateur.edit.thematique', $item->id) }}">
                            <td class="bold">{{ $item->thematique->name }}</td>
                            <td>{{ $item->thematique->duree }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($item->start_date)) }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($item->end_date)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-20">
          <form class="_form" action="{{ route('formateur.store.thematique', $formateur->id) }}" method="post">
            {{ csrf_field() }}

            <div class="block">
                <div class="block-content form">

                    <div class="row mt-20">
                          <div class="col-sm-9">
                              <div class="row">
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
                                  <label>thematiques</label>
                                  <div class="form-select grey">
                                      <select name="thematique_id" class="form-control input-lg">
                                        @foreach($thematiques as $item)
                                            <option value="{{ $item->id }}">
                                              {{ $item->name }}
                                            </option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>

                              <div class="form-group text-right mb-20 mt-40">
                                  <button type="submit" class="btn btn-lg btn-primary">
                                      <i class="ion-checkmark"></i> Ajouter la thematique
                                  </button>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
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
    'route'    => 'formateurs.destroy',
    'method'   => 'delete',
    'resource' => $formateur,
    'confirm'  => 'Oui, je supprime',
    'message'  => 'Voulez-vous de façon permanente supprimer ce formateur ?'
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
