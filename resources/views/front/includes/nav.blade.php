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
            <li class="{{ Request::is('faqs') ? 'active' : '' }}"><a href="https://www.pnfmv.org/evenements/" target="_blank">Evènements</a></li>
            <li class="{{ Request::is('models*') ? 'active' : '' }}"><a href="https://www.pnfmv.org/contacts/" target="_blank">Nous contacter</a></li>

            <li>
                <a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a>
            </li>
        </ul>
    </div>
</div>
