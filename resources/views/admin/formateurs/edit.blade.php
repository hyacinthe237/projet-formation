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
<section class="container-fluid mt-20">
    {!! Form::model($formateur, ['method' => 'PUT', 'route' => ['formateurs.update', $formateur->id], 'class' => '_form' ]) !!}

            @include('errors.list')
            {{ csrf_field() }}

            <div class="block">
                <div class="block-content form">
                      <div class="row mt-20">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Prénom(s)</label>
                                <input type="text" name="firstname" class="form-control input-lg" value="{{ $formateur->firstname }}" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Nom(s)</label>
                                <input type="text" name="lastname" class="form-control input-lg" value="{{ $formateur->lastname }}" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Qualification</label>
                                <input type="text" name="qualification" class="form-control input-lg" value="{{ $formateur->qualification }}" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
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
    {!! Form::close() !!}

@if (sizeOf($formateur->formations))
  <h3 class="_block-title mb-20">Formations</h3>
  <div class="block">
      <div class="block-content form">
        <div class="mt-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Nbre de Places</th>
                        <th>Etat</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($formateur->formations as $item)
                        <tr data-href="{{ route('formation.edit', $item->formation->number) }}">
                            <td class="bold">{{ $item->formation->title }}</td>
                            <td>{{ $item->formation->qte_requis }}</td>
                            <td>{{ $item->formation->is_active ? 'Active' : 'Non active' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
  </div>
@endif

@if (sizeOf($formateur->thematiques))
  <h3 class="_block-title mb-20">Thematiques</h3>
  <div class="block">
      <div class="block-content form">
        <div class="mt-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Durée</th>
                        <th>Début</th>
                        <th>Fin</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($formateur->thematiques as $item)
                        <tr data-href="{{ route('thematiques.edit', $item->id) }}">
                            <td class="bold">{{ $item->thematique->name }}</td>
                            <td>{{ $item->thematique->duree }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($item->start_date)) }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($item->end_date)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
  </div>
@endif

</section>
@endsection
