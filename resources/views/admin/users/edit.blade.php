@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('users.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit User
        </div>
    </div>



    <section class="container-fluid mt-20">
      {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'class' => '_form' ]) !!}
        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">

                <div class="row pb-20">
                    <div class="col-sm-4">
                        <label>Status</label>
                        <div class="form-select grey">
                            <select name="is_active" class="form-control input-lg">
                                <option value="0" {{ $user->is_active == 0 ? 'selected' : ''}}>Inactif</option>
                                <option value="1" {{ $user->is_active == 1 ? 'selected' : ''}}>Actif</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Sexe</label>
                        <div class="form-select grey">
                            <select name="sex" class="form-control input-lg">
                                <option value="Feminin" {{ $user->sex == 'Feminin' ? 'selected' : ''}}>Feminin</option>
                                <option value="Masculin" {{ $user->sex == 'Masculin' ? 'selected' : ''}}>Masculin</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Role</label>
                        <div class="form-select grey">
                            <select name="role_id" class="form-control input-lg">
                                @foreach( $roles as $role )
                                    <option value="{{$role->id}}" {{ $user->role_id == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="firstname" class="form-control input-lg" value="{{ $user->firstname }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="lastname" class="form-control input-lg" value="{{ $user->lastname }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control input-lg" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" name="phone" class="form-control input-lg" required value="{{ $user->phone }}">
                        </div>
                    </div>

                </div>

                <div class="text-right mr-20">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <i class="ion-checkmark"></i> Enregistrer
                    </button>
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


    <section class="mt-10">

        <form class="_form" action="{{ route('admin.password') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="container-fluid">
                <div class="block">
                    <div class="block-content">
                        <div class="row mt-20">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="password" name="password" required class="form-control input-lg" placeholder="Nouveau mot de passe">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="password" name="password_confirm" required class="form-control input-lg" placeholder="Confirmer mot de passe">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-lg btn-success btn-block">
                                    <i class="flaticon-lock"></i> Modifier mot de passe
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </section>


    @include('admin.modals.confirm', [
        'route'    => 'users.destroy',
        'method'   => 'delete',
        'resource' => $user,
        'confirm'  => 'Oui, je supprime',
        'message'  => 'Voulez-vous de façon permanente supprimer cet utilisateur ?'
    ])
@endsection

@section('js')
<script type="text/javascript" src="/backend/js/scripts.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('.date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    })
})
</script>
@endsection
