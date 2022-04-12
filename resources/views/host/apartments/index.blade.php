<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>I miei appartamenti</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <a class="p-2" href="{{ route('host.apartments.create') }}">Crea un nuovo appartamento</a>
                    @foreach ($apartments as $apartment)
                        <div class="card p-2">
                            <p class="text-uppercase"><a href="{{ route('host.apartments.show', $apartment->id) }}">{{ $apartment->title}}</a></p>
                            @if ($apartment->cover)
                                <img class="img-fluid" src="{{ $apartment->cover }}" alt="" class="post-img">
                            @else
                                <img class="img-fluid" src="https://via.placeholder.com/1024x480" alt="" class="img-fluid">
                            @endif
                            <p>{{ $apartment->description}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>