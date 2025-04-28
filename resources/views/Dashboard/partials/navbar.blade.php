<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.home' ? 'active' : '' }}" href="{{ route('dashboard.home') }}" role="button">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Tableau de bord</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" role="button">
                        <i class="ri-order-play-line"></i> <span data-key="t-dashboards">Réservations</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" role="button">
                        <i class="ri-wallet-2-line"></i> <span data-key="t-dashboards">Paiements</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link " href="#" role="button">
                        <i class="ri-bank-card-2-line"></i> <span data-key="t-dashboards">États financiers</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Services</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.categorie' ? 'active' : '' }}" href="{{route('dashboard.categorie') }}" role="button">
                        <i class="ri-list-settings-line"></i> <span data-key="t-dashboards">Catégorie</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.marque' ? 'active' : '' }}" href="{{route('dashboard.marque') }}" role="button">
                        <i class="ri-list-settings-line"></i> <span data-key="t-dashboards">Marques</span>
                    </a>
                </li> <!-- end Dashboard Menu --> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link " href="#" role="button">
                        <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-dashboards">Services</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.users' ? 'active' : '' }}" href="{{ route('dashboard.users') }}" role="button">
                        <i class="ri-user-line"></i> <span data-key="t-dashboards">Utilisateurs</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Paramètres système</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.roles-menu' ? 'active' : '' }}" href="{{ route('dashboard.roles-menu') }}" role="button">
                        <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-dashboards">Gestions des droits</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.admins' ? 'active' : '' }}" href="{{ route('dashboard.admins') }}" role="button">
                        <i class="ri-user-line"></i> <span data-key="t-dashboards">Administartateur</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.avis' ? 'active' : '' }}" href="{{ route('dashboard.avis') }}" role="button">
                        <i class="ri-share-box-line"></i> <span data-key="t-dashboards">Avis</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.temoignage' ? 'active' : '' }}" href="{{ route('dashboard.temoignage') }}" role="button">
                        <i class="ri-chat-quote-line"></i> <span data-key="t-dashboards">Témoignages</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" role="button">
                        <i class="ri-clipboard-line"></i> <span data-key="t-dashboards">Slide</span>
                    </a>
                </li> --}}


                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.terms'  }}" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                        <i class="ri-compasses-2-line"></i> <span data-key="t-icons">Privacy</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarIcons">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.terms') }}" class="nav-link {{ Route::currentRouteName() == 'dashboard.terms' ? 'active' : '' }}" data-key="t-remix">Terms & Conditions</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('dashboard.contacts') ? 'active' : ''}}" href="{{ route('dashboard.contacts') }}">
                        <i class=" ri-shield-user-fill"></i> <span data-key="t-widgets">Nous contacter</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="/">
                        <i class="ri-home-4-line"></i> <span data-key="t-widgets">Allez au site</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('deconnexion')  }}">
                        <i class="ri-logout-box-r-line"></i> <span data-key="t-widgets">Déconnexion</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
