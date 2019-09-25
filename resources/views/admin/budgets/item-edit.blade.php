@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('budgets.edit', $item->budget->id) }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>

        </div>

        <div class="title">
            Edit Item
        </div>
    </div>

    <section class="mt-20">
        <div class="container-fluid">
            @include('errors.list')

            {!! Form::model($item, ['method' => 'PUT', 'route' => ['items.update', $item->id], 'class' => '_form' ]) !!}
            {{-- Left side  --}}
            <input type="hidden" name="budget_id" value="{{ $item->budget->id }}">
            <div class="block">
                <div class="block-content form">
                  <div class="row mt-20">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Désignation</label>
                                  <input type="text" name="designation" class="form-control input-lg" value="{{ $item->designation }}" required>
                              </div>
                          </div>
                          <div class="col-sm-2">
                              <div class="form-group">
                                  <label>Coût Unitaire</label>
                                  <input type="number" name="cout_unite" class="form-control input-lg"  value="{{ $item->cout_unite }}">
                              </div>
                          </div>
                          <div class="col-sm-2">
                              <div class="form-group">
                                  <label>Nombre d'unité</label>
                                  <input type="number" name="nb_unite" class="form-control input-lg"  value="{{ $item->nb_unite }}">
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="form-group">
                                  <label>Unité de quantification</label>
                                  <select class="form-control input-lg" name="unite">
                                      <option value="Billet d'avion/Expert" {{ $item->unite == 'Billet d\'avion/Expert' ? 'selected' : '' }}>
                                        Billet d'avion/Expert</option>
                                      <option value="Billet d'avion/personne" {{ $item->unite == 'Billet d\'avion/personne' ? 'selected' : '' }}>
                                        Billet d'avion/personne</option>
                                      <option value="Forfait" {{ $item->unite == 'Forfait' ? 'selected' : '' }}>Forfait</option>
                                      <option value="Homme/jour" {{ $item->unite == 'Homme/jour' ? 'selected' : '' }}>Homme/jour</option>
                                      <option value="Jour" {{ $item->unite == 'Jour' ? 'selected' : '' }}>Jour</option>
                                      <option value="Par jour" {{ $item->unite == 'Par jour' ? 'selected' : '' }}>Par jour</option>
                                      <option value="Unité" {{ $item->unite == 'Unité' ? 'selected' : '' }}>Unité</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              <div class="form-group">
                                  <label>Sélectionnez le type</label>
                                  <select class="form-control input-lg" name="type_item_id">
                                      @foreach ($types as $type)
                                          <option value="{{ $type->id }}" {{ $item->type_item_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}</option>
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
        </div>
    </section>

    @include('admin.modals.confirm', [
        'route'    => 'items.delete',
        'method'   => 'POST',
        'resource' => $item,
        'confirm'  => 'Oui, Je supprime',
        'message'  => 'Voulez-vous vraiment supprimer cet élément du budget ?'
    ])
@endsection
