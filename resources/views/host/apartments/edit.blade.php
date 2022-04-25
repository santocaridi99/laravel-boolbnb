@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form class="row g-3" id="formid" autocomplete="off" action="{{ route('host.apartments.update',$apartment->id) }}" method="post"
        enctype="multipart/form-data">

        @csrf
        @method('patch')

        {{-- Title --}}
        <div class="col-md-6">
            <label class="form-label">Titolo</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title',$apartment->title) }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Numero di stanze</label>
            <input type="number" name="room_numbers" class="form-control @error('room_numbers') is-invalid @enderror"
                value="{{ old('room_numbers', $apartment->room_numbers)}}">
            @error('room_numbers')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Numero di letti</label>
            <input type="number" name="bed_numbers" class="form-control @error('bed_numbers') is-invalid @enderror"
                value="{{ old('bed_numbers',$apartment->bed_numbers)}}">
            @error('bed_numbers')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Numero di bagni</label>
            <input type="number" name="bathroom_numbers"
                class="form-control @error('bathroom_numbers') is-invalid @enderror"
                value="{{ old('bathroom_numbers',$apartment->bathroom_numbers) }}">
            @error('bathroom_numbers')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Metratura</label>
            <input type="number" name="square_meters" class="form-control @error('square_meters') is-invalid @enderror"
                value="{{ old('square_meters',$apartment->square_meters) }}">
            @error('square_meters')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="col-md-6">
            <label class="form-label">Immagine di copertina</label>
            <input type="file" name='cover' class="form-control @error('cover') is-invalid @enderror">
            <div class="col-3"><img class="img-fluid" src="{{ asset('storage/' . $apartment->cover) }}" alt=""
                    class="post-img"></div>
            @error('cover')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Prezzo per notte</label>
            <input type="number" name="price_per_night"
                class="form-control @error('price_per_night') is-invalid @enderror"
                value="{{ old('price_per_night', $apartment->price_per_night) }}">
            @error('price_per_night')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Paese</label>
            <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                value="{{ old('country', $apartment->country) }}">
            @error('country')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Regione</label>
            <input type="text" name="region" class="form-control @error('region') is-invalid @enderror"
                value="{{ old('region',$apartment->region) }}">
            @error('region')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Provincia</label>
            <input type="text" name="province" class="form-control @error('province') is-invalid @enderror"
                value="{{ old('province' , $apartment->province) }}">
            @error('province')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- <div class="col-md-6">
            <label class="form-label">Via</label>
            <input id='geoAddress' type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                placeholder="Inserisci qui la regione" value="{{ old('street', $apartment->street) }}" required>
            @error('street')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}

        <div class="col-md-6 autocomplete">
            <label class="form-label">Indirizzo completo - (Via civico, CAP Città)</label>
            <input id='geoAddress' type="text" name="streetAddress" class="form-control @error('streetAddress') is-invalid @enderror"
              placeholder="Inserisci qui l'indirizzo" value="{{ old('streetAddress', $apartment->streetAddress) }}" required onkeyup="if (this.value.length > 6) beforeSubmit()">
            @error('streetAddress')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <label class="form-check-label" for="flexCheckDefault">
                L'appartamento è visibile?
            </label>
            <input type="hidden" name='isVisible' value="0">
            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="isVisible" {{
                $apartment->isVisible ? 'checked' : '' }}>
        </div>

        {{-- contenuto del post --}}
        <div class="col-md-12">
            <label>Contenuto</label>
            <textarea name="description" rows="10"
                class="form-control @error('description') is-invalid @enderror">{{ old('description',$apartment->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-2 d-none">
            <label class="form-label">Longitudine</label>
            <input id='longitudeHtml' type="text" name="longitude"
                class=" form-control @error('longitude') is-invalid @enderror" placeholder="longitude" value="{{ old('longitude', $apartment->longitude) }}">
            @error('longitude')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-2 d-none">
            <label class="form-label">Latitudine</label>
            <input id='latitudeHtml' type="text" name="latitude"
                class=" form-control @error('latitude') is-invalid @enderror" placeholder="latitude" value="{{ old('latitude', $apartment->latitude) }}">
            @error('longitude')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Tags</label><br>
            @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('tags') is-invalid @enderror" type="checkbox" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                    name="tags[]" {{$apartment->tags->contains($tag) ? 'checked' : ''}}>
                <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
            </div>
            @endforeach
        </div>
        <label class="m-2">Images</label>
        <input type="file" id="input-file-now-custom-3" class="form-control m-2 @error('images.*') is-invalid @enderror " name="images[]" multiple>
        @error('images.*')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <a href="{{ route('host.apartments.index') }}" class="btn btn-secondary">Annulla</a>
            {{-- <a class="btn btn-success" onmousedown="beforeSubmit()">Salva appartamento</a> --}}
            {{-- <a id="geocodeBtn" class="btn btn-success">Geolocalizza</a> --}}
            <button type="submit" class="btn btn-success">Salva appartamento</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{ URL::asset('js/script/coordinates.js') }}"></script>
@endsection