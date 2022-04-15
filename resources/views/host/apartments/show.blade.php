@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 card p-2">
        <div class="d-flex justify-content-between">
          <span class="text-uppercase"><a href="{{ route('host.apartments.index') }}">< Torna indietro</a></span>
          <span class="text-uppercase"><a href="{{ route('host.apartments.edit', $apartment->slug) }}">Modifica</a></span>
        </div>
        <img class="img-fluid mb-2 rounded" src="{{ asset('storage/' . $apartment->cover) }}" alt="" class="post-img">
        <h3>Immagini relative all'appartamento:</h3>
        <div class="row p-2">
          @foreach ($apartment->images as $item)
            <div class="col-md-2">
              <img class="img-fluid rounded" src="{{ asset('image/' . $item->images) }}" alt="" class="post-img">
            </div>
          @endforeach
        </div>
        <h3>Titolo</h3>
        <h4>{{$apartment->title}}</h4>
        <h3>Indirizzo:</h3>
        <div class="d-flex">
          <p class="me-2">{{$apartment->post_code}}</p>
          <p class="me-2">{{$apartment->province}}</p>
          <p class="me-2">{{$apartment->city}}</p>
          <p class="me-2">{{$apartment->address}}</p>
          <p class="me-2">{{$apartment->street_number}}</p>
        </div>
      </div>
    </div>
  </div>
@endsection