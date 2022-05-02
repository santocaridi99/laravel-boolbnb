@extends('layouts.app')

@section('content')
<div class="container back_ap">
    {{-- search bar --}}
    {{-- <div class="search_container text-center mb-3">
        <input type="text" class="search_bar ps-3 text-white" placeholder="Cerca tra i tuoi alloggi">
        <button class="button_search_bar text-white"><i class="fas fa-search"></i></button>
    </div> --}}

    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12 col-sm-12 mt-3">
            
            <h1 class="text-start text-white fw-bold f_45">I miei alloggi</h1>

            @if(count($apartments))
                <div class="d-flex justify-content-center mb-3 mt_50">
                    {{-- create --}}
                    <div class="create_box">
                        <a class="create_svg" href="{{ route('host.apartments.create') }}">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="39" height="39" fill="none">
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
                        </a>
                        <div class="create_slide text-white">Aggiungi un nuovo appartamento</div>
                    </div>
                    
                    {{-- trash bin --}}
                    <a class="ms-auto" href="{{ route('host.apartments.deletedApartments')}}" title="Cestino">
                        <span class="text-white align-middle bin_text f_18 op_7">Cestino</span>
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none">
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
            @endif

            {{-- APARTMENTS CARDS --}}
            @if(!count($apartments))
                <div class="text-center create_empty my_300">
                    <h3 class="text-white mb-5 f_35 op_9">Non hai ancora caricato il tuo appartamento?</h3>
                    <a href="{{ route('host.apartments.create') }}" class="px-4 py-3 pink_custom text-white f_18">Crea ora il tuo primo annuncio!</a>
                </div>
            @else
                @foreach ($apartments as $apartment)
                <div class="ap_card bg-light rounded mx-3 mb-5">
                    <div class="row g-0">
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex align-items-center blk_op_bg">
                            @if ($apartment->cover !== 'cover')
                                <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="w-100 ex">
                                    <img 
                                        class="w-100 rounded obj_fit show_img"
                                        src="{{ asset('storage/' . $apartment->cover) }}"
                                        alt=""
                                    />
                                </a>
                            @else
                                <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="w-100">
                                    <img 
                                        class="w-100 rounded obj_fit show_img"
                                        src="https://fakeimg.pl/800x600/?text=Scarpe"
                                        alt=""
                                    />
                                </a>
                            @endif
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="ap_body">
                                {{-- titolo --}}
                                <div class="d-flex justify-content-between align-items-center flex-wrap p-3 w-100 blk_op_bg">
                                    
                                    <div class="ap_title me-2 ms-3 text-break">
                                        <div class="d-flex">
                                            <h2 class="fw-bold">
                                                <a class="white_font title_a" href="{{ route('host.apartments.show', $apartment->slug) }}">
                                                    {{$apartment->title}}
                                                </a>
                                            </h2>
                                            {{-- isVisible? --}}
                                            <div class="visible_box_top mx-2">
                                                @if($apartment->isVisible)
                                                <small class="badge bg-dark"><i class="me-1 green_font fas fa-check-circle"></i> visibile</small>
                                                @else
                                                <small class="badge bg-dark"><i class="me-1 pink_font fas fa-times-circle"></i> non visibile</small>
                                                @endif
                                            </div>
                                        </div>

                                        <p class="text-white mb-3 ap_address op f_12">
                                            <i class="fas fa-map-marker-alt me-1"></i> {{$apartment->streetAddress}}
                                        </p>

                                        <small class="ap_info text-white">
                                            @if ($apartment->room_numbers === 1)
                                                {{$apartment->room_numbers}} stanza &#10022; 
                                            @else 
                                                {{$apartment->room_numbers}} stanze &#10022;
                                            @endif

                                            @if ($apartment->bed_numbers === 1)
                                            {{$apartment->bed_numbers}} posto letto &#10022;
                                            @else
                                            {{$apartment->bed_numbers}} posti letto &#10022;
                                            @endif

                                            @if ($apartment->bathroom_numbers === 1)
                                            {{$apartment->bathroom_numbers}} bagno &#10022;
                                            @else
                                            {{$apartment->bathroom_numbers}} bagni &#10022;
                                            @endif

                                            {{$apartment->square_meters}} mq
                                        </small>

                                        <div class="visible_box_bottom ms-0 mt-2">
                                            @if($apartment->isVisible)
                                            <small class="badge bg-dark"><i class="me-1 green_font fas fa-check-circle"></i> visibile</small>
                                            @else
                                            <small class="badge bg-dark"><i class="me-1 pink_font fas fa-times-circle"></i> non visibile</small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    {{-- BUTTONS --}}
                                    <div class="d-flex ms-4 i_buttons">
                                        {{-- edit button --}}
                                        <div class="">
                                            <a class="edit_btn" type="button"
                                                href="{{ route('host.apartments.edit', $apartment->slug) }}"
                                                title="Modifica appartamento">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </div>

                                        {{-- form che permette di soft deletare un post--}}
                                        <div class="ms-3">
                                            <form
                                                action="{{ route('host.apartments.softDeleteApartment', $apartment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method("delete")

                                                <button type="submit" class="dng_btn p-0 border-0 transparent_bg"
                                                    title="Elimina appartamento">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- tags --}}
                                <div class="pd">
                                    <div class="d-flex justify-content-center flex-wrap border px-4 py-4 mt-3 tags_container">
                                        {{-- icons --}}
                                        @foreach ($apartment->tags as $tag)
                                            <img class="mx-3" src="{{$tag->icon}}" alt="{{$tag->name}}" title="{{$tag->name}}">

                                            <div class="badge m-1 blk_op_bg">{{$tag->name}}</div>
                                        @endforeach
                                    </div> 
                                </div>
                                

                                {{-- descrizione --}}
                                <div class="text-break p-3 description">
                                    <h5 class="px-3">
                                        Su questo annuncio:
                                    </h5>
                                    <p class="ap_text font-monospace lh-base overflow-hidden mb-0 px-3 h_100 op_9">
                                        {{$apartment->description}}
                                    </p> 
                                </div>
                                                            
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

        </div>
    </div>

</div>
@endsection