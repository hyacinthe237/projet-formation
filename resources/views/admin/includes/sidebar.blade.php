<div id="sidebar-wrapper">
    <ul class="sidebar-nav">

        <li class="{{ Request::is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin') }}">
                <i class="ion-speedometer"></i>
                Dashboard
            </a>
        </li>

        <li class="
            {{ Request::is('admin/returns*') ? 'active' : '' }}
            {{ Request::is('admin/bookings*') ? 'active' : '' }}
            {{ Request::is('admin/pickups*') ? 'active' : '' }}"
        >
            <a href="/admin/associations">
                <i class="ion-android-cart"></i>
                Association
            </a>
        </li>

        <li class="dropdown {{ Request::is('admin/vehicles*') ? 'active open' : '' }}">
            <a href="" data-toggle="dropdown">
                <i class="ion-android-car"></i>
                Vehicles <span class="ml-10 ion-chevron-down"></span>
            </a>

            <ul class="sidebar-dropdown">
                <li>
                    <a href="#">
                        Makes
                    </a>
                </li>
                <li>
                    <a href="#">
                        Models
                    </a>
                </li>
                <li>
                    <a href="#">
                        Cars
                    </a>
                </li>
            </ul>
        </li>


        @if (Auth::user()->role->name === 'admin')
            <li class="{{ Request::is('admin/pages*') ? 'active' : '' }}">
                <a href="#">
                    <i class="ion-document-text"></i>
                    Pages
                </a>
            </li>

            <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                <a href="#">
                    <i class="ion-document"></i>
                    Posts
                </a>
            </li>

            <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                <a href="/admin/users">
                    <i class="ion-android-people"></i>
                    Users
                </a>
            </li>


            <li class="{{ Request::is('admin/payments*') ? 'active' : '' }}">
                <a href="/admin/payments">
                    <i class="ion-card"></i>
                    Payments
                </a>
            </li>


            <li class="dropdown {{ Request::is('admin/extra*') ? 'active open' : '' }}">
                <a href="" data-toggle="dropdown">
                    <i class="ion-plus"></i>
                    Extra <span class="ml-10 ion-chevron-down"></span>
                </a>

                <ul class="sidebar-dropdown">
                    <li>
                        <a href="/admin/coupons">
                            <i class="ion-cash"></i>
                            Coupons
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ion-document-text"></i>
                            Options
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="ion-pin"></i>
                            Locations
                        </a>
                    </li>

                    <li>
                        <a href="#">
                             <i class="ion-help"></i> FAQs
                        </a>
                    </li>
                    <li>
                        <a href="/admin/files">
                            <i class="ion-folder"></i>
                            Files
                        </a>
                    </li>
                    <li>
                        <a href="/admin/settings">
                            <i class="ion-android-options"></i>
                            Settings
                        </a>
                    </li>
                    <li>
                        <a href="/admin/seasonals">
                            <i class="ion-calendar"></i>
                            Seasonal
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ion-android-send"></i>
                            Home Slider
                        </a>
                    </li>
                </ul>
            </li>

        @endif

        <li class="separer"></li>

        <li>
            <a href="/" target="_blank">
                <i class="ion-ios-world-outline"></i>
                Main Website
            </a>
        </li>

        <li>
            <a href="#">
                <i class="ion-power"></i>
                Sign Out
            </a>
        </li>
    </ul>
</div>
