@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('budgets.edit', $budget->id) }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>

        </div>

        <div class="title">
            Ajouter Item
        </div>
    </div>

    <section class="mt-20">
        <div class="container-fluid">
            @include('errors.list')

            <form class="_form" action="{{ route('items.store') }}" method="post">

              {{ csrf_field() }}

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



            {{-- {!! Form::close() !!} --}}
        </div>
    </section>
@endsection
