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

        <div class="pricings">
                <div class="row">
                    @foreach ($regions as $item)
                        <div class="col-sm-6">
                          @if (count($item->formations))
                            <div class="pricing">
                                <div class="title">{{ $item->name }}</div>
                                <ul class="list-unstyled options">
                                    @foreach ($item->formations as $form)
                                      <li>{{ $search->where('id', $form->formation_id)->first()->title }}
                                         commune de <strong>{{ $communes->where('id', $form->commune_id)->first()->name }}</strong></li>
                                    @endforeach
                                </ul>

                            </div>
                          @endif

                        </div>
                    @endforeach
                </div>
            </div>

    </div>
</div>
@endsection
