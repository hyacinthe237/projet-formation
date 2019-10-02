@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('budgets.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Nouveau budget
        </div>
    </div>

{!! Form::open(['method' => 'POST', 'route' => ['budgets.store'], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Budget Initial</label>
                            <input type="text" name="budget_initial" class="form-control input-lg" placeholder="Budget Initial" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Budget en lettre</label>
                            <textarea name="description" class="form-control input-lg" placeholder="Budget en lettre" rows="1" cols="80"></textarea>
                        </div>
                    </div>
                  </div>
                  <div class="row mt-20">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Budget Réel</label>
                            <input type="text" name="budget_reel" class="form-control input-lg" placeholder="Budget Réel">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Sélectionnez une formation</label>
                            <select class="form-control input-lg" name="formation_id">
                                @foreach ($formations as $formation)
                                    <option value="{{ $formation->id }}">{{ $formation->title }}</option>
                                @endforeach
                            </select>
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
