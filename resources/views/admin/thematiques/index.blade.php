@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('thematiques.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter Thématique
            </a>
        </div>

        <div class="title">
            Thématiques
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-4">
                          <div class="form-select grey">
                              <select name="phase_id" class="form-control input-lg">
                                  <option value="">Sélectionnez la phase</option>
                                  @foreach ($phases as $phase)
                                      <option value="{{ $phase->id }}" {{ $phase->id == Request::get('phase_id') ? 'selected' : ''}}>{{ $phase->title }}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="text"
                                name="keywords"
                                class="form-control input-lg"
                                value="{{ Request::get('keywords') }}"
                                placeholder="Recherche...">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @include('errors.list')

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Phase</th>
                            <th>Durée</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($thematiques as $thematique)
                            <tr data-href="{{ route('thematiques.edit', $thematique->id) }}">
                                <td class="bold">{{ $thematique->name }}</td>
                                <td>{{ $thematique->phase->title }}</td>
                                <td>{{ $thematique->duree }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($thematique->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
        </div>
    </section>


@endsection
