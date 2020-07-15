<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="ion-navicon"></span>
        </button>

        <a href="/" class="navbar-brand"><span>PNFMV</span> Formation</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="https://www.pnfmv.org/" target="_blank">A propos</a></li>
            <li class="{{ Request::is('stagiaires') ? 'active' : '' }}"><a href="{{ route('front.stagiaires.create') }}">Je suis Stagiaire</a></li>
            <li class="{{ Request::is('formateurs') ? 'active' : '' }}"><a href="{{ route('front.formateurs.create') }}">Je suis formateur</a></li>
            <li class="{{ Request::is('evaluations') ? 'active' : '' }}"><a href="{{ route('evaluation.finale') }}">Remplir le Formulaire</a></li>
            <li>
                <a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a>
            </li>
        </ul>
    </div>
</div>
