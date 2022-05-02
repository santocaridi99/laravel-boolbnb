@extends('layouts.app')

@section('content')
<div class="container register_container">

    <div class="row justify-content-center mt_150 mb_200">
        <div class="col-md-8">
            <div class="register_card blk_font b_r">
                <div class="row g-0">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="title text-center mt-5 mb-4">
                            <h2 class="fw-bold pink_font">
                                {{ __('Register') }}
                            </h2>
                        </div>

                        <div class="card_content px-5 pb-5">
                            <form method="POST" action="{{ route('register') }}" id="registerForm">
                                @csrf

                                {{-- nome --}}
                                <div class="form-group mb-2">
                                    <label for="name" class="">{{ __('Name') }}*</label>
                    
                                    <div class="">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" data-parsley-pattern="[a-zA-Z]+$"
                                            data-parsley-length='[2,100]' data-parsley-trigger='change' autofocus>
                    
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                {{-- cognome --}}
                                <div class="form-group mb-2">
                                    <label for="lastname" class="">{{ __('Lastname')
                                        }}*</label>
                    
                                    <div class="">
                                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror"
                                            name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                                            data-parsley-pattern="[a-zA-Z]+$" data-parsley-length='[2,100]' data-parsley-trigger='change'
                                            autofocus>
                    
                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                {{-- data di nascita --}}
                                <div class="form-group mb-2">
                                    <label for="birth_date" class="">{{ __('Birth date')
                                        }}*</label>
                    
                                    <div class="">
                                        <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                            name="birth_date" data-parsley-type="date" required autocomplete="birth_date"
                                            data-parsley-required-message="inserisci una data " data-parsley-trigger='change' autofocus>
                    
                                        @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong> Devi essere maggiorenne!</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                {{-- email --}}
                                <div class="form-group mb-2">
                                    <label for="email" class="">{{ __('E-Mail Address')
                                        }}*</label>
                    
                                    <div class="">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email" data-parsley-type="email"
                                            data-parsley-trigger='change'>
                    
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- password --}}
                                <div class="form-group mb-2">
                                    <label for="password" class="">{{ __('Password')
                                        }}*</label>
                    
                                    <div class="">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password" data-parsley-length='[8,16]'
                                            data-parsley-trigger='change'>
                    
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- password 2 --}}
                                <div class="form-group mb-2">
                                    <label for="password-confirm" class="">{{ __('Confirm
                                        Password') }}*</label>
                    
                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                            required autocomplete="new-password" data-parsley-equalto="#password"
                                            data-parsley-trigger="keyup">
                                    </div>
                                </div>
                                

                                {{-- BUTTONS --}}
                                <div class="form-group mb-2 mt-4 text-center">
                                    <div class="text-center mb-4">
                                        <button type="submit" class="w-100 rounded px-4 pink_custom save register_button">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 

                    {{-- img --}}
                    <div class="col-lg-6 side_col">
                        <div class="w-100 h-100 b_bottom_top op_9 side_img">
                            {{-- <img class="bg-fluid b_bottom_top" src="https://cdn.dribbble.com/users/3562273/screenshots/12301613/media/46bf05eb6571d78629285638e8da8e41.jpg" height="850" alt=""> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection