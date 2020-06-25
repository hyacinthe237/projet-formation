@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('besoins.create') }}" class="btn btn-lg btn-primary mr-5">
                <i class="ion-plus"></i> Ajouter Besoin
            </a>

            <a href="{{ route('cibles.index') }}" class="btn btn-lg btn-success">
                <i class="ion-plus"></i> Cibles
            </a>
        </div>

        <div class="title">
            Besoins en formation
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text"
                                name="keywords"
                                class="form-control input-lg"
                                value="{{ Request::get('keywords') }}"
                                placeholder="Recherche...">
                            </div>
                        </div>
                        <div class="col-sm-3">
                          <select class="form-control input-lg" name="commune">
                            <option value="">Sélectionnez Communauté Urbaine</option>
                              @foreach ($communes as $item)
                                <option value="{{ $item->id }}" {{ Request::get('commune') == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="col-sm-3">
                          <select class="form-control input-lg" name="cible">
                            <option value="">Sélectionnez Cible</option>
                              @foreach ($cibles as $item)
                                <option value="{{ $item->id }}" {{ Request::get('cible') == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                              @endforeach
                          </select>
                        </div>

                        <div class="col-sm-2">
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
                            <th>Commune</th>
                            <th>Cible</th>
                            <th>Direction/Service</th>
                            <th>Email</th>
                            <th>Date d’entrée à la CUD</th>
                            <th>Ajouté le</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($besoins as $besoin)
                            <tr data-href="{{ route('besoins.edit', $besoin->number) }}">
                                <td class="bold">{{ $besoin->name }}</td>
                                <td>{{ $besoin->commune->name }}</td>
                                <td>{{ $besoin->cible? $besoin->cible->name : '...' }}</td>
                                <td>{{ $besoin->direction_service }}</td>
                                <td>{{ $besoin->email }}</td>
                                <td>{{ date('d/m/Y', strtotime($besoin->date_cud)) }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($besoin->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-20">
                {{ $besoins->links() }}
            </div>
            <!-- End of table -->
        </div>
    </section>


@endsection
