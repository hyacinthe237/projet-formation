<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/admin.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <script>
        var _auth = undefined;
    </script>
</head>
<body class="login-page">
    <section class="login-form" id="app">
        <h2>Connexion</h2>

        @include('errors.list')

        <form class="_form" action="" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control input-lg text-center"
                placeholder="Email"
                required>
            </div>

            <div class="form-group">
                <input type="password"
                name="password"
                value="{{ old('password') }}"
                class="form-control input-lg text-center"
                placeholder="Password"
                required>
            </div>

            <div class="mt-40">
                <button type="submit" class="btn btn-lg btn-success btn-block elevated">
                    Connexion
                </button>
            </div>
        </form>

        <div class="mt-20 pb-10 fs-16">
            {{-- <a href="/password/forgot">Mot de passe oublié ?</a> --}}
        </div>
    </section>


    <script src="/backend/js/admin.js"></script>
</body>
</html>
