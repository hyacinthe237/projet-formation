<div id="sidebar-wrapper">
    <ul class="sidebar-nav">

        <li class="{{ Request::is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin') }}">
                <i class="ion-speedometer"></i>
                Dashboard
            </a>
        </li>

        <li class="{{ Request::is('admin/etudiants*') ? 'active' : '' }}">
            <a href="/admin/etudiants">
                <i class="ion-android-cart"></i>
                Etudiants
            </a>
        </li>

        <li class="{{ Request::is('admin/formations*') ? 'active' : '' }}">
            <a href="/admin/formations">
                <i class="ion-android-cart"></i>
                Formations
            </a>
        </li>

        <li class="{{ Request::is('admin/phases*') ? 'active' : '' }}">
            <a href="/admin/phases">
                <i class="ion-android-cart"></i>
                Phases
            </a>
        </li>

        <li class="{{ Request::is('admin/formateurs*') ? 'active' : '' }}">
            <a href="/admin/formateurs">
                <i class="ion-android-cart"></i>
                Formateurs
            </a>
        </li>

        @if (Auth::user()->role->name === 'admin')
            <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                <a href="/admin/users">
                    <i class="ion-android-people"></i>
                    Utilisateurs
                </a>
            </li>

            <li class="{{ Request::is('admin/budgets*') ? 'active' : '' }}">
                <a href="/admin/budgets">
                    <i class="ion-card"></i>
                    Budgets
                </a>
            </li>
        @endif

        <li class="separer"></li>

        <li>
            <a href="/" target="_blank">
                <i class="ion-ios-world-outline"></i>
                Aller sur le site
            </a>
        </li>

        <li>
            <a href="{{ route('admin.logout') }}">
                <i class="ion-power"></i>
                Déconnexion
            </a>
        </li>
    </ul>
</div>
