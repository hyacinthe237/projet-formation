@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formation.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Nouvelle Formation
        </div>
    </div>
<section class="container-fluid mt-20">

@include('errors.list')
    <form class="_form" action="{{ route('formation.store') }}" method="post">
      {{ csrf_field() }}

      <div class="block">
          <div class="block-content form">

              <div class="row mt-20">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" name="title"
                                      class="form-control input-lg" value="{{ old('title')}}" placeholder="Titre" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Nombre de place</label>
                                    <input type="number" name="qte_requis"
                                      class="form-control input-lg" value="{{ old('qte_requis')}}" placeholder="Nombre de place" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Date de début</label>
                                    <input type="date" name="start_date"  value="{{ old('start_date')}}" class="form-control input-lg datepicker" placeholder="Date de début" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Heure</label>
                                          <select class="form-control input-lg" name="start_heure">
                                              @for($i=0; $i< 24; $i++)
                                                <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                                <option value="{{ $value }}" {{ $value == '08' ? 'selected' : ''}}>{{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Minutes</label>
                                          <select class="form-control input-lg" name="start_minutes">
                                              @for($i=0; $i< 60; $i+=5)
                                                <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                                <option value="{{ $value }}">
                                                  {{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Date de fin</label>
                                    <input type="date" name="end_date"  value="{{ old('end_date')}}" class="form-control input-lg datepicker" placeholder="Date de fin">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Heure</label>
                                          <select class="form-control input-lg" name="end_heure">
                                              @for($i=0; $i< 24; $i++)
                                                <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                                <option value="{{ $value }}" {{ $value == '19' ? 'selected' : ''}}>
                                                  {{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Minutes</label>
                                          <select class="form-control input-lg" name="end_minutes">
                                              @for($i=0; $i< 60; $i+=5)
                                                <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                                <option value="{{ $value }}">
                                                  {{ $value }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"  value="{{ old('description')}}" class="form-control input-lg" rows="5" cols="80"></textarea>
                              </div>
                            </div>

                            <div class="col-sm-10">
                                <label>Sélectionnez un ou plusieurs financeurs</label>
                                <div class="row">
                                    @foreach ($financeurs as $financeur)
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                                    <input type="checkbox" name="financeurs[]" value="{{ $financeur->id }}">
                                                    <span class="mr-10"></span> {{ $financeur->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addFinanceurModal">
                                    <i class="ion-plus"></i>
                                </button>
                            </div>
                        </div>
                  </div>

                  <div class="col-sm-3">
                        <div class="form-group">
                            <label>Site</label>
                            <div class="form-select grey">
                                <select name="commune_id" class="form-control input-lg">
                                  @foreach($communes as $commune)
                                      <option value="{{ $commune->id }}">
                                        {{ $commune->name }}
                                      </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Catégories</label>
                            <div class="row">
                                <div class="col-xs-9">
                                  <div class="form-select grey">
                                      <select name="category_id" class="form-control input-lg">
                                            <option value="">Sélectionnez une catégorie</option>
                                            @foreach($categories as $item)
                                                <option value="{{ $item->id }}">
                                                  {{ $item->name }}
                                                </option>
                                            @endforeach
                                      </select>
                                  </div>
                                </div>
                                <div class="col-xs-3">
                                  <button class="btn btn-success" data-toggle="modal" data-target="#addCategoryModal">
                                      <i class="ion-plus"></i>
                                  </button>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Type</label>
                            <div class="form-select grey">
                                <select name="type" class="form-control input-lg">
                                    <option value="Effective">Effective</option>
                                    <option value="Besoin">Besoins</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-select grey">
                                <select name="is_active" class="form-control input-lg">
                                    <option value="1">Activée</option>
                                    <option value="0">Inactivée</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group text-right mb-20 mt-60">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="ion-checkmark"></i> Enregistrer
                            </button>
                        </div>
                  </div>
              </div>
          </div>
      </div>
    </form>
</section>

@include('admin.modals.add', [
  'modalId' => 'addCategoryModal',
  'route' => 'categories.store',
  'title' => 'Ajouter une categorie',
  'label' => 'Nom de la categorie',
  'placeholder' => 'Saisissez le nom de la categorie',
])

@include('admin.modals.add', [
  'modalId' => 'addFinanceurModal',
  'route' => 'financeurs.store',
  'title' => 'Ajouter un financeur',
  'label' => 'Nom du financeur',
  'placeholder' => 'Saisissez le nom du financeur',
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
