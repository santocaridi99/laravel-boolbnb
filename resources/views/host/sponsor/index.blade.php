<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sponsorship</title>
</head>

<body>
    <h1>Qui sponsor</h1>
    @foreach ($sponsorship as $sponsor )
    <h1>{{$sponsor->type}}</h1>
    <h2>{{$sponsor->price}}€</h2>
    <h3>{{$sponsor->duration}}</h3>

    <a class="white_font title_a" href="{{ route('host.sponsor.show', $sponsor->id) }}">
        Visualizza questa sponsorizzazione
    </a>

    @endforeach

</body>

</html>