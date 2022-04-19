@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>Appartamenti cancellati</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($apartments as $apartment)
                    <div class="card p-2 my-3">
                        <p class="text-uppercase"><a href="{{ route('host.apartments.show', $apartment->slug) }}">{{ $apartment->title }}</a></p>
                        @if ($apartment->cover)
                        <img class="img-fluid" src="{{ asset('storage/' . $apartment->cover) }}" alt="" class="post-img">
                        @else
                        <img class="img-fluid" src="https://via.placeholder.com/1024x480" alt="" class="img-fluid">
                        @endif
                        <p>{{ $apartment->description}}</p>
                        
                        {{-- buttons --}}
                        <div class="ms-auto">
                            {{-- form --}}
                            <form action="{{ route('host.apartments.destroy', $apartment->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Elimina
                                </button>
                            </form>
                            <a class="ms-auto btn btn-outline-success btn-sm" href="{{ route('host.apartments.restoreApartment', $apartment->id) }}">Restore</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection