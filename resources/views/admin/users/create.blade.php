@extends('admin.body')

@section('head')
    <link rel="stylesheet" type="text/css" href="/backend/fancybox/jquery.fancybox.css" media="screen" />
@endsection

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('users.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
            Nouveau utilisateur
        </div>
    </div>

{!! Form::open(['method' => 'POST', 'route' => ['users.store'], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">

                <div class="row pb-20">
                    <div class="col-sm-4">
                        <label>Status</label>
                        <div class="form-select grey">
                            <select name="is_active" class="form-control input-lg" value="{{ old('is_active') }}">
                                <option value="0">Inactif</option>
                                <option value="1">Actif</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Sexe</label>
                        <div class="form-select grey">
                            <select name="sex" class="form-control input-lg" value="{{ old('sex') }}">
                                <option value="Feminin">Feminin</option>
                                <option value="Masculin">Masculin</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Rôle</label>
                        <div class="form-select grey">
                            <select name="role_id" class="form-control input-lg" value="{{ old('role_id') }}">
                                @foreach( $roles as $role )
                                    <option value="{{ $role->id}}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="firstname" class="form-control input-lg" placeholder="Prénom" required value="{{ old('firstname') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="lastname" class="form-control input-lg" placeholder="Nom" required value="{{ old('lastname') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control input-lg" placeholder="Email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" name="phone" class="form-control input-lg" placeholder="Téléphone" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control input-lg" value="{{ str_random(8) }}" value="{{ old('password') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Photo utilisateur</h4>

                            <input type="hidden" class="form-control" id="photo" name='photo' readonly value="{{ old('photo') }}">
                            <div id="photo_view" class="mt-20"></div>

                            <div class="text-right">
                                <a href="/backend/filemanager/dialog.php?type=1&field_id=photo" class="iframe-btn btn-dark btn round">
                                    <i class='ion-android-attach mr-10'></i> Uploader une photo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <div class="text-right mr-20">
        <button type="submit" class="btn btn-lg btn-primary">
            <i class="ion-checkmark"></i> Enregistrer
        </button>
    </div>

{!! Form::close() !!}
@endsection

@section('js')
<script type="text/javascript" src="/backend/js/scripts.js"></script>
<script type="text/javascript" src="/backend/fancybox/jquery.fancybox.js"></script>
<script>
$(document).ready(function() {
    $('.iframe-btn').fancybox({
        'width'     : 900,
        'maxHeight' : 600,
        'minHeight'    : 400,
        'type'      : 'iframe',
        'autoSize'      : false
    });

    $("body").hover(function() {
        var profilePic = $("input[name='photo']").val();
        if(profilePic)
            $('#photo_view').html("<img class='thumbnail img-responsive mb-10' src='" + profilePic +"'/>");
    });
})
</script>
@endsection
