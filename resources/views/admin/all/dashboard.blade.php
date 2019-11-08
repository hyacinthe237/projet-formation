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
                    <h3>{{ $users }}</h3>
                    <h5>Utilisateurs</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card red">
                    <h3>{{ $etudiants }}</h3>
                    <h5>Stagiaires</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card green">
                    <h3>{{ $formateurs }}</h3>
                    <h5>Formateurs</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card dark">
                    <h3>{{ $formations }}</h3>
                    <h5>Formations</h5>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
