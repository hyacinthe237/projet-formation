@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('thematiques.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Editer Thématique
        </div>
    </div>

{!! Form::model($thematique, ['method' => 'PUT', 'route' => ['thematiques.update', $thematique->id], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="name" class="form-control input-lg" value="{{ $thematique->name }}" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Durée</label>
                            <input type="text" name="duree" class="form-control input-lg" value="{{ $thematique->duree }}" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Phase</label>
                            <div class="form-select grey">
                                <select name="phase_id" class="form-control input-lg">
                                    <option value="">Sélectionnez la phase</option>
                                    @foreach ($phases as $phase)
                                        <option value="{{ $phase->id }}" {{ $phase->id == $thematique->phase_id ? 'selected' : ''}}>{{ $phase->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
    </section>
{!! Form::close() !!}
@endsection
