<nav class="fixed-top custom_nav d-flex align-items-center p-4 back_nav">
    <!-- Navbar -->
    <a class="navbar-brand" href="{{ url('/') }}"><img src="/img/boolbnb.svg" alt=""></a>

    <ul class="custom_link d-flex align-items-center" v-if="user">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
            <a class="nav-link blk_font log_b" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link blk_font log_b" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown text-center ms-3 log_a">
            <a class="nav-link blk_font log_a" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
        
                <span class="align-middle me-1 fs-5 blk_font">
                    <i class="fas fa-user-circle"></i>
                </span>
        
                {{-- username --}}
                <span class="">
                    {{ Auth::user()->name }}
        
                    {{-- user arrow --}}
                    <i class="fas fa-angle-down"></i>
                    {{-- <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                        <style>
                            @keyframes slide-1 {
                                to {
                                    transform: translateY(2px)
                                }
                            }
                        </style>
                        <g style="animation:slide-1 1s infinite alternate both cubic-bezier(1,-.01,0,.98)">
                            <path fill="#111"
                                d="M11.773 7.142a.75.75 0 011.5 0h-1.5zm1.5 4.09v.75h-1.5v-.75h1.5zm0-4.09v4.09h-1.5v-4.09h1.5z" />
                            <path stroke="#FF6332" stroke-width="1.5"
                                d="M12.91 15.915l2.143-2.87a.476.476 0 00-.382-.762l-4.295.012a.479.479 0 00-.382.765l2.152 2.858c.19.253.572.254.763-.003z" />
                        </g>
                    </svg> --}}
                </span>
            </a>
        
            <ul class="dropdown-menu position-absolute" aria-labelledby="navbarDropdownMenuLink">
                <li class="text-center">
                    <a class="dropdown-item bg-white log_red" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
        
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        @endguest
    </ul>
</nav>