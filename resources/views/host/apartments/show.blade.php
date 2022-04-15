@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2>Titolo<h1>
        <h3>{{$apartment->title}}</h3>
        <h2>CAP<h1>
        <h3>{{$apartment->post_code}}</H1>
        <p class="text-uppercase"><a href="{{ route('host.apartments.edit', $apartment->slug) }}">Modifica</a></p>
      </div>
    </div>
  </div>
@endsection