@extends('layouts.app')

@section('content')
<div class="container text-white mt-5 create_container" id="root">
  {{-- title --}}
  <h1 class="text-white text-center mb-3">Crea un nuovo appartamento</h1>

  {{-- back button --}}
  <div class="me-auto mb-4">
    <a class="text-white" href="{{ route('host.apartments.index') }}">
      <button class="d-flex align-items-center px-4 button_back">
        <img class="ps-2" src="/img/frecce.svg" alt=""> Torna indietro
      </button>
    </a>
  </div>

  {{-- FORM --}}
  <form class="row g-3" id="formid" autocomplete="off" action="{{ route('host.apartments.store') }}" method="post"
    enctype="multipart/form-data">

    @csrf

    {{-- Title --}}
    <div class="col-md-6">
      <label class="form-label">Titolo</label>
      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
        placeholder="Inserisci qui il tuo titolo" value="{{ old('title') }}" required>
      @error('title')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Numero di stanze</label>
      <input type="number" min="0" name="room_numbers" class="form-control @error('room_numbers') is-invalid @enderror"
        placeholder="Inserisci qui il numero delle stanze" value="{{ old('room_numbers') }}" required>
      @error('room_numbers')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Numero di letti</label>
      <input type="number" min="0" name="bed_numbers" class="form-control @error('bed_numbers') is-invalid @enderror"
        placeholder="Inserisci qui il numero dei letti" value="{{ old('bed_numbers') }}" required>
      @error('bed_numbers')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Numero di bagni</label>
      <input type="number" min="0" name="bathroom_numbers"
        class="form-control @error('bathroom_numbers') is-invalid @enderror"
        placeholder="Inserisci qui il numero dei bagni" value="{{ old('bathroom_numbers') }}" required>
      @error('bathroom_numbers')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Metratura</label>
      <input type="number" min="0" name="square_meters"
        class="form-control @error('square_meters') is-invalid @enderror"
        placeholder="Inserisci qui la metratura della stanza" value="{{ old('square_meters') }}" required>
      @error('square_meters')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>


    <div class="col-md-3">
      <label class="form-label">Immagine di copertina</label>
      <input type="file" name='cover' class="form-control @error('cover') is-invalid @enderror">
      @error('cover')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Prezzo per notte</label>
      <input type="number" min="0" name="price_per_night"
        class="form-control @error('price_per_night') is-invalid @enderror"
        placeholder="Inserisci qui il prezzo per notte" value="{{ old('price_per_night') }}" required>
      @error('price_per_night')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Paese</label>
      <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
        placeholder="Inserisci qui il paese" value="{{ old('country') }}" required>
      @error('country')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Regione</label>
      <input type="text" name="region" class="form-control @error('region') is-invalid @enderror"
        placeholder="Inserisci qui la regione" value="{{ old('region') }}" required>
      @error('region')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Provincia</label>
      <input type="text" name="province" class="form-control @error('province') is-invalid @enderror"
        placeholder="Inserisci qui la provincia" value="{{ old('province') }}" required>
      @error('province')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-6 autocomplete">
      <label class="form-label">Indirizzo completo - (Via civico, CAP Città)</label>
      <input id='geoAddress' type="text" name="streetAddress" class="form-control @error('streetAddress') is-invalid @enderror"
        placeholder="Inserisci qui l'indirizzo" value="{{ old('streetAddress') }}" required onkeyup="if (this.value.length > 6) beforeSubmit()">
      @error('streetAddress')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-check mb-3">
      <label class="form-check-label" for="flexCheckDefault">
        L'appartamento è visibile?
      </label>
      <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="isVisible" {{
        old('isVisible') ? 'checked' : '' }}>
    </div>

    {{-- contenuto del post --}}
    <div class="col-md-12">
      <label>Contenuto</label>
      <textarea name="description" rows="10" class="form-control @error('description') is-invalid @enderror"
        placeholder="Inizia a scrivere qualcosa..." required>{{ old('description') }}</textarea>
      @error('description')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-2 d-none">
      <label class="form-label">Longitudine</label>
      <input id='longitudeHtml' type="text" name="longitude"
        class=" form-control @error('longitude') is-invalid @enderror" placeholder="longitude" value="{{ old('longitude') }}" >
      @error('longitude')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="col-md-2 d-none">
      <label class="form-label">Latitudine</label>
      <input id='latitudeHtml' type="text" name="latitude" class=" form-control @error('latitude') is-invalid @enderror"
        placeholder="latitude" value="{{ old('latitude') }}">
      @error('longitude')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label>Tags</label><br>
      @foreach ($tags as $tag)
      <div class="form-check form-check-inline">
        <input class="form-check-input @error('tags') is-invalid @enderror" type="checkbox" value="{{ $tag->id }}" id="tag_{{ $tag->id }}" name="tags[]">
        <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
      </div>
      @endforeach
    </div>

    <label class="m-2">Images</label>
    <input type="file" id="input-file-now-custom-3" class="form-control m-2 @error('images.*') is-invalid @enderror"
      name="images[]" multiple>
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