@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            {{-- <a href="{{ route('phases.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter Phase
            </a> --}}
        </div>

        <div class="title">
            Session
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

            {!! Form::open(['method' => 'POST', 'route' => ['sessions.store'], 'class' => '_form' ]) !!}

                <section class="container-fluid mt-20">
                    {{ csrf_field() }}

                    <div class="block">
                        <div class="block-content form">
                              <div class="row mt-20">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="name" class="form-control input-lg" placeholder="Nom: 2019" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="form-select grey">
                                            <select name="status" class="form-control input-lg" required>
                                                <option value="">Sélectionnez un status</option>
                                                <option value="pending">En cours</option>
                                                <option value="passed">Passée</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
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

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            {{-- <th>Période</th> --}}
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td> <a href="{{ route('sessions.edit', $session->id) }}">{{ $session->name }}</a></td>
                                {{-- <td>
                                  @if ($session->period == 'trimestre')
                                    Trimestre
                                  @endif

                                  @if ($session->period == 'semestre')
                                    Semestre
                                  @endif

                                  @if ($session->period == 'annuelle')
                                    Annuelle
                                  @endif
                                </td> --}}
                                <td>
                                  @if ($session->status == 'pending')
                                    Session active
                                  @else
                                    Passée
                                  @endif
                                </td>
                                <td>
                                    @if ($session->status == 'passed')
                                       <a href="{{ route('sessions.pending', $session->id) }}" class="btn btn-success">Activer la session</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
        </div>
    </section>


@endsection
