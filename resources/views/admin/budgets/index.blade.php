@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('types.index') }}" class="btn btn-lg btn-success">
                <i class="ion-ios-list"></i> Types
            </a>

            <a href="{{ route('budgets.create') }}" class="btn btn-lg btn-primary">
                <i class="ion-plus"></i> Ajouter
            </a>
        </div>

        <div class="title">
            Budgets
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
                            <th>Formation</th>
                            <th>Budget Initial</th>
                            <th>Budget Réalisé</th>
                            <th>Taux de consommation</th>
                            <th>Ajouté le</th>
                            <th>Modifié le</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($budgets as $budget)
                            <tr data-href="{{ route('budgets.edit', $budget->id) }}">
                                <td class="td-40">{{ $budget->site->formation->title }}</td>
                                <td class="td-10">{{ $budget->budget_initial . ' FCFA' }}</td>
                                <td class="td-10">{{ $budget->budget_reel . ' FCFA' }}</td>
                                <td class="td-10">{{ $budget->taux . '%' }}</td>
                                <td class="td-10">{{ date('d/m/Y H:i', strtotime($budget->created_at)) }}</td>
                                <td class="td-10">{{ date('d/m/Y H:i', strtotime($budget->updated_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
        </div>
    </section>


@endsection
