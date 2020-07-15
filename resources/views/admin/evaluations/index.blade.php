@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('evaluations.create')}}" class="btn btn-lg btn-success">
                <i class="ion-plus"></i> Nouveau Formulaire
            </a>
        </div>

        <div class="title">
            Evaluation Finale
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-6">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="site">
                                    <option value="">Toutes les formations</option>
                                    @if (is_array($formations) || is_object($formations))
                                        @foreach($formations as $item)
                                            <option value="{{ $item->id }}"
                                              {{ Request::get('site') == $item->id ? 'selected' : '' }}>
                                                {{ $item->formation->title }} de {{ $item->commune->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="stagiaire">
                                    <option value="">Toutes les stagiaires</option>
                                    @if (is_array($etudiants) || is_object($etudiants))
                                        @foreach($etudiants as $item)
                                            <option value="{{ $item->id }}"
                                              {{ Request::get('stagiaire') == $item->id ? 'selected' : '' }}>
                                                {{ $item->firstname }} {{ $item->lastname }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
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
            <hr>

            @include('errors.list')


            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Stagiare</th>
                            <th>Structure</th>
                            <th>Fonction</th>
                            <th>Formation</th>
                            <th>Créé le</th>
                        </tr>
                    </thead>

                    <tbody>
                      @if (is_array($evaluations) || is_object($evaluations))
                              @foreach($evaluations as $item)
                                  <tr>
                                      <td>{{ $item->number }}</td>
                                      <td class="bold">{{ $item->stagiaire->firstname }} {{ $item->stagiaire->lastname }}</td>
                                      <td>{{ $item->stagiaire->structure ? 'Commune de ' . $item->stagiaire->structure->name : '---' }}</td>
                                      <td>{{ $item->stagiaire->fonction ? $item->stagiaire->fonction->name : '---' }}</td>
                                      <td>{{ $item->site->formation->title }} de {{ $item->site->commune->name }}</td>
                                      <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                  </tr>
                              @endforeach
                      @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-20">
                {{ $evaluations->links() }}
            </div>
        </div>
    </section>


@endsection
