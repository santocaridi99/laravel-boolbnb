@extends('layouts.app')

@section('content')
  <div class="container ap_show">

    <div class="d-flex justify-content-between align-items-center my-3">
      {{-- title --}}
      <h1 class="text-center text-white fw-bold mt-4">I miei alloggi</h1>
      
      {{-- back button --}}
      <div>
        <a class="button_back btn d-flex align-items-center px-4" href="{{ route('host.apartments.index') }}">
          <img class="ps-2" src="/img/frecce.svg" alt=""> Torna indietro 
        </a>
      </div>
    </div>

    <div class="card position-relative py-3">
      {{-- edit button --}}
      <div class="edit_container position-absolute">
        <a class="btn rounded-circle edit_btn d-block" type="button"
          href="{{ route('host.apartments.edit', $apartment->slug) }}" title="Modifica appartamento">
          <i class="fa-solid fa-pen-to-square"></i>
        </a>
      </div>

      {{-- ROW --}}
      <div class="row g-0">

        <div class="col-lg-5 col-md-12 col-sm-12 text-center py-2">
          {{-- ap title --}}
          <h2 class="mt-2 mb-3 fw-bold">{{$apartment->title}}</h2>

          {{-- img --}}
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
        
        <div class="col-lg-7 col-md-12 col-sm-12 text-white ps-4 d-flex flex-column justify-content-center">
          <h3 class="op">Immagini relative all'appartamento:</h3>

          <div class="row p-2 mb-3">
            @foreach ($apartment->images as $item)
              <div class="col-lg-3 col-md-4 col-sm-4 pe-1">
                <img class="h-100 w-100 rounded" src="{{ asset('image/' . $item->images) }}" alt="" class="post-img">
              </div>
            @endforeach
          </div>

          <h3 class="op">Indirizzo:</h3>
          <div class="d-flex">
            <ul class="p-0 m-0">
              <li>{{$apartment->streetAddress}}</li>
              <li>{{$apartment->province}}, {{$apartment->region}}</li>
              <li>{{$apartment->country}}</li>
              @if($apartment->isVisible)
                <li class="mt-5">visibile <i class="text-success fas fa-check-circle"></i></li>
              @else 
                <li class="mt-5">non visibile <i class="text-danger fas fa-times-circle"></i></li>
              @endif
            </ul>
            
          </div>
        </div>
          <div class="stats m-5">
            <svg
              class="progress-ring"
              width="120"
              height="120">
              <circle
                class="progress-ring__circle"
                stroke="white"
                stroke-width="5"
                fill="#ff6333"
                r="52"
                cx="60"
                cy="60"/>
            </svg>

            <div class="text-white">
              <div> Numero totale</div>
              <span>di visualizzazioni ricevute: </span>
              <input
                id='input'
                class="statsinput"
                value="{{$apartment->views}}"
                type="number"
                step="5"
                min="0"
                max="100"
                placeholder="progress"
                disabled
              >
            </div>
          </div>
          <div class="messages_box">
            <h3 class="ps-4">Messaggi:</h3>
            @foreach ($messages as $message)
              <div class="col-md-8">
                <p class="ps-4">{{$message->email}} : {{$message->content}} - {{$message->created_at}}</p>  
              </div>
            @endforeach
          </div>
      </div>
    </div>
  </div>
@endsection