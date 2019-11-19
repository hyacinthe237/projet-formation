@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formateurs.edit', $thematique->formateur->id) }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
          {{-- Modification du site <strong>"{{ $site->commune->name }}"</strong> --}}

          {{-- <div class="alert alert-info alert-dismissible mt-10" role="alert">
              Formation <strong>"{{ $site->formation->title }}"</strong>
          </div> --}}
        </div>
    </div>
<section class="container-fluid mt-20">

@include('errors.list')
    {!! Form::model($thematique, ['method' => 'POST', 'route' => ['formateurs.update.thematique', $thematique->id], 'class' => '_form' ]) !!}
      {{ csrf_field() }}

      <div class="block">
          <div class="block-content form">

              <div class="row mt-20">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="hidden" name="formateur_id" value="{{ $thematique->formateur_id }}">
                                <div class="form-group">
                                    <label>Date de début</label>
                                    <input type="datetime-local" name="start_date" class="form-control input-lg" value="{{ $thematique->datesdebut }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date de fin</label>
                                    <input type="datetime-local" name="end_date" class="form-control input-lg" value="{{ $thematique->datesfin }}">
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
                                      <option value="{{ $item->id }}" {{ $item->id == $thematique->thematique_id ? 'selected' : ''}}>
                                        {{ $->name }}
                                      </option>
                                  @endforeach
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

</section>

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
