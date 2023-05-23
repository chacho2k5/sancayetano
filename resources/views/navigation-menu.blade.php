<nav class="bg-white navbar navbar-expand-md navbar-light border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand me-4" href="/dashboard">
            <x-application-mark width="36" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar  {{ route('dashboard') }}-->
            <ul class="navbar-nav me-auto">
                {{-- <x-nav-link href="/" :active="request()->routeIs('dashboard')">
                   .
                </x-nav-link> --}}
                {{-- <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    Archivos
                </x-nav-link> --}}
                @role('admin')
                <x-dropdown id="settingsDropdown">
                    <x-slot name="trigger">
                        Archivos 
                        {{-- <i class="px-1 mt-1 float-end fa-solid fa-sort"></i> --}}
                        <i class="px-2 mt-0 float-end fa-solid fa-sort-down"></i>
                        {{-- <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg> --}}

                     <!--   {{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @else
                            {{ Auth::user()->name }}-->

                            <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                      <!--  @endif --}}-->
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <x-dropdown-link href="{{ route('clientes.index') }}">
                            Clientes
                        </x-dropdown-link>

                        <x-dropdown-link href="{{ route('clientes.index') }}">
                            Empleados
                        </x-dropdown-link>

                        <hr class="dropdown-divider">
                        <x-dropdown-link href="{{ route('dashboard') }}">
                            Cortadoras
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('dashboard') }}">
                            Extrusoras
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('dashboard') }}">
                            Impresoras
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('dashboard') }}">
                            Materiales
                        </x-dropdown-link>

                    </x-slot>
                </x-dropdown>
                @endrole

                @auth()
                {{-- <x-nav-link href="{{ route('ots.ot') }}" :active="request()->routeIs('ots.ot')"> --}}
                    <x-nav-link href="{{ route('pedidos.index') }}">
                    PEDIDOS
                </x-nav-link>

                {{-- <x-nav-link href="{{ route('cambiarestados.index') }}" :active="request()->routeIs('ots.ot')"> --}}
                    <x-nav-link href="{{ route('trabajos.index') }}">
                    TRABAJOS
                </x-nav-link>

                @endauth
            </ul>

              
           
         <!-- Settings Dropdown 
         <ul class="navbar-nav me-auto">
                {{-- @auth --}}
                    <x-dropdown id="settingsDropdown">
                        <x-slot name="trigger">
                            {{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @else
                                {{ Auth::user()->name }}

                                <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif --}}
                        </x-slot>

                         <x-slot name="content">
                            Account Management 
                            <h6 class="dropdown-header small text-muted">
                                Archivos
                            </h6>

                            <x-dropdown-link href="{{ route('home') }}">
                                Articulos
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('home') }}">
                                Categorias
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('home') }}">
                                Clientes
                            </x-dropdown-link>

                            <hr class="dropdown-divider">
                            <x-dropdown-link href="{{ route('home') }}">
                                Estados
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('home') }}">
                            Empleados
                        </x-dropdown-link> 

                        </x-slot>
                    </x-dropdown>
                {{-- @endauth --}}
                </ul>
        -->


            {{-- Hay que definir la ruta Usuarios y asi mostraria el link de usuarios cdo no estan logueados --}}
            {{--
                 <ul class="navbar-nav me-auto">
                <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                    {{ __('Users') }}
                </x-nav-link>
            </ul> --}}

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav align-items-baseline">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <x-dropdown id="teamManagementDropdown">
                        <x-slot name="trigger">
                            {{ Auth::user()->currentTeam->name }}

                            <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Team Management -->
                            <h6 class="dropdown-header">
                                {{ __('Manage Team') }}
                            </h6>

                            <!-- Team Settings -->
                            <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-dropdown-link>
                            @endcan

                            <hr class="dropdown-divider">

                            <!-- Team Switcher -->
                            <h6 class="dropdown-header">
                                {{ __('Switch Teams') }}
                            </h6>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" />
                            @endforeach
                        </x-slot>
                    </x-dropdown>
                @endif

                <!-- Settings Dropdown -->
                {{-- @auth --}}
                    <x-dropdown id="settingsDropdown">
                        <x-slot name="trigger">
                            {{-- chacho - esto lo muestra si el usuario esta autenticado --}}
                            @auth()
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                @else
                                    {{ Auth::user()->name }}

                                    <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="text-muted">Ingresar</a>
                                {{-- <a href="{{ route('register') }}" class="ms-4 text-muted">Register</a> --}}
                            @endauth
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management 
                            <h6 class="dropdown-header small text-muted">
                              {{ __('Manage Account') }
                            </h6>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                               {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <hr class="dropdown-divider">-->

                            <!-- Authentication -->
                            <x-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Salir del sistema') }}
                            </x-dropdown-link>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </x-slot>
                    </x-dropdown>
                {{-- @endauth --}}
            </ul>
        </div>
    </div>
</nav>
