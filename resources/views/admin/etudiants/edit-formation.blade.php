@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('stagiaires.edit', $form_etud->etudiant->number) }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
          Modification de la Formation suivi par <strong>{{ $form_etud->etudiant->firstname }} {{ $form_etud->etudiant->lastname }}</strong>

        </div>
    </div>
<section class="container-fluid mt-20">

@include('errors.list')
    {!! Form::model($form_etud, ['method' => 'POST', 'route' => ['update.etudiant.formation', $form_etud->id], 'class' => '_form' ]) !!}
      {{ csrf_field() }}

      <div class="block">
          <div class="block-content form">

              <div class="row mt-20">
                  <div class="col-sm-8">
                        <div class="form-group">
                            <label>Choisissez une formation</label>
                            <div class="form-select grey">
                                <select name="commune_formation_id" class="form-control input-lg">
                                  @foreach($formations as $item)
                                      <option value="{{ $item->id }}" {{ $item->id == $form_etud->commune_formation_id ? 'selected' : ''}}>
                                        {{ $item->formation->title }} de {{ $item->commune->name }}
                                      </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                  </div>
                  <div class="col-sm-4">
                    <label for="phases">Phases</label>
                    <div class="form-group">
                      @foreach ($phases as $phase)
                        @if ($form_etud->phases->contains('id', $phase->id))
                          <label class="css-input css-checkbox css-checkbox-primary mr-20">
                              <input type="checkbox" name="phases[]" value="{{ $phase->id }}" checked>
                              <span class="mr-10"></span> {{ $phase->title }}
                          </label>
                        @else
                            <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                <input type="checkbox" name="phases[]" value="{{ $phase->id }}">
                                <span class="mr-10"></span> {{ $phase->title }}
                            </label>
                        @endif
                      @endforeach
                    </div>

                    <label for="etats">Etats</label>
                    <div class="form-group">
                      @foreach ($etats as $etat)
                        @if ($form_etud->etats->contains('id', $etat->id))
                          <label class="css-input css-checkbox css-checkbox-primary mr-20">
                              <input type="checkbox" name="etats[]" value="{{ $etat->id }}" checked>
                              <span class="mr-10"></span> @if ($etat->name == 'formee') Formé @else Incris @endif
                          </label>
                        @else
                            <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                <input type="checkbox" name="etats[]" value="{{ $etat->id }}">
                                <span class="mr-10"></span> @if ($etat->name == 'formee') Formé @else Incris @endif
                            </label>
                        @endif
                      @endforeach
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group text-right mb-20">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="ion-checkmark"></i> Modifier
                        </button>
                    </div>
                  </div>


              </div>
          </div>
      </div>
    {!! Form::close() !!}

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
</section>

@include('admin.modals.confirm', [
    'route'    => 'remove.etudiant.formation',
    'method'   => 'delete',
    'resource' => $form_etud,
    'confirm'  => 'Oui, je supprimer',
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
