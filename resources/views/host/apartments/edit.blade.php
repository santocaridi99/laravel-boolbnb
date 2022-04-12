<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apartment Edit</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <form class="row g-3" action="{{ route('host.apartments.update',$apartment->id) }}" method="post"
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
                <input type="number" name="room_numbers"
                    class="form-control @error('room_numbers') is-invalid @enderror"
                    value="{{ old('room_numbers', $apartment->room_numbers)}}">
                @error('room_numbers')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Numero di letti</label>
                <input type="number" name="bed_numbers" class="form-control @error('bed_numbers') is-invalid @enderror"
                  value="{{ old('bed_numbers',$apartment->bed_numbers)}}">
                @error('form_numbers')
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
                <input type="number" name="square_meters"
                    class="form-control @error('square_meters') is-invalid @enderror"
                    value="{{ old('square_meters',$apartment->square_meters) }}">
                @error('square_meters')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-2">
                <label class="form-label">Modifica Immagine di copertina</label>
                <input type="text" name='cover' class="form-control  @error('cover') is-invalid @enderror" value="{{ old('cover',$apartment->cover) }}">
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
                     value="{{ old('region',$apartment->region) }}" >
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

            <div class="col-md-6">
                <label class="form-label">Città</label>
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                 value="{{ old('city',$apartment->city) }}">
                @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Via</label>
                <input type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                 value="{{ old('street',$apartment->street) }}">
                @error('street')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Numero Civico</label>
                <input type="number" name="street_number"
                    class="form-control @error('street_number') is-invalid @enderror"
                    value="{{ old('street_number',$apartment->street_number) }}">
                @error('street_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">CAP</label>
                <input type="text" name="post_code" class="form-control @error('post_code') is-invalid @enderror"
                 value="{{ old('post_code',$apartment->post_code) }}" required>
                @error('post_code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- contenuto del post --}}
            <div class="col-md-12">
                <label>Contenuto</label>
                <textarea name="description" rows="10" class="form-control @error('description') is-invalid @enderror"
                    >{{ old('description',$apartment->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Tags</label><br>
                @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                        name="tags[]" {{$apartment->tags->contains($tag) ? 'checked' : ''}}>
                    <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
                @endforeach
            </div>

            <div class="form-group">
                <a href="{{ route('host.apartments.index') }}" class="btn btn-secondary">Annulla</a>
                <button type="submit" class="btn btn-success">Salva appartamento</button>
            </div>
        </form>
    </div>
</body>

</html>