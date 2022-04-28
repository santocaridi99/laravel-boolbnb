@extends('layouts.app')

@section('content')
<div class="container text-white ap_create_edit">

    {{-- titolo --}}
    <h1 class="text-center text-white fw-bold mt-4 mb-5">Modifica l'appartamento</h1>
    
    {{-- back button --}}
    <div class="me-auto mb-4">
        <a class="text-white" href="{{ route('host.apartments.index') }}">
            <button class="d-flex align-items-center py-2 px-4 button_back">
                <img class="ps-2" src="/img/frecce.svg" alt=""> Torna indietro
            </button>
        </a>
    </div>

    <div class="form_container blk_op_bg f_18 position-relative">

        <div class="cerchietti position-absolute d-flex">
            <div class="rounded-circle pink_custom"></div>
            <div class="rounded-circle orange_custom"></div>
            <div class="rounded-circle ocra_custom"></div>
        </div>

        <form class="form_box p-5" id="formid" autocomplete="off" action="{{ route('host.apartments.update',$apartment->id) }}" method="post"
            enctype="multipart/form-data">

            @csrf
            @method('patch')

            <div class="row g-3">
                {{-- Title --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Titolo*</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title',$apartment->title) }}" required data-parsley-pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" data-parsley-length='[5,100]' data-parsley-trigger='change'>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- stanze --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Numero di stanze*</label>
                    <input type="number" name="room_numbers" class="form-control @error('room_numbers') is-invalid @enderror"
                        value="{{ old('room_numbers', $apartment->room_numbers)}}" required data-parsley-type='number' min="1" max="100"  data-parsley-pattern="[0-9]+$" data-parsley-length='[1,3]' data-parsley-trigger='change'>
                    @error('room_numbers')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- letti --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Numero di letti*</label>
                    <input type="number" name="bed_numbers" class="form-control @error('bed_numbers') is-invalid @enderror"
                        value="{{ old('bed_numbers',$apartment->bed_numbers)}}" required data-parsley-type='number' min="1" max="100"  data-parsley-pattern="[0-9]+$" data-parsley-length='[1,3]' data-parsley-trigger='change'>
                    @error('bed_numbers')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- bagni --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Numero di bagni*</label>
                    <input type="number" name="bathroom_numbers"
                        class="form-control @error('bathroom_numbers') is-invalid @enderror"
                        value="{{ old('bathroom_numbers',$apartment->bathroom_numbers) }}" required data-parsley-type='number' min="1" max="100"  data-parsley-pattern="[0-9]+$" data-parsley-length='[1,3]' data-parsley-trigger='change'>
                    @error('bathroom_numbers')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- MQ --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Metratura*</label>
                    <input type="number" name="square_meters" class="form-control @error('square_meters') is-invalid @enderror"
                        value="{{ old('square_meters',$apartment->square_meters) }}" required data-parsley-type='number' min="1" max="1200"  data-parsley-pattern="[0-9]+$" data-parsley-length='[1,4]' data-parsley-trigger='change'>
                    @error('square_meters')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- cover --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Immagine di copertina*</label>
                    <input type="file" name='cover' class="form-control @error('cover') is-invalid @enderror" value="{{old('cover',$apartment->cover)}}">
                    {{-- anteprima img --}}
                    <div class="col-3">
                        <img class="img-fluid" src="{{ asset('storage/' . $apartment->cover) }}" alt="" class="post-img">
                    </div>
                    @error('cover')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- prezzo per notte --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Prezzo per notte*</label>
                    <input type="number" name="price_per_night"
                        class="form-control @error('price_per_night') is-invalid @enderror"
                        value="{{ old('price_per_night', $apartment->price_per_night) }}" required data-parsley-type='number' min="1" max="100000"  data-parsley-pattern="[0-9]+$" data-parsley-length='[1,6]' data-parsley-trigger='change'>
                    @error('price_per_night')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- paese --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Paese*</label>
                    <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                        value="{{ old('country', $apartment->country) }}"  required  data-parsley-pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" data-parsley-length='[2,100]' data-parsley-trigger='change'>
                    @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- regione --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Regione*</label>
                    <input type="text" name="region" class="form-control @error('region') is-invalid @enderror"
                        value="{{ old('region',$apartment->region) }}"  required  data-parsley-pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" data-parsley-length='[2,100]' data-parsley-trigger='change'>
                    @error('region')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- provincia --}}
                <div class="col-md-6 px-4">
                    <label class="form-label">Provincia*</label>
                    <input type="text" name="province" class="form-control @error('province') is-invalid @enderror"
                        value="{{ old('province' , $apartment->province) }}"  required  data-parsley-pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" data-parsley-length='[2,100]' data-parsley-trigger='change'>
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

                {{-- indirizzo --}}
                <div class="col-md-12 autocomplete blk_font px-4">
                    <label class="form-label text-white">Indirizzo completo (Via civico, CAP Città)*</label>
                    <input id='geoAddress' type="text" name="streetAddress" class="form-control @error('streetAddress') is-invalid @enderror"
                    placeholder="Inserisci qui l'indirizzo" value="{{ old('streetAddress', $apartment->streetAddress) }}" required onkeyup="if (this.value.length > 6) beforeSubmit()">
                    @error('streetAddress')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- visibilità --}}
                <div class="col-md-12 px-4">
                    <div class="form-check mb-3">
                    <label class="form-check-label" for="flexCheckDefault">
                        L'appartamento è visibile?*
                    </label>
                    <input type="hidden" name='isVisible' value="0">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="isVisible" {{
                        $apartment->isVisible ? 'checked' : '' }}>
                    </div>
                </div>
                
                {{-- contenuto del post --}}
                <div class="col-md-12 px-4">
                    <label>Descrizione dell'appartamento*</label>
                    <textarea name="description" rows="10"
                        class="form-control @error('description') is-invalid @enderror" required   data-parsley-length='[20,250]'  data-parsley-trigger="change">{{ old('description',$apartment->description) }}</textarea>
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

                {{-- tags --}}
                <div class="col-md-12 mb-3 px-4">
                    <div class="tags_box border-bottom pb-3">
                        <label class="d-block border-bottom pb-2 mb-2">Tags*</label>
                        @foreach ($tags as $tag)
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input @error('tags') is-invalid @enderror" type="checkbox" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                name="tags[]" {{$apartment->tags->contains($tag) ? 'checked' : ''}}>
                            <label class="form-check-label ms-1" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- images --}}
                <div class="col-md-12 px-4">
                    <label class="mb-3">Aggiungi altre immagini relative all'appartamento</label>
                    <input type="file" id="input-file-now-custom-3" class="form-control @error('images.*') is-invalid @enderror " name="images[]" multiple>
                    @error('images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- BUTTONS --}}
            <div class="text-center mt-3 p-4 bg-light buttons_box">
                <div class="form-group">
                    {{-- <a class="btn btn-success" onmousedown="beforeSubmit()">Salva appartamento</a> --}}
                    {{-- <a id="geocodeBtn" class="btn btn-success">Geolocalizza</a> --}}
                    <button type="submit" class="px-4 pink_custom save">Salva appartamento</button>
                    <button class="px-4 ms-3 orange_custom undo">
                        <a href="{{ route('host.apartments.index') }}">Annulla</a>
                    </button>
                </div>
            </div>
        </div>
    </form>

        
</div>
<script type="text/javascript" src="{{ URL::asset('js/script/coordinates.js') }}"></script>
@endsection