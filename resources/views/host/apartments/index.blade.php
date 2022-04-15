@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>I miei appartamenti</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="d-flex">
                        <a class="p-2" href="{{ route('host.apartments.create') }}">Crea un nuovo appartamento</a>
                        <a class="btn btn-link ms-auto" href="{{ route('host.apartments.deletedApartments')}}">Cestino</a>
                    </div>
                    @foreach ($apartments as $apartment)
                        <div class="card p-2 my-3">
                            <div>
                                <p class="text-uppercase"><a href="{{ route('host.apartments.show', $apartment->slug) }}">{{ $apartment->title}}</a></p>
                                {{-- form che permette di soft deletare un post--}}
                                <form action="{{ route('host.apartments.softDeleteApartment', $apartment->id) }}" method="POST" class="d-inline-block ms-auto">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Elimina appartamento
                                    </button>
                                </form>
                            </div>
                            @if ($apartment->cover)
                                <img class="img-fluid" src="{{ asset('storage/' . $apartment->cover) }}" alt="" class="post-img">
                            @else
                                <img class="img-fluid" src="https://via.placeholder.com/1024x480" alt="" class="img-fluid">
                            @endif
                            <p>{{ $apartment->description}}</p>
                            <div class="col-md-12">
                                @foreach ($apartment->images as $item)
                                    <img class="img-fluid" src="{{ asset('image/' . $item->images) }}" alt="" class="post-img">
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection