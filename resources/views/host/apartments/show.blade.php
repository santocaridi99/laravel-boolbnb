@extends('layouts.app')

@section('content')
  <div class="ap_show">
    <div class="container">
      <div class="d-flex align-items-center mb-4">
        {{-- title --}}
        <h1 class="text-white fw-bold mt-4 show_h1">{{$apartment->title}}</h1>
        {{-- <div class="show_visible_box_top mx-2">
          @if($apartment->isVisible)
          <small class="badge bg-dark"><i class="me-1 green_font fas fa-check-circle"></i> visibile</small>
          @else
          <small class="badge bg-dark"><i class="me-1 pink_font fas fa-times-circle"></i> non visibile</small>
          @endif
        </div> --}}
        
        {{-- back button --}}
        <div class="show_back ms-auto">
          <a class="text-white ec_back" href="{{ route('host.apartments.index') }}">
            <button class="d-flex align-items-center py-2 px-4 text-white button_back">
              <img class="ps-2" src="/img/frecce.svg" alt=""> Torna indietro
            </button>
          </a>

          {{-- responsive back --}}
          <a class="text-white resp_back ms-4" href="{{ route('host.apartments.index') }}">
            <button class="d-flex align-items-center button_back">
              <img class="" src="/img/frecce.svg" alt="">
            </button>
          </a>
        </div>
      </div>

      {{-- cover --}}
      <div class="row g-0 w-100 d-flex justify-content-center">
        <div class="col-lg-10 col-md-12 col-sm-12 d-flex justify-content-center">
          {{-- img --}}
          @if ($apartment->cover !== 'cover')
            <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="w-100">
              <img 
                  class="w-100 obj_fit show_img"
                  src="{{ asset('storage/' . $apartment->cover) }}"
                  alt=""
              />
            </a>
          @else
            <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="w-100">
              <img 
                  class="w-100 obj_fit show_img"
                  src="https://fakeimg.pl/800x600/?text=Scarpe"
                  alt=""
              />
            </a>
          @endif
        </div>

        {{-- images --}}
        <div class="col-lg-2 col-md-12 col-sm-12">
          
            @foreach ($apartment->images as $item)
              <div class="images_extra">
                <img class="h-100 w-100" src="{{ asset('image/' . $item->images) }}" alt="" class="post-img">
              </div>
            @endforeach
        
        </div>
      </div>
    </div>

    <div class="w-100 bg-white">
      <div class="container py_50">

        {{-- visibilità --}}
        <div class="visible_box_middle pt-2 pb-4">
          @if($apartment->isVisible)
          <small class="badge bg-dark"><i class="me-1 green_font fas fa-check-circle"></i> visibile</small>
          @else
          <small class="badge bg-dark"><i class="me-1 pink_font fas fa-times-circle"></i> non visibile</small>
          @endif
        </div>

        <div class="row">
          {{-- info --}}
          <div class="col-lg-6 col-md-12 col-sm-12 pe-5">
            {{-- indirizzo --}}
            <div class="show_address mb-5">
              <h3>Indirizzo</h3>

              <ul class="p-0">
                <li>{{$apartment->streetAddress}}</li>
                <li>{{$apartment->province}}, {{$apartment->region}}</li>
                <li>{{$apartment->country}}</li>
              </ul>
            </div>
            
            {{-- servizi --}}
            <div class="show_servizi mb-5">
              <h3>Servizi aggiuntivi</h3>
              <div class="w-100 d-flex align-items-center flex-wrap">
                @foreach ($apartment->tags as $tag)
                  <div class="badge m-1 blk_op_bg">{{$tag->name}}</div>
                @endforeach
              </div>
            </div>
            
            {{-- descrizione --}}
            <div class="show_descrizione mb-5 text-break">
              <h3>Descrizione dell'appartamento</h3>
              <p class="font-monospace text-break lh-base mb-0">
                {{$apartment->description}}
              </p>
            </div>

            <div class="show_edit">
              <button class="edit_btn">
                <a class="text-white align-middle py-2 px-4" href="{{ route('host.apartments.edit', $apartment->slug) }}">
                  Modifica le informazioni <i class="fa-solid fa-pen-to-square ps-2"></i>
                </a>
              </button>
            </div>
              
          </div>

          {{-- <div class="col-lg-4 col-md-12 col-sm-12 d-flex justify-content-center align-items-center py_100 stat">
            
          </div> --}}
          
          {{-- messaggi --}}
          <div class="col-lg-6 col-md-12 col-sm-12 ps-5">
            {{-- statistiche --}}
            <h3>Statistiche</h3>
            <div class="d-flex justify-items-center mb-5">
              <div class="d-flex justify-content-center">
                <svg class="progress-ring me-4" width="120" height="120">
                  <circle class="progress-ring__circle" stroke="#111111" stroke-width="6" fill="#FF6332" r="32" cx="60" cy="60" />
                </svg>
              </div>
          
              <div class="d-flex flex-column justify-content-center">
                <p class="text-break fw-bold mb-0 pb-0 f_18 w_250 stat_text">Numero totale di visualizzazioni ricevute:</p>
                <input id='input' class="statsinput fw-bold bg-transparent p-0 m-0 w_100 f_18 orange_font" value="{{$apartment->views}}" {{--
                  type="number" --}} step="5" min="0" max="100" placeholder="progress" disabled>
              </div>
            </div>

            <div class="blk_font">
              <h3 class="mb-3">Lista dei messaggi ricevuti</h3>
              <div class="messages_container overflow-auto maxh_220">
                @if(!count($messages))
                  <div class="message_box mb-4 g_shadow border rounded mx-3">
                    <div class="w-100 bg-dark rounded-top p-3 mb-0"></div>
                  
                    <div class="message_body bg-light px-3 pb-2">
                      <p class="mb-0 py-3 mb-3 text-break overflow-hidden fs-5 h_100">Non ci sono nuovi messaggi da mostrare</p>
                    </div>
                  </div>
                @else
                  @foreach ($messages as $message)
                    <div class="message_box g_shadow border rounded mb-4 mx-3">
                      <h6 class="w-100 bg-dark text-white rounded-top p-2 mb-0">Nuovo messaggio</h6>
                      
                      <div class="message_body bg-light px-3 pb-2">
                        <p class="mb-0 py-2 border-bottom bb_gray"><span class="me-2 op_9">inviato da:</span>{{$message->email}}</p>
                        <p class="mb-0 py-3 mb-3 text-break overflow-hidden h_100">{{$message->content}}</p>
                        {{-- <small class=""><span class="me-1 op_9">Ricevuto il</span><small>{{$message->created_at}}</small></small> --}}
                      </div>  
                    </div>
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <script>
    var circle = document.querySelector('circle');
    var radius = circle.r.baseVal.value;
    var circumference = radius * 2 * Math.PI;

    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.strokeDashoffset = `${circumference}`;

    function setProgress(percent) {
      const offset = circumference - percent / 100 * circumference;
      circle.style.strokeDashoffset = offset;
    };

    const input = document.getElementById('input');
    setProgress(input.value);

    input.addEventListener('change', function() {
      if (input.value < 101 && input.value > -1) {
        setProgress(input.value);
      }  
    })
</script>
@endsection