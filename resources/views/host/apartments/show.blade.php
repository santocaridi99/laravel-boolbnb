@extends('layouts.app')

@section('content')
  <div class="container ap_show">

    <div class="d-flex justify-content-between align-items-center my-3">
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
          <img class="img-fluid w-100 mb-2 rounded max_450" src="{{ asset('storage/' . $apartment->cover) }}" alt="" class="post-img">
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
            </ul>
            
          </div>
        </div>
        <h3>Messaggi:</h3>
        @foreach ($messages as $message)
          <div class="col-md-2">
            {{$message->content}}
          </div>
        @endforeach
      </div>
    </div>

  </div>
@endsection