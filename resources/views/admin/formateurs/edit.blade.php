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

{!! Form::model($formateur, ['method' => 'PUT', 'route' => ['formateurs.update', $formateur->id], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Prénom(s)</label>
                            <input type="text" name="firstname" class="form-control input-lg" value="{{ $formateur->firstname }}" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nom(s)</label>
                            <input type="text" name="lastname" class="form-control input-lg" value="{{ $formateur->lastname }}" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Qualification</label>
                            <input type="text" name="qualification" class="form-control input-lg" value="{{ $formateur->qualification }}" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
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
