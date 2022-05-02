@extends('layouts.app')

@section('content')
<div class="container login_container">

    <div class="row justify-content-center mt_150 mb_200">
        <div class="col-md-8">
            <div class="login_card blk_font b_r">
                <div class="row g-0">
                    <div class="col-lg-6 col-md-12 col-sm-12">

                        <div class="title text-center mt-5 mb-4">
                            <h2 class="fw-bold pink_font">
                                {{ __('Login') }}
                            </h2>
                        </div>

                        <div class="card_content px-5 pb-5">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                {{-- email --}}
                                <div class="form-group mb-2">
                                    <label for="email" class="">{{ __('E-Mail Address') }}</label>

                                    <div class="">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- password --}}
                                <div class="form-group mb-2">
                                    <label for="password" class="">{{ __('Password') }}</label>

                                    <div class="">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- remember me --}}
                                <div class="form-group">
                                    <div class="">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- BUTTONS --}}
                                <div class="form-group mb-2 mt-4">
                                    <div class="">
                                        <div class="text-center mb-4">
                                            <button type="submit" class="w-100 rounded px-4 pink_custom save login_button">
                                                {{ __('Login') }}
                                            </button>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <div class="forgot_button">
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- img --}}
                    <div class="col-lg-6 side_col">
                        <div class="w-100 h-100 op_9 b_bottom_top side_img">
                            {{-- <img class="bg-fluid b_bottom_top"
                                src="https://cdn.dribbble.com/users/3562273/screenshots/12301613/media/46bf05eb6571d78629285638e8da8e41.jpg"
                                height="850" alt=""> --}}

                            {{-- <img class="w-100 obj_fit" src="https://cdn.dribbble.com/userupload/2558786/file/original-3502ac7a92aceaef0c05482084aab461.png?filters:format(webp)?filters%3Aformat%28webp%29=&compress=1&resize=2400x1920" alt=""> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
