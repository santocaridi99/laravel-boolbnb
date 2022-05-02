@extends('layouts.app')

@section('content')
<div class="container login_container">

    <div class="row justify-content-center mt_150 mb_200">
        <div class="col-md-8">
            <div class="login_card blk_font b_r">
                <div class="row g-0">
                    <div class="col-lg-6 col-md-12 col-sm-12">

                        <div class="card_content px-5 pb-5">
                            <div class="card-body background_logout">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <p class="mt-5 pink_font"> <em> {{ __('You are logged in!') }} </em></p>

                                <h2>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h2>
                                <div class="mb-5">{{ Auth::user()->email }}</div>

                                <div class="text-center">
                                    <a class="badge dropdown-item pink_custom log_red p-3" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- img --}}
                    <div class="col-lg-6 side_col">
                        <div class="w-100 h-100 op_9 b_bottom_top side_img">
                            {{-- <img class="bg-fluid b_bottom_top"
                                src="https://cdn.dribbble.com/users/3562273/screenshots/12301613/media/46bf05eb6571d78629285638e8da8e41.jpg"
                                height="850" alt=""> --}}

                            {{-- <img class="w-100 obj_fit"
                                src="https://cdn.dribbble.com/userupload/2558786/file/original-3502ac7a92aceaef0c05482084aab461.png?filters:format(webp)?filters%3Aformat%28webp%29=&compress=1&resize=2400x1920"
                                alt=""> --}}
                        </div>
                    </div>


                </div>
            </div>
        </div>
        @endsection




        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">

                    <div class="card-body background_logout">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <p class="mt-5 pink_font"> <em> {{ __('You are logged in!') }} </em></p>

                        <h2>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h2>
                        <div class="mb-5">{{ Auth::user()->email }}</div>

                        <div class="text-center">
                            <a class="badge dropdown-item pink_custom log_red" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{--
        </div>
        @endsection --}}