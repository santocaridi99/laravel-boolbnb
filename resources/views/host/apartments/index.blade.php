@extends('layouts.app')

@section('content')
<div class="container back_ap">
    {{-- search bar --}}
    <div class="search_container text-center mb-3">
        <input type="text" class="search_bar ps-3 text-white" placeholder="Cerca tra i tuoi alloggi">
        <button class="button_search_bar text-white"><i class="fas fa-search"></i></button>
    </div>

    <h1 class="text-center text-white fw-bold">I miei alloggi</h1>

    <div class="row justify-content-center">
        <div class="col-10">
            <div class="d-flex align-items-center">
                {{-- create --}}
                <a class="btn btn-link" href="{{ route('host.apartments.create') }}"
                    title="Aggiungi un nuovo appartamento">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none">
                        <style>
                            @keyframes bounce {
                                0% {
                                    transform: scale3d(1, 1, 1)
                                }

                                30% {
                                    transform: scale3d(1.25, .75, 1)
                                }

                                40% {
                                    transform: scale3d(.75, 1.25, 1)
                                }

                                50% {
                                    transform: scale3d(1.15, .85, 1)
                                }

                                65% {
                                    transform: scale3d(.95, 1.05, 1)
                                }

                                75% {
                                    transform: scale3d(1.05, .95, 1)
                                }
                            }
                        </style>
                        <path fill="#FF385C" fill-rule="evenodd"
                            d="M12.75 8.744a.75.75 0 00-1.5 0v2.506H8.744a.75.75 0 000 1.5h2.506v2.506a.75.75 0 001.5 0V12.75h2.506a.75.75 0 000-1.5H12.75V8.744z"
                            clip-rule="evenodd"
                            style="animation:bounce 1s 1s infinite both;transform-origin:center center" />
                        <rect width="16" height="16" x="4" y="4" stroke="#FF385C" stroke-width="1.5" rx="2.075" />
                    </svg>
                    {{-- <span class="text-white">Aggiungi un nuovo appartamento</span> --}}
                </a>
                {{-- trash bin --}}
                <a class="btn btn-link ms-auto" href="{{ route('host.apartments.deletedApartments')}}" title="Cestino">
                    {{-- <span class="text-white">Cestino</span> --}}
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="none">
                        <style>
                            @keyframes rotate-tr {
                                0% {
                                    transform: rotate(0)
                                }

                                to {
                                    transform: rotate(20deg)
                                }
                            }
                        </style>
                        <path fill="#FFF"
                            d="M16.773 10.083a.75.75 0 00-1.49-.166l1.49.166zm-1.535 7.027l.745.083-.745-.083zm-6.198 0l-.745.083.745-.083zm-.045-7.193a.75.75 0 00-1.49.166l1.49-.166zm5.249 7.333h-4.21v1.5h4.21v-1.5zm1.038-7.333l-.79 7.11 1.491.166.79-7.11-1.49-.166zm-5.497 7.11l-.79-7.11-1.49.166.79 7.11 1.49-.165zm.249.223a.25.25 0 01-.249-.222l-1.49.165a1.75 1.75 0 001.739 1.557v-1.5zm4.21 1.5c.892 0 1.64-.67 1.74-1.557l-1.492-.165a.25.25 0 01-.248.222v1.5z" />
                        <path fill="#EDB900" fill-rule="evenodd"
                            d="M11 6a1 1 0 00-1 1v.25H7a.75.75 0 000 1.5h10a.75.75 0 000-1.5h-3V7a1 1 0 00-1-1h-2z"
                            clip-rule="evenodd"
                            style="animation:rotate-tr 1s cubic-bezier(1,-.28,.01,1.13) infinite alternate-reverse both;transform-origin:right center" />
                    </svg>
                </a>
            </div>

            {{-- APARTMENTS CARDS --}}
            <div class="rounded p-3 blk_op_bg">
                @foreach ($apartments as $apartment)
                <div class="card m-3">
                    <div class="row g-0">
                        <div class="col-md-4 col-sm-4 d-flex align-items-center">
                            @if ($apartment->cover)
                                <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="w-100">
                                    <img 
                                        class="w-100 w_300 rounded obj_fit"
                                        src="{{ asset('storage/' . $apartment->cover) }}"
                                        alt=""
                                    />
                                </a>
                            @else
                                <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="w-100">
                                    <img 
                                        class="w-100 w_300 rounded obj_fit"
                                        src="https://via.placeholder.com/1024x480"
                                        alt=""
                                    />
                                </a>
                            @endif
                        </div>

                        <div class="col-md-8 col-sm-8">
                            <div class="card-body p-0">
                                {{-- titolo e buttons --}}
                                <div class="d-flex flex-wrap mb-3">
                                    <div class="row g-0 w-100 mt-3">

                                        <div class="col-lg-9 col-md-9 col-sm-6 d-flex align-items-center">
                                            <h3 class="card-title fw-bold me-2 ms-3">
                                                <a href="{{ route('host.apartments.show', $apartment->slug) }}">{{$apartment->title}}</a>
                                            </h3>
                                        </div>
                                        

                                        <div class="col-lg-3 col-md-3 col-sm-6 d-flex justify-content-center align-items-center">
                                            {{-- edit button --}}
                                            <span class="ms-2">
                                                <a class="btn rounded-circle edit_btn" type="button"
                                                    href="{{ route('host.apartments.edit', $apartment->slug) }}"
                                                    title="Modifica appartamento">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </span>

                                            {{-- form che permette di soft deletare un post--}}
                                            <span class="ms-2">
                                                <form
                                                    action="{{ route('host.apartments.softDeleteApartment', $apartment->id) }}"
                                                    method="POST" class="d-inline-block ms-auto">
                                                    @csrf
                                                    @method("delete")

                                                    <button type="submit" class="btn rounded-circle dng_btn"
                                                        title="Elimina appartamento">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- descrizione --}}
                                <p class="card-text lh-base text-white px-4 op font-monospace overflow-auto h_100">
                                    {{$apartment->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection