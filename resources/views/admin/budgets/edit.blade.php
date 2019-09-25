@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('items.create', $budget->id) }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter Item
            </a>

            <a href="{{ route('budgets.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Edit budget
        </div>
    </div>
<section class="container-fluid mt-20">

    {!! Form::model($budget, ['method' => 'PATCH', 'route' => ['budgets.update', $budget->id], 'class' => '_form' ]) !!}

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Budget Initial</label>
                            <input type="text" name="budget_initial" class="form-control input-lg" value="{{ $budget->budget_initial }}" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Budget Réel</label>
                            <input type="text" name="budget_reel" class="form-control input-lg" value="{{ $budget->budget_reel }}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Sélectionnez une formation</label>
                            <select class="form-control input-lg" name="formation_id">
                                @foreach ($formations as $formation)
                                    <option value="{{ $formation->id }}" {{ $formation->id === $budget->formation_id ? 'selected' : '' }}>
                                      {{ $formation->title }}</option>
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
    {!! Form::close() !!}

    <h3 class="_block-title mb-20">Budget Items</h3>
    <div class="block">
        <div class="block-content form">
              <div class="row mt-20">
                  <div class="col-sm-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Désignation</th>
                                <th>Unité</th>
                                <th>Nombre Unité</th>
                                <th>Coût Unitaire</th>
                                <th>Coût Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($budget->items as $item)
                                <tr data-href="{{ route('items.edit', $item->id) }}">
                                    <td>{{ $item->designation }}</td>
                                    <td>{{ $item->unite }}</td>
                                    <td>{{ $item->nb_unite }}</td>
                                    <td>{{ $item->cout_unite }}</td>
                                    <td>{{ $item->total  }}</td>
                                </tr>
                            @endforeach
                            <tr class="bold">
                              <td colspan="3">Total</td>
                              <td colspan="2" class="text-right">{{ $total  }}</td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </div>

        </div>
    </div>



</section>



@endsection
