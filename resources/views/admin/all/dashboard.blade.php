@extends('admin.body')



@section('body')
<div class="page-title">
    <h3>Dashboard</h3>
</div>

<div class="dashboard">
    <div class="container-fluid">
        <div class="cards row">
            <div class="col-sm-3">
                <div class="card blue">
                    <h3>{{ count($users) }}</h3>
                    <h5>Utilisateurs</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card red">
                    <h3>{{ count($etudiants) }}</h3>
                    <h5>Stagiaires</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card green">
                    <h3>{{ count($formateurs) }}</h3>
                    <h5>Formateurs</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card dark">
                    <h3>{{ count($formations) }}</h3>
                    <h5>Formations</h5>
                </div>
            </div>
        </div>

        <div class="cards row">
            <div class="col-sm-12">
                <h4 class="bold">Taux de couverture</h4>
            </div>
            <div class="col-sm-4">
                <div class="card blue">
                    <h3>{{ count($users) }}</h3>
                    <h5>Personnes formées</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card red">
                    <h3>{{ $communesToucher . ' %' }}</h3>
                    <h5>Communes touchées</h5>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card dark">
                    <h3>{{ count($formations) }}</h3>
                    <h5>Formations exécutées</h5>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
