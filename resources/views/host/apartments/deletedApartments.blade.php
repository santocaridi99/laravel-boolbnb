@extends('layouts.app')

@section('content')
    <div class="container back_ap">
        <h1 class="text-center text-white fw-bold mt-4">Appartamenti cancellati</h1>

        <div class="row justify-content-center">
            <div class="col-10 mt-3">
                {{-- back button --}}
                <div class="me-auto my-3">
                    <a class="text-white" href="{{ route('host.apartments.index') }}">
                        <button class="d-flex align-items-center px-4 button_back">
                            <img class="ps-2" src="/img/frecce.svg" alt=""> Torna indietro
                        </button>
                    </a>
                </div>

                {{-- APARTMENTS CARDS --}}
                @foreach ($apartments as $apartment)
                <div class="ap_card bg-light rounded mx-3 mb-5">
                    <div class="row g-0">
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex align-items-center blk_op_bg">
                            @if ($apartment->cover)
                                <img class="w-100 rounded obj_fit show_img" src="{{ asset('storage/' . $apartment->cover) }}" alt="" />
                            @else
                                <img class="w-100 rounded obj_fit show_img" src="https://via.placeholder.com/1024x480" alt="" />
                            @endif
                        </div>
        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="ap_body">
                                {{-- titolo --}}
                                <div
                                    class="d-flex justify-content-between align-items-center flex-wrap py-3 px-3 w-100 blk_op_bg">
        
                                    <div class="ap_title me-2 ms-3 text-break">
                                        <h2 class="fw-bold white_font">{{$apartment->title}}</h2>
        
                                        <p class="text-white mb-3 op f_12">
                                            <i class="fas fa-map-marker-alt me-1"></i> {{$apartment->streetAddress}}
                                        </p>
        
                                        <small class="text-white">
                                            @if ($apartment->room_numbers === 1)
                                            {{$apartment->room_numbers}} stanza &#10022;
                                            @else
                                            {{$apartment->room_numbers}} stanze &#10022;
                                            @endif
        
                                            @if ($apartment->bed_numbers === 1)
                                            {{$apartment->bed_numbers}} camera da letto &#10022;
                                            @else
                                            {{$apartment->bed_numbers}} camere da letto &#10022;
                                            @endif
        
                                            @if ($apartment->bathroom_numbers === 1)
                                            {{$apartment->bathroom_numbers}} bagno &#10022;
                                            @else
                                            {{$apartment->bathroom_numbers}} bagni &#10022;
                                            @endif
        
                                            {{$apartment->square_meters}} mq
                                        </small>
                                    </div>
        
                                    {{-- BUTTONS --}}
                                    <div class="d-flex mx-4 i_buttons">
                                        {{-- form delete --}}
                                        <div class="ms-3">
                                            <form action="{{ route('host.apartments.destroy', $apartment->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method("delete")
                                                <button type="submit" class="dng_btn p-0 border-0 transparent_bg">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>  
                                        </div>

                                        {{-- restore --}}
                                        <div class="ms-3">
                                            <a class="restore_btn" type="button"
                                                href="{{ route('host.apartments.restoreApartment', $apartment->id) }}">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
        
                                {{-- tags --}}
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center border px-4 py-4 mt-3 tags_container">
                                    {{-- icons --}}
                                    @foreach ($apartment->tags as $tag)
                                    <img class="mx-3" src="{{$tag->icon}}" alt="{{$tag->name}}" title="{{$tag->name}}">
                                    @endforeach
                                </div>
        
                                {{-- descrizione --}}
                                <div class="col-lg-12 col-md-12 col-sm-12 text-break p-3">
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
        
            </div>
        </div>
    </div>
    
    <script>
        const form=document.querySelector(".delete")
        form.addEventListener("submit", function(event) {
          event.preventDefault();
    
        const result = confirm("Are you sure?");
    
        if (result) {
            form.submit();
          }
        });
    </script>

    @endsection

   
