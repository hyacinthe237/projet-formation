@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('phases.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit phase
        </div>
    </div>



    <section class="container-fluid mt-20">
      {!! Form::model($phase, ['method' => 'PATCH', 'route' => ['phases.update', $phase->id], 'class' => '_form' ]) !!}

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" name="title" class="form-control input-lg" value="{{ $phase->title }}" required>
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

      {!! Form::close() !!}
        <div class="row">
            <div class="col-sm-6 mb-40">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('admin.modals.confirm', [
        'route'    => 'phases.destroy',
        'method'   => 'delete',
        'resource' => $phase,
        'confirm'  => 'Oui, je supprimer',
        'message'  => 'Voulez-vous de façon permanente supprimer la phase de "'. $phase->title .'" ?'
    ])
@endsection
