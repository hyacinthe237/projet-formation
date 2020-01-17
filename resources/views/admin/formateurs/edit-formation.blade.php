@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formateurs.edit', $formateur_formation->formateur->id) }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
          Modification de la Thematique <strong>"{{ $formateur_formation->formation->title }}"</strong>

          <div class="alert alert-info alert-dismissible mt-10" role="alert">
              Formateur {{ $formateur_formation->formateur->name }}
          </div>
        </div>
    </div>
<section class="container-fluid mt-20">

@include('errors.list')
    {!! Form::model($formateur_formation, ['method' => 'POST', 'route' => ['formateur.store.formation', $formateur_formation->formateur->id], 'class' => '_form' ]) !!}
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
                                      <option value="{{ $item->id }}" {{ $item->id == $formateur_formation->formation_id ? 'selected' : ''}}>
                                        {{ $item->title }}
                                      </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

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
    'route'    => 'formateur.delete.formation',
    'method'   => 'delete',
    'resource' => $formateur_formation,
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
