<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://js.braintreegateway.com/web/dropin/1.33.1/js/dropin.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<style>
    .button {
        cursor: pointer;
        font-weight: 500;
        left: 3px;
        line-height: inherit;
        position: relative;
        text-decoration: none;
        text-align: center;
        border-style: solid;
        border-width: 1px;
        border-radius: 3px;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: inline-block;
    }

    .button--small {
        padding: 10px 20px;
        font-size: 0.875rem;
    }

    .button--green {
        outline: none;
        background-color: #64d18a;
        border-color: #64d18a;
        color: white;
        transition: all 200ms ease;
    }

    .button--green:hover {
        background-color: #8bdda8;
        color: white;
    }


    .porcodio {
        display: none
    }
</style>





<body>
    <form class="form_box p-5" id="formid" autocomplete="off" action="{{ route('host.sponsor.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf


        <h1>show</h1>
        <h1>{{$sponsorship->type}}</h1>
        <h2>{{$sponsorship->price}}</h2>
        <h3>{{$sponsorship->duration}}</h3>

        <input type="hidden" name="price" value="{{$sponsorship->price}}">
        <input type="hidden" name="type" value="{{$sponsorship->type}}">
        <input type="hidden" name="duration" value="{{$sponsorship->duration}}">
        <input type="hidden" name="id" value="{{$sponsorship->id}}">

        <label>Inserisci la data di inizio</label>
        <input id="start_date" type="date" class="form-control" name="start_date" data-parsley-type="date" required
            autocomplete="start_date" data-parsley-required-message="inserisci una data " data-parsley-trigger='change'>


        <div id="dropin-container"></div>
        <button id="submit-button" class="button button--small button--green">Purchase</button>
        <button type="submit" id="prova" class="porcodio">prova</button>
        <div>
            <a href="{{ route('host.sponsor.index', $sponsorship->id) }}">torna dietro</a>
        </div>
    </form>
</body>

</html>

<script>
    var button = document.querySelector('#submit-button');
    let flag = false;
    let prova=document.getElementById('prova');
    let dataInizio = document.getElementById('start_date');
    

   

braintree.dropin.create({
  authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
  selector: '#dropin-container'
}, function (err, instance) {
  button.addEventListener('click', function () {
    flag = true;
    console.log(flag);
    instance.requestPaymentMethod(function (err, payload) {
      // Submit payload.nonce to your server
    });
    if(flag===true){
        console.log(flag);
        console.log(prova);
        prova.classList.remove('porcodio');
        button.classList.add('porcodio');

    }
  })
});

</script>