@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<li class="nav-item dropdown user-menu">
    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if(config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}"
                class="user-image w-8 h-8 rounded-full object-cover"
                alt="{{ Auth::user()->name }}">
        @endif
        <span class="@if(config('adminlte.usermenu_image')) hidden md:inline-block ml-2 @endif">
            {{ Auth::user()->name }}
        </span>
    </a>

    {{-- User menu dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        {{-- User menu header --}}
        @if(!View::hasSection('usermenu_header') && config('adminlte.usermenu_header'))
            <li class="user-header {{ config('adminlte.usermenu_header_class', 'bg-primary') }}
                @if(!config('adminlte.usermenu_image')) h-auto @endif py-4">
                @if(config('adminlte.usermenu_image'))
                    <img src="{{ Auth::user()->adminlte_image() }}"
                        class="img-circle w-20 h-20 mx-auto mb-3 object-cover"
                        alt="{{ Auth::user()->name }}">
                @endif
                <p class="@if(!config('adminlte.usermenu_image')) mt-0 @endif text-center">
                    <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                    @if(config('adminlte.usermenu_desc'))
                        <small class="block text-white/80">{{ Auth::user()->adminlte_desc() }}</small>
                    @endif
                </p>
            </li>
        @else
            @yield('usermenu_header')
        @endif

        {{-- Configured user menu links --}}
        @each('adminlte::partials.navbar.dropdown-item', $adminlte->menu("navbar-user"), 'item')

        {{-- User menu body --}}
        @hasSection('usermenu_body')
            <li class="user-body">
                @yield('usermenu_body')
            </li>
        @endif

        {{-- User menu footer --}}
        <li class="user-footer flex justify-between p-2">
            @if($profile_url)
                <a href="{{ $profile_url }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
                    <i class="fa fa-fw fa-user text-blue-500 mr-2"></i>
                    {{ __('adminlte::menu.profile') }}
                </a>
            @endif
            <a class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors
                @if(!$profile_url) w-full justify-center @endif"
                href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off text-red-500 mr-2"></i>
                {{ __('adminlte::adminlte.log_out') }}
            </a>
            <form id="logout-form" action="{{ $logout_url }}" method="POST" class="hidden">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>

<style>
    /* Estilos específicos para el dropdown */
    .dropdown-menu {
        min-width: 280px !important;
        padding: 0.5rem 0 !important;
        margin: 0.125rem 0 0 !important;
        border: 1px solid rgba(0,0,0,0.15) !important;
        border-radius: 0.375rem !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }

    .dropdown-menu.show {
        display: block !important;
    }

    .user-header {
        position: relative;
        padding: 1rem !important;
        background-size: cover !important;
    }

    .user-header img {
        border: 3px solid rgba(255,255,255,0.8) !important;
    }

    .user-footer {
        border-top: 1px solid #dee2e6;
    }

    /* Corregir posición del dropdown */
    .dropdown-menu-right {
        right: 0 !important;
        left: auto !important;
    }

    /* Mejorar la apariencia del toggle */
    .nav-link.dropdown-toggle {
        display: flex !important;
        align-items: center !important;
        padding: 0.5rem 1rem !important;
    }

    /* Asegurar que la imagen de usuario esté bien posicionada */
    .user-image {
        margin-right: 0.5rem;
    }
</style>
