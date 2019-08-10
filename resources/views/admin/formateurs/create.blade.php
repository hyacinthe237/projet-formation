@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formateurs.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Nouveau formateur
        </div>
    </div>

{!! Form::open(['method' => 'POST', 'route' => ['formateurs.store'], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Prénom(s)</label>
                            <input type="text" name="firstname" class="form-control input-lg" placeholder="prénom(s)" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nom(s)</label>
                            <input type="text" name="lastname" class="form-control input-lg" placeholder="nom(s)" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Qualification</label>
                            <input type="text" name="qualification" class="form-control input-lg" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Type</label>
                            <div class="form-select grey">
                                <select name="type" class="form-control input-lg" required>
                                    <option value="">Sélectionnez le type</option>
                                    <option value="Expert">Expert</option>
                                    <option value="Personnels PNMFV">Personnels PNMFV</option>
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
