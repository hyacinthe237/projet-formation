@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('formateurs.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter Formateur
            </a>
        </div>

        <div class="title">
            Formateurs
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

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qualification</th>
                            <th>Type</th>
                            <th>Ajouté le</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($formateurs as $formateur)
                            <tr data-href="{{ route('formateurs.edit', $formateur->id) }}">
                                <td class="bold">{{ $formateur->getNameAttribute() }}</td>
                                <td>{{ $formateur->qualification }}</td>
                                <td>{{ $formateur->type }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($formateur->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
        </div>
    </section>


@endsection
