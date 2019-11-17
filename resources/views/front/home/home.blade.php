@extends('front.templates.default')

@section('head')
    <title>Accueil</title>
@endsection()

@section('body')
  <section class="home-how">

      <div class="container mt-40 mb-40">
          <h1>Comment Ça Marche ?</h1>

          <div class="row">
              <div class="col-sm-6">
                  <div class="how-card green">
                      <div class="image">
                          <img src="/assets/images/rocket.png" alt="" class="img-responsive">
                      </div>

                      <h4>Je suis un stagiaire</h4>

                      <div class="card-desc">
                          Inscrivez vous gratuitement afin de suivre la formation que vous voulez.
                          Après votre inscription l'administration du PNFMV pour contactera pour vous communiquer des informations supplémentaires.
                      </div>

                      <a href="{{ route('front.stagiaires.create') }}" class="btn btn-lg btn-success mt-20">
                          Je m'inscris
                      </a>
                  </div>
              </div>

              <div class="col-sm-6">
                  <div class="how-card blue">
                      <div class="image">
                          <img src="/assets/images/roketblue.png" alt="" class="img-responsive">
                      </div>

                      <h4>Je suis un formateur</h4>

                      <div class="card-desc">
                          Vous êtes un formateur ? voici l'espace réservé à votre inscription dans la plateforme du PNFMV.
                          Merci à vous de nous faire confiance. Nous vous contacterons après votre inscription
                      </div>

                      <a href="{{ route('front.formateurs.create') }}" class="btn btn-lg btn-bleue mt-20">
                          Je m'inscris
                      </a>
                  </div>
              </div>
          </div>
      </div>

  </section>
@endsection()
