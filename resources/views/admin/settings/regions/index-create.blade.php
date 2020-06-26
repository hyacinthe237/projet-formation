@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('communes.index') }}" class="btn btn-lg btn-primary">
                <i class="ion-ios-keypad"></i> Communes
            </a>

            <a href="{{ route('departements.index') }}" class="btn btn-lg btn-success">
                <i class="ion-ios-keypad"></i> Départements
            </a>
        </div>

        <div class="title">
            Régions
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text"
                                name="keywords"
                                class="form-control input-lg"
                                value="{{ Request::get('keywords') }}"
                                placeholder="Recherche...">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @include('errors.list')

            <div class="row">
                <div class="col-sm-6">
                  {!! Form::open(['method' => 'POST', 'route' => ['regions.store'], 'class' => '_form' ]) !!}

                      <section class="container-fluid">
                          {{ csrf_field() }}

                          <div class="block">
                              <div class="block-content form">
                                    <div class="row">
                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Nom</label>
                                              <input type="text" name="name" class="form-control input-lg" placeholder="Nom" value="{{ old('name') }}" required>
                                          </div>
                                      </div>
                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Longitude</label>
                                              <input type="text" name="lon" class="form-control input-lg" placeholder="Coordonnée Longitude"  value="{{ old('lon') }}">
                                          </div>
                                      </div>
                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Latitude</label>
                                              <input type="text" name="lat" class="form-control input-lg" placeholder="Coordonnée Latitude"  value="{{ old('lat') }}">
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
                </div>

                <div class="col-sm-6">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Created</th>
                          </tr>
                      </thead>

                      <tbody>
                          @foreach($regions as $item)
                              <tr data-href="{{ route('regions.edit', $item->id) }}">
                                  <td>{{ $item->name }}</td>
                                  <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                  <div class="mt-10">
                    {{ $regions->links() }}
                  </div>
                </div>
            </div>
            <!-- End of table -->
        </div>
    </section>


@endsection
