@extends('layouts.app')

@section('content')
  <div class="container ap_show">

    <div class="d-flex justify-content-between align-items-center my-3">
      {{-- back button --}}
      <div>
        <a class="button_back btn d-flex align-items-center px-4" href="{{ route('host.apartments.index') }}">
          Torna indietro <img class="ps-2" src="/img/frecce.svg" alt="">
        </a>
      </div>
    </div>

    <div class="rounded p-3 mt-4 blk_op_bg">
      <div class="card position-relative">
        {{-- edit button --}}
        <div class="edit_container position-absolute">
          <a class="btn rounded-circle edit_btn d-block" type="button"
            href="{{ route('host.apartments.edit', $apartment->slug) }}" title="Modifica appartamento">
            <i class="fa-solid fa-pen-to-square"></i>
          </a>
        </div>

        {{-- ROW --}}
        <div class="row g-0">

          <div class="col-lg-5 text-center py-2">
            {{-- ap title --}}
            <h2 class="mt-2 mb-3 fw-bold">{{$apartment->title}}</h2>

            {{-- img --}}
            <img class="img-fluid mb-2 rounded max_450" src="{{ asset('storage/' . $apartment->cover) }}" alt="" class="post-img">
          </div>
          
          <div class="col-lg-7 text-white mt-5 py-5">
            <h3 class="op">Immagini relative all'appartamento:</h3>

            <div class="row p-2 mb-3">
              @foreach ($apartment->images as $item)
                <div class="col-md-3">
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

        </div>
      </div>
    </div>

  </div>
@endsection