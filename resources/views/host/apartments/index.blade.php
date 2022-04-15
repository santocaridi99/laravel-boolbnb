@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>I miei appartamenti</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <a class="p-2" href="{{ route('host.apartments.create') }}">Crea un nuovo appartamento</a>
                        <a class="btn btn-link ms-auto" href="{{ route('host.apartments.deletedApartments')}}">Cestino</a>
                    </div>
                    @foreach ($apartments as $apartment)
                        <div class="card p-2 my-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-uppercase align-self-center"><a href="{{ route('host.apartments.show', $apartment->slug) }}">{{ $apartment->title}}</a></p>
                                {{-- form che permette di soft deletare un post--}}
                                <form action="{{ route('host.apartments.softDeleteApartment', $apartment->id) }}" method="POST" class="d-inline-block ms-auto">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-outline-danger btn-sm mb-2">
                                        Elimina appartamento
                                    </button>
                                </form>
                            </div>
                            @if ($apartment->cover)
                                <img class="img-fluid rounded" src="{{ asset('storage/' . $apartment->cover) }}" alt="" class="post-img">
                            @else
                                <img class="img-fluid" src="https://via.placeholder.com/1024x480" alt="" class="img-fluid">
                            @endif
                            <p>Descrizione:</p>
                            <p>{{ $apartment->description}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection