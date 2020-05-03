@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('fonctions.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit Fonction
        </div>
    </div>



    <section class="container-fluid mt-20">
      {!! Form::model($fonction, ['method' => 'PATCH', 'route' => ['fonctions.update', $fonction->id], 'class' => '_form' ]) !!}

        @include('errors.list')

        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nom de la fonction</label>
                            <input type="text" name="name" class="form-control input-lg" value="{{ $fonction->name }}" required>
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
      @if (Auth::user()->role->name === 'admin')
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
      @endif
    </section>

    @include('admin.modals.confirm', [
        'route'    => 'fonctions.destroy',
        'method'   => 'delete',
        'resource' => $fonction,
        'confirm'  => 'Oui, je supprime',
        'message'  => 'Voulez-vous de façon permanente supprimer la fonction de "'. $fonction->name .'" ?'
    ])
@endsection
