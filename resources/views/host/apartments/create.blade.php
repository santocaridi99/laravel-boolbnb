<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/services/services-web.min.js"></script>

</head>

<body>
  <div class="container mt-5">
    <form class="row g-3" action="{{ route('host.apartments.store') }}" method="post" enctype="multipart/form-data">

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
        <input type="number" name="room_numbers" class="form-control @error('room_numbers') is-invalid @enderror"
                  placeholder="Inserisci qui il numero delle stanze" value="{{ old('room_numbers') }}" required>
                  @error('room_numbers')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Numero di letti</label>
        <input type="number" name="bed_numbers" class="form-control @error('bed_numbers') is-invalid @enderror"
                  placeholder="Inserisci qui il numero dei letti" value="{{ old('bed_numbers') }}" required>
                  @error('form_numbers')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Numero di bagni</label>
        <input type="number" name="bathroom_numbers" class="form-control @error('bathroom_numbers') is-invalid @enderror"
                  placeholder="Inserisci qui il numero dei bagni" value="{{ old('bathroom_numbers') }}" required>
                  @error('bathroom_numbers')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Metratura</label>
        <input type="number" name="square_meters" class="form-control @error('square_meters') is-invalid @enderror"
                  placeholder="Inserisci qui la metratura della stanza" value="{{ old('square_meters') }}" required>
                  @error('square_meters')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
      </div>


      <div class="col-md-2">
        <label class="form-label">Immagine di copertina</label>
        <input type="text" name='cover' class="form-control @error('cover') is-invalid @enderror">
        @error('cover')
           <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Prezzo per notte</label>
        <input type="number" name="price_per_night" class="form-control @error('price_per_night') is-invalid @enderror"
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

      <div class="col-md-6">
        <label class="form-label">Città</label>
        <input id='geoCity' type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                  placeholder="Inserisci qui la città" value="{{ old('city') }}" required>
                  @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
      </div>
      
      <div class="col-md-6">
        <label class="form-label">Via</label>
        <input id='geoAddress' type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                  placeholder="Inserisci qui la regione" value="{{ old('street') }}" required>
                  @error('street')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Numero Civico</label>
        <input id='geoCnum' type="number" name="street_number" class="form-control @error('street_number') is-invalid @enderror"
                  placeholder="Inserisci qui il civico" value="{{ old('street_number') }}" required>
                  @error('street_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">CAP</label>
        <input type="text" name="post_code" class="form-control @error('post_code') is-invalid @enderror"
                  placeholder="Inserisci qui la regione" value="{{ old('post_code') }}" required>
                  @error('post_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
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

      <div class="mb-3">
        <label>Tags</label><br>
        @foreach ($tags as $tag)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
              id="tag_{{ $tag->id }}" name="tags[]">
            <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
          </div>
        @endforeach
      </div>

      <div class="form-group">
        <a href="{{ route('host.apartments.index') }}" class="btn btn-secondary">Annulla</a>
        <button type="submit" class="btn btn-success">Salva appartamento</button>
        <a id="geocodeBtn" class="btn btn-success">Geolocalizza</a> 
      </div>
    </form>
  </div>

  <script> 

    //Here’s what our corresponding javascript would look like: 
    document.getElementById('geocodeBtn').onclick = function () { 
        let city = document.getElementById('geoCity').value;
        let address = document.getElementById('geoAddress').value;
        let civic = document.getElementById('geoCnum').value;
        
        let completeAddress = address + ' ' + civic + ' ' + city;

        var geocodeOptions = { 
            query: completeAddress, 
            key: 'm5upOBKh2ugQazsa72XgmQ7fFAuUxA9y' 
        }; 
        // Look up the geocode of the given address 
        tt.services.geocode(geocodeOptions).then(function (geocodeRes) { 
            console.log(geocodeRes); 
            var reverseOptions = { 
                position: geocodeRes.results[0].position, 
                key: 'm5upOBKh2ugQazsa72XgmQ7fFAuUxA9y' 
            } 

            // with our geocode, do a reverse look-up to get our original address back 
            tt.services.reverseGeocode(reverseOptions).then(function (reverseRes) { 
                console.log(reverseRes); 
            }); 
        }); 
    }; 
  </script> 
</body>
</html>