@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            @if (sizeOf($budget->items))
                <a href="{{ route('budgets.download', $budget->id)}}" class="btn btn-lg btn-success" target="_blank">
                    <i class="ion-document"></i> Visualiser le PDF
                </a>
            @endif

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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Budget Initial</label>
                            <input type="text" name="budget_initial" class="form-control input-lg" value="{{ $budget->budget_initial }}" required>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Budget Réalisé</label>
                            <input type="text" name="budget_reel" class="form-control input-lg" value="{{ $budget->budget_reel }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Taux de consommation</label>

                        </div>
                    </div>
                  </div>
                  <div class="row mt-20">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Sélectionnez une formation</label>
                            <select class="form-control input-lg" name="formation_id">
                                @foreach ($formations as $item)
                                    <option value="{{ $item->id }}" {{ $item->id === $budget->commune_formation_id ? 'selected' : '' }}>
                                      {{ $item->formation->title }} de {{ $item->commune->name }}</option>
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
                                {{-- <th>Type</th> --}}
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
                                    {{-- <td>{{ $item->type->name }}</td> --}}
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


              <form class="_form" action="{{ route('items.store') }}" method="post">

                {{ csrf_field() }}

                <h3>Ajouter un élément au budget</h3>
                <input type="hidden" name="budget_id" value="{{ $budget->id }}">
                <div class="block">
                    <div class="block-content form">
                      <div class="row mt-20">
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Désignation</label>
                                      <input type="text" name="designation" class="form-control input-lg" placeholder="Désignation" required>
                                  </div>
                              </div>
                              <div class="col-sm-2">
                                  <div class="form-group">
                                      <label>Coût Unitaire</label>
                                      <input type="number" name="cout_unite" class="form-control input-lg" placeholder="Coût Unitaire">
                                  </div>
                              </div>
                              <div class="col-sm-2">
                                  <div class="form-group">
                                      <label>Nombre d'unité</label>
                                      <input type="number" name="nb_unite" class="form-control input-lg" placeholder="Nombre d'unité">
                                  </div>
                              </div>
                              <div class="col-sm-4">
                                  <div class="form-group">
                                      <label>Unité de quantification</label>
                                      <select class="form-control input-lg" name="unite">
                                          <option value="Billet d'avion/Expert">Billet d'avion/Expert</option>
                                          <option value="Billet d'avion/personne">Billet d'avion/personne</option>
                                          <option value="Forfait">Forfait</option>
                                          <option value="Homme/jour">Homme/jour</option>
                                          <option value="Jour">Jour</option>
                                          <option value="Par jour">Par jour</option>
                                          <option value="Unité">Unité</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="col-sm-4">
                                  <div class="form-group">
                                      <label>Sélectionnez le type</label>
                                      <select class="form-control input-lg" name="type_item_id">
                                          @foreach ($types as $type)
                                              <option value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>

                              <div class="col-sm-12">
                                  <div class="form-group text-right mt-20">
                                      <button type="submit" class="btn btn-lg btn-primary">
                                          <i class="ion-checkmark"></i> Ajouter
                                      </button>
                                  </div>
                              </div>
                      </div>
                    </div>
                </div>
              </form>

        </div>
    </div>



</section>



@endsection
