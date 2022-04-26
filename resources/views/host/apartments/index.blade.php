@extends('layouts.app')

@section('content')
<div class="container back_ap">
    {{-- search bar --}}
    {{-- <div class="search_container text-center mb-3">
        <input type="text" class="search_bar ps-3 text-white" placeholder="Cerca tra i tuoi alloggi">
        <button class="button_search_bar text-white"><i class="fas fa-search"></i></button>
    </div> --}}

    <h1 class="text-center text-white fw-bold mt-3">I miei alloggi</h1>

    <div class="row justify-content-center mt-4">
        <div class="col-10">
            <div class="d-flex align-items-center">
                {{-- create --}}
                <div class="create_container">
                    <a class="btn btn-link create_svg" href="{{ route('host.apartments.create') }}">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none">
                            <style>
                                @keyframes bounce {
                                    0% {
                                        transform: scale3d(1, 1, 1)
                                    }

                                    30% {
                                        transform: scale3d(1.25, .75, 1)
                                    }

                                    40% {
                                        transform: scale3d(.75, 1.25, 1)
                                    }

                                    50% {
                                        transform: scale3d(1.15, .85, 1)
                                    }

                                    65% {
                                        transform: scale3d(.95, 1.05, 1)
                                    }

                                    75% {
                                        transform: scale3d(1.05, .95, 1)
                                    }
                                }
                            </style>
                            <path fill="#FF385C" fill-rule="evenodd"
                                d="M12.75 8.744a.75.75 0 00-1.5 0v2.506H8.744a.75.75 0 000 1.5h2.506v2.506a.75.75 0 001.5 0V12.75h2.506a.75.75 0 000-1.5H12.75V8.744z"
                                clip-rule="evenodd"
                                style="animation:bounce 1s 1s infinite both;transform-origin:center center" />
                            <rect width="16" height="16" x="4" y="4" stroke="#FF385C" stroke-width="1.5" rx="2.075" />
                        </svg>
                    </a>
                    <div class="create_slide text-white">Aggiungi un nuovo appartamento</div>
                </div>
                
                {{-- trash bin --}}
                <a class="btn btn-link ms-auto" href="{{ route('host.apartments.deletedApartments')}}" title="Cestino">
                    {{-- <span class="text-white">Cestino</span> --}}
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="none">
                        <style>
                            @keyframes rotate-tr {
                                0% {
                                    transform: rotate(0)
                                }

                                to {
                                    transform: rotate(20deg)
                                }
                            }
                        </style>
                        <path fill="#FFF"
                            d="M16.773 10.083a.75.75 0 00-1.49-.166l1.49.166zm-1.535 7.027l.745.083-.745-.083zm-6.198 0l-.745.083.745-.083zm-.045-7.193a.75.75 0 00-1.49.166l1.49-.166zm5.249 7.333h-4.21v1.5h4.21v-1.5zm1.038-7.333l-.79 7.11 1.491.166.79-7.11-1.49-.166zm-5.497 7.11l-.79-7.11-1.49.166.79 7.11 1.49-.165zm.249.223a.25.25 0 01-.249-.222l-1.49.165a1.75 1.75 0 001.739 1.557v-1.5zm4.21 1.5c.892 0 1.64-.67 1.74-1.557l-1.492-.165a.25.25 0 01-.248.222v1.5z" />
                        <path fill="#EDB900" fill-rule="evenodd"
                            d="M11 6a1 1 0 00-1 1v.25H7a.75.75 0 000 1.5h10a.75.75 0 000-1.5h-3V7a1 1 0 00-1-1h-2z"
                            clip-rule="evenodd"
                            style="animation:rotate-tr 1s cubic-bezier(1,-.28,.01,1.13) infinite alternate-reverse both;transform-origin:right center" />
                    </svg>
                </a>
            </div>

            {{-- APARTMENTS CARDS --}}
            @foreach ($apartments as $apartment)
            <div class="ap_card bg-light rounded mx-3 mb-5">
                <div class="row g-0">
                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex align-items-center blk_op_bg">
                        @if ($apartment->cover)
                            <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="w-100 ex">
                                <img 
                                    class="w-100 rounded obj_fit show_img"
                                    src="{{ asset('storage/' . $apartment->cover) }}"
                                    alt=""
                                />
                            </a>
                        @else
                            <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="w-100">
                                <img 
                                    class="w-100 rounded obj_fit show_img"
                                    src="https://via.placeholder.com/1024x480"
                                    alt=""
                                />
                            </a>
                        @endif
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="ap_body">
                            {{-- titolo --}}
                            <div class="d-flex justify-content-between align-items-center flex-wrap py-3 px-3 w-100 blk_op_bg">

                                <div class="ap_title me-2 ms-3 text-break">
                                    <h2 class="fw-bold">
                                        <a href="{{ route('host.apartments.show', $apartment->slug) }}">{{$apartment->title}}</a>
                                    </h2>

                                    <p class="text-white mb-3 op f_12">
                                        <i class="fas fa-map-marker-alt me-1"></i> {{$apartment->streetAddress}}
                                    </p>

                                    <small class="text-white">
                                        @if ($apartment->room_numbers === 1)
                                            {{$apartment->room_numbers}} stanza &#10022; 
                                        @else 
                                            {{$apartment->room_numbers}} stanze &#10022;
                                        @endif

                                        @if ($apartment->bed_numbers === 1)
                                        {{$apartment->bed_numbers}} camera da letto &#10022;
                                        @else
                                        {{$apartment->bed_numbers}} camere da letto &#10022;
                                        @endif

                                        @if ($apartment->bathroom_numbers === 1)
                                        {{$apartment->bathroom_numbers}} bagno &#10022;
                                        @else
                                        {{$apartment->bathroom_numbers}} bagni &#10022;
                                        @endif

                                        {{$apartment->square_meters}} mq
                                    </small>
                                </div>
                                
                                {{-- BUTTONS --}}
                                <div class="d-flex mx-4 i_buttons">
                                    {{-- edit button --}}
                                    <div class="ms-2">
                                        <a class="edit_btn" type="button"
                                            href="{{ route('host.apartments.edit', $apartment->slug) }}"
                                            title="Modifica appartamento">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>

                                    {{-- form che permette di soft deletare un post--}}
                                    <div class="ms-2">
                                        <form
                                            action="{{ route('host.apartments.softDeleteApartment', $apartment->id) }}"
                                            method="POST" class="d-inline-block ms-auto">
                                            @csrf
                                            @method("delete")

                                            <a type="submit" class="dng_btn"
                                                title="Elimina appartamento">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- tags --}}
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center border p-3">
                                @foreach ($apartment->tags as $tag)
                                    @if ($tag->name === "Piscina")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAADj0lEQVR4nO2au09UQRTGf6iYgMYIFjSGSEF8BAoxYpQEbSwUGzsllv4VPhptBII0hoCSWPkksbDQxERjRKOJz6CNiRINWilaKKA8di3mrDu7zL137zKzF935kkn23PnuN2dm73z3bHbAo7xRUaJxNgAHgd1AHVAJfAZGgGHgY0y9eqATaJPPKWAceAxcAT5YydoCaoABYAZIB7QZ4DywpgC9WuACMBeiNwcMAWstzqMoNAJvySZ1HTgCbJPWCVwGZoXzHmgI0dsIjBn0tgOtoncV+C2csQg9p1hHNtlRoCmE2wg8F+471BbJRx3qES9EbxPwNELPOYYlgZdkH8VmYBB4ATyTz1ukrxp4IvdcMujdiKm3GuUHQXpO0YIypSnUtwtwFLMPTKPMEWA9MCn3tmh6rcKNq1cfoOccfZJMv8Q7gXlJZAj1JmgFLgpvFtgs3LNyrVfT67es5xyvZdA9Et+UuM/APSd91yTeJfErjfNmEXptBj3n+CaDZvbqhMQmR26Qvq8S10g8oXEmF6FXa9BzjnkZdJnEmf1pwjLpS2nX8vkpy3oLbrCNjGYqlJXLCatIM3229HLgYgH+KfgFSDqBpKEvwCOCf2DEaUGI4kfFtvTSqF+hQO4CFGIy/wvCFtaKeJxvstR6OfAekHQCSWNFCcdyuu+KRSmegIcWNEaiKUsHVk3KtX7Ze0ApFsBGgeVsC7j4XyDzeFbkxYtFvp6V3Ev5Fig2YadvD+8BSSeQNHwhVIIxfCG0lPXL3gN8IeRA0xdCAfCF0FKEX4CkE0gafgGKvG+5tDhYWeRYhaCYfBagBzgEVIVwdgD3UP/ZTwJ3UaczdOiV2lYtngceGPg6moE7qOMvc8AtFlZ+elxIPjqqgcOouS5ARngcaDf070OdwUmjjqFkjrdNS1++TqH8KP2gBYir3w58Muj9xWnUEbQ08As4gTrh2QCclGtp1GmsVdIGNf4x4ae1a2H8OPpp4Lgl/VGZqxGVZA8WmVo3uQVNBdAVwE0BZwz87gT1e2WOkTiA2ls/gR+ovdWh9VeSa2odwv8OfAFuA3u1/nyTitLP59vQ3x86YwozwSaUSU2hTOo+6qhqEOKalGt+FWqOTk3QBn/GAd+5CdriDzjmjwKnTAsAxZlgXFML43cZ+D0W+c5MMK6pRZmUa74R3gTxJuhN0JugwJtgALwJ4k3Qm6A3QUf8MJNyzfcoW/wBiOlHxY+bSFMAAAAASUVORK5CYII=" />
                                    @endif

                                    @if ($tag->name === "Cortile")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAFUElEQVR4nO3bWaxdUxgH8N+9rbZohYTSooZGDKVPdDAEISkPFdqIiFAvxAseRb2IEDU0MTwbE6mhNyTGRmJoi1QrRUJRRStoaQil1aLHw7e3vc/pOadn3Lut+09W7rl7rfVN+/vW+vba32YYhWMm7scq/IZfsRL3YUaJcvUVh+B6fIjKbtoa3ILxpUjaY0zBk9guU3ADFuBCoeT45Pc9SV86bjuewCmFS90DTMPz+Eco8zeew3mYiBvxBn7Hsty8QZyPxcmcSkJjCKcXJHtXmIHXZXdxCx7AcTgTz+Iv1S6/tAGt4/GQMFI6dokw7h6HKeKO5xVfgENxIlbk+nbgBVyBo1qgfRjulRlip/CIk3uqQYc4Bo/L3PUPEcuHi9gdxA1J34+4A0d0yCs1xFZZWD2KSZ2L3znG4W5sywnzCI7Exfg0uT4PI3EOxvSI91FC8XR92Ya7MLZH9JtiENfie5lLv4xTc2O+Tq6v0183PQ2v5uT4Thh8sF8MzxIJS8pwpVixa3E+rsJ+/RKkBhfgg5xc74tkq2c4GovE4lPBV7gSA71k0iUGhdFT79uJp4TsHeMAkZFtkS1wt+tdLPcDo3CzapkX6GB9uEx1VvaMLq1ZMCaJnCOVfz0ubWXicXgpN/EzzOqPjIXgXHwk0+dFoeMu2E+16/wi3H9UIWL2FyPFg9hPQretIpRH5wcttfuntH2tvU22Z25vz6j7BLrSeYpYXb9TbdVPhHudlBs7R5a+LsFBub50XoqxIk4r+FNst8SNOhsPYlMNz1UifA/vRqFOkRdso/rGOAHTZYJ/LNtR8gaYIJSpYLNIn6ckNNY1oD25n8q1i5G4CI+JRTQVdifew8Pi+Cs9FJmaGzNVtu1uFQcha1Qr/RXuFEbZ4zEal4hsLN1ZatuvDX7n2yZhuJn2rMyzLYzBbHE0lj/caNS2iiRmtuKeJwrD/kKxZ1WfE/4pFr9rcGBp0hWMQ2QGOLhkWUpD7TZYOPp2eLC3YNgAZQtQNoYNULYAZWPYAGULUDaGDVC2AGVj2ADJ32Xiff1e+8jZBgbwpprX8t+InLzoGp0yngVmJDy/JvOAoeTv5QULUwZSHYfyF1OrfKvYMCjaAwZk3j69UUeRYVC0AWbKziQHyEKg4v8RBqlu6XvDKqRh8J91CkCRHtDQ/fMD1ms9DKbhHdVne0W37YkMrVSOpTd4vSY3eGEyaOFuiE3AzyUqXtt+TmRqhpZ0a8lK4m1rRZzkjm4yrt8YLXudf12TcQ29uzYVXiHWgEkaxEkdwmWjFRmmC502CB2bohVX2dtCoNXQRuthMA3Llb8ILscZTeRsd3EvJClKFWj0fy9xZkK77vZe73G4Yt9KipomP42QhkG7bYcoSpqzG/qdeMDchPaODmVry5sHxPlAp7G5U3MjtGuAubJCzU5aYWcdozA/Ybq6ybh2DbA66b/VXlC5Nk4I+3uTMe0aIK0x6nlFeK/PBEfhpuT35z2km9K6SZ89YLIoi92su/35H1EiU4tBUZ/XaN5b6t+US2XfB3TaNuNp8SlOXRxr1xK0Ttsq9RedWS3MrVeaOyCrIOu2bRRfuuyCRcmAV8SXH+1iUHxTkJbLXV1nzJBsMavFrUnfUJ2+q5O+H0Ri00noHonXEjqLajsniP11h/isrRtckzD5AiMa8Kj33dARuf58Xj8ioVVJaHeDiQ14uC1hsLhLBoTAn9lV4FZ4pB4yP3dtXnJtrahF7Bb1ePhS4/jrBKkXrKnDo5W2NjevnjG7QboO5XlYJp6qerUtjhBHVfm3L+1UpL9dR7Z8OHWDQbwrqleH8S+gmRHCRAxxbwAAAABJRU5ErkJggg==" />
                                    @endif

                                    @if ($tag->name === "Colazione inclusa")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAFP0lEQVR4nO2bW2wVVRSGv3MKCTStlFglqVExWAUNEtAXNGIjalTiDYnRxBgefPNNakApSogSL4mvXhK8G1REjZpgpEoqCFExJioigjH2Qa1A7dVLuYwPaw17OpmZvWfOnKZncv5k58z8Z83aa63Z970H6qgZzAI8YNiRd0K5QqMmEnfr79eOfKFwITCCvOlbHPjC4XXEyc2OfOHwJ+LoPEe+cBhDHG125J1RK43gL/p7uSNfOKxH3vR+YLoDXzg0Ik56wDoHvpC4AXH0B0e+cDgNcfQ/R94JtdIIApytv/2OfOHwJvKmX3LkC4XbESdHgPMd+MJhJ+Lo/Y584TCKODrLka+jjjrqqKNW8DnSklcz7YzLvFQFh9LCm6B8In2dUqHSOcAK4HrgLKANaAB+Bw4C24FtwL6sBuaAqgS4GXgFOIlbEdxuMbCapSB3/Y3AV6r0X+BVYA3QA5wgOgBJJSBvA8P6ctHvTzi6gdf0vheZjLyPKQknkUCsBbYqdwK4OoXBedgaFQDfhx3ATVmVBlM3Ziw+DDwFnAMsBD4KyK1KaXDeiKuWj6VV1AS8HKHoS+A+4FHguwDfD9yRwsBqIai/DViNrB55wLKkB9uRt/cO8BNwBLdG7yhSGlozGJgHXNqA1cp9EqXgSqSeuLbw4bSb5DpvM7hSuASgTbnBIDkN2IRxvB94HrgL2XqaGZFZCzAXuBN4Tp/xM3wR6THSGpw34vSP45sxqysDwANIQNJiGtCpOjxgD/Ztq0kRgM16sx+p+5WiHbNhsTWjgXnBGoDr9OIwMDvHjGcjDaeHbF6kNTAvWAPwLm79dRZ0qu73qqDbFdYA9OpFnm/fx3mqu68Kul1hDYA/KJiaQmkH0lX6I0FPrz8FrgrITVX+WIC7FukhDmnefwMHlFtK/rNCawCO6oXrIYO1gYfj0oOhZ5qR7nK3w7M9yNmfvGANwM96McdB2TJknDCGbEYER3utSDsypjLBhq8DGXR4wG/AQ8B8pNucDlwCdAF/qMxfwBIHe1xgDcCHenGzg7IdKpu0E7NKZbr1vh3j/BtIaYgbrc0A3sIEIY+SYA3AI3rxeEigBFyBjPC+xQxu0qRRjPN7MLvRScPVMiYIn6V2N8HROH6JXgQXLc4FPia9w7a0C7jAwegZyLKaR7p5RRSsASgDv+rNYuBSzNvuQ0rIYmTa6wH/AE8CizBVwucuA75Q7ghwL7I+sA5TvweRCZcNXSq/KZW7CY4m8RswRc4/e7cFeRMAzyh3CGnNbVwv5uCCjxbgbf1/APuQe4HKHrDI2eAUgJlIo+OTWzD1dT5wHBjC7MFHcfOUO6b/R6EBEwRb/W5UuRGLnA1RAYicDvuloI/xY4Knld9o4Z5QznZSowVTypZmMD4tonSsYXxPBcCzSnaFhL9XfmGA2xfBfYN7o/Wwyr5gkcs7AOElsRuDgj8quSCkYAjTRydxfsN5poNRi3Cr33kGIJw2hAWH9Y+mCjN0gT8YGrXI5R2AIaTYn3rzU0KCII1PpQ2PDf6x1uMWuTwnRrG6/L58sqeejI4nlqIy4+vxZEaWg1Bt+ns4SegizGcnKzNkUk00IHsSWW3zu7ttNsGVmEHHxRkyqhbuQew6SLqt/HB31xEnWEJOaBT+g4MY7CohXUPmT05qHINgRnCxxaSA6EB83lsGPlCyk8lxZqjaKCE7X6C+n4FZtUm9Z16D2IiZkp9a01yOOd7Sg8zSJmJIPFFoAq5BfPMQX28NCy0n27pfraUB4La4SLUin6Ltxcz4ipCG1Kf1wOlBh/8HAu4E/wXooFwAAAAASUVORK5CYII=" />
                                    @endif

                                    @if ($tag->name === "Vista mare")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAA/ElEQVRoge3XO0oDUQCF4c9GW7MAH6uJ9mKi+1BBXILGB27GBzYGLOxdiSSdjM2NDtHECUkh4XxwIcU/wx1SHSIilsEaXtHHaoN+FS/l/If+yy2qci4b9Ncz9ldz9DcNeis4Kw+8l1PhaMozJzP2xwvoTyfFLeziqYQf6OCg/K5whzbWy9nBQ63v4nBK38b9nH39Po/lDq3RR/R9/20VBtirfWQHw7FmvN+v9d0F98Nyh/p9BmNNf/QhA7zhHBt+2kKvNINaf4HNBfTbE/peeddf73/+pYmIiIilkz3SsM8ekT2SPZI9EhEREYuWPdKwzx6RPZI9kj0SETHZJ+GNbpFBDLWMAAAAAElFTkSuQmCC" />
                                    @endif

                                    @if ($tag->name === "Posto auto")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAFIklEQVR4nO2aTYwVRRDHf7vsW32iEWVRF1iyCH6gIDFg/AKNuqIRMJEgiUZdTh68eNOTiUcxXjiYgB8hQTExKokxYiKiIRIDGFEjWSO7CLqsghgWED9CeA8P1ZPpGWfmzbypntn18U8682a6X1V1dXV3VXdBi2NCyfwrQBtwtmQ5Ckcb8DhwGPgFeLRccYrF1cBWZNTtsh2YW6JcznEh8BJwGunwEeAJU46Yb6eBNcDEkmR0huXAT0gna8BGoMuqnwSsBc6YNiOIYsY9ZgMf4Zv5V8DNCe1vBL6w2m8D5jiW0QmqwPPAP0hHRoGnSbfrtCGjfxR/WqxFptC4wHLgR0T4OmLulzVB51Kk4zVDaxhYqSSjE0wH3sE332+B2xXoLgR2W3Q/AGYq0FVDBTHvPxABTwHPAh2KPNqBJ4EThsdfyBQ7T5FHU7gLGCA4Oj0O+V2BTKm64TcI3O+QXyymGkG8ju8D7iuQ/53AXoKKn1EE4w7E3E8axn9Snil6Uy8sS6crhncA3xHUeq8rZhkwjaA1/gDcq8kgPO/2A0s1GSjhHuB7ggM0PQ/BdsQh+Z2gQzKW/fTzkWnwNyLzcdI7YAEsAHYRdEmvVRPTPWYBH+LL/zVwW5o/dgGv4Zv7z8AKNzIWghVIH7wg7FVgctIfdvD/C0snIn3xwvDPkxofMI0Wu5ercCxG+nbA/tge03jYuTjFI7JPcQpoGbS8AtJGbFOB61wK4gADyIlzItIqYA9weS5xisdhoLtRo7QK8Dr/SdPiFIs+xIVviKyHFqpBhkOkvmlq+UWw5RWQdQr0OZGiRGRVwFYnUpSIrAoYT7tAKrT8LqB5dm+jB7gVufTUQA0YQkLZuhLNSHjhcPiw0ztZSYNn8GNv7bKHFN5djLy9RITD2hawCDl8qAFbgENKdCvAEuT2+BXk/tEJ8lrA26bdC8pygRx/n0KmwOwGbVNbgKYjdDEyMnXgZUW6HkaAzcj1+WNaRDUV8AiSF/AZ7k6U3jDPfkQRuaGpAC+lZaMizTC2IcrtRencUksBVwG3IPdzm5VoRqEOvGV+92sQ1FKAZ5LvIQuVS3gWthK4IC8xjW1wAv6i1IkkR7jGccTJegjYpEk46zZYwd/6yijDROcFFOYIvQ6sQsx+PZLnVxT6kDvM94GbtHhnsYBF+Pk6Sbl/rnAJfvLlqlBdIY7QMvNch9wke5hMMAtUC1MIXmyOIm4xyGA0hTwK8HL/9prnNcCXSD7BUeAbYJ6pqyLRXNq5bV9g3mBo/WZo7za8QLxDgIua7UQeBXieWB1/C1yI5OycAOYjPkEHcqw+KwNtb0QrhsZ8ZOU/icz3dxljnuBM4Hpk5LuRM/khJGixb5QOIoInlYNW+zmI4oYN3W7ktmcuSsmSWuHwKGK6k4AHEd9gmqk7ZvGp0vi4qmr9PmaeXUiyQwVZC84anurIsgtsMN9Wm/f1/Hcuv2nqZkTUJZWaxWdTRP06U7favG9IIa/zA5GnkPzgJYgpf4ofFo8g6SlpzXan9bsfWVzvRtabj/EVoI48FlAGxoQFPEB5N8cL8hLQUMDDpoxLaChgC5JCa8OLCNco0E+iNw+xQDVorQFZjtHTII5e7jXg3O1wzPftpA8vXwSe0xGnIfaH3hvFAHb7yL6GPw4gphJ1yLAv9D5knlNMCWOwgXBZ4LnVV8bUh2UbRM4po9oP2C/hgKKT+BTzX5EsbPu/PcRbUbh9HlSJvxI7g8QK9pxPan8Iubo7B4B/AZnhp2MfkR1HAAAAAElFTkSuQmCC" />
                                    @endif

                                    @if ($tag->name === "Ingresso privato")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAD8UlEQVR4nO2byWsUQRSHv8lIcMEtYEQFFVzQ4EXwoLjcxC0S9eiO3kMQwaMHccMN/AdEDyriXcQtGiSY6EXFKC4k6oh4cUXj2h7eK7pNZia91ExNY39QVHd11eP3XnfX1jOQ8X+Ti9EmDywGWoAFwBxgDDAMeAe8AG4Dl4BbgGdFaQ2QB3YCzxCnwqQnwHagzoFeqzQBd/AdewkcAlYBU4B6YLgerwAOA72B+t3ArKqrtsRK4DPiSC+wmXB3NA9sBPq07Ue1lSpWAj8QB84i73pUxmhbD+gnRUGYC3xChB8jXodpyAHH1dYHYGZidRUmD3Qigs+TzHlDDjinNruo8Y5xByL0FfEe+1KMRTpQD9hq0a5V6pDhywM2VcD+FsIPozZSN9AYReAybdiHTG4MLUA78EXTDWBtFMNKHrhpybmw6QERgnBEGx0NlB0qY3x/FO+rTCPifKQgtGuDVXreouffgTagAekXWoFveq3ZpmrLRA7CW608Vc9NQNqK1G3Va9dtKK0gkYLwVSuO0nMzC1yIDIkFoEOvNei1T9Yl2ycYhG5TOKxIRVP2W/M/ml8HRujxc81tzA9qjtdIlKbp+RX8Du8M/y5qdmn5tQppaQTuMngoi1Me+hXowO/YcvirwN/AHm08EdgN/NRra2I4NxRB0UHhScpDdYIH8IfB9Xr8JWB4YNqX3NdBDBRt6zjUMLhEGxSQR9tD7vYK5HX4rOka8e58Hn+nKOwExtbTEJpHgcb9wPgYjpYi7FS42HvcbaE8ssirURuXIRWLIZDO7x4i9BJ2lq45ZB7hIR1rTS+HAS7jPwUnSb4hcgJ/0lTzGyIAT/GHPw+4AIyLYWcs/kZIP7DclsBK8x4RvQ7Z7/eQSdI2is8gB5JH+hLzzn9ARpLUYDZD64HpyMcO80q8QvYJm5FF00hNU4DVyJK6L1C/E/mAkirMosjM/3PABv4dIodKj5EnpuY7vGIUECcmF7k2H9iLTIZ68GeKv5BF00FgESlfLD1EnGoKUXce/owrVZR7NN9oHmbImqF5bzI51adcALo0XxTCznzNe5LJqT7lAtCp+cIQdpZp3lG2VsqYQ/Tt59lOlFaACcB9ogegB5jkQK9Vgmtps0NcAEaHbBN57V1LFHPEfMU5FaNtqijlwDz8rfHT+N8LothIBXcpLXw5/tTYo3xvX3T/PQ0Y50rdtRnAReSnLreGsNUYsJcabAtORQBSuUqzSRYA1wJckwXAtQDXZAFwLcA1WQBcC3BNFgDXAlyTBcC1ANdkAXAtwDVZAFwLcE0wAOZb4BILdpcOsJkKyv0nIG46WFUPElKPBMH8LiBJKqit+qp6kJERmb9+JtpCrx5QUQAAAABJRU5ErkJggg==" />
                                    @endif

                                    @if ($tag->name === "Patio o balcone")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAADmklEQVRoge2ZW29NURSFv6MipT1oXVqtSyhNEYIntygSvEq8uPwCfkjLD+BBvIg/QSLFgxAPCB5UaSktJVW3REqphz1n99irp9rd0u6enJGcjN1x5lprjnXfpznSY3gSZSaDXJrgOf8ri+nG3CmUnWiP+QimjU+FohmRkpGsoWQkaygZyRqKxkiqa4ChdEX5nyhdUbKGkpGsoWQkaygZyRqKysg84BzQC/QAraZlFWPme5boNNVPy18q8piJ4l/Hj5lvj/2xG9hjzz0pGp5uFMxX71o54DaTuxFPJ+rlea9+0crooZptnxaIFkor0eKZ6YTSfnrNRGJzarAvO0liwPRa0S6Ydlq0w6bdDMoXWry3TDsk2hnTzou2wrSPQfku09e5oOdIo/EL0fLAYmAQ6BN9pXGvaJXGXxkfHlMpmte1UrQ+4AdQBSwU3Tt7vQtqZJOxGvHAbpK96gtOjSww/lY49wTcSIVovlOqkd/WNkjvA8+NN7ugRvYb3xFti/HjIJFVxm9Eyxt/CbMugEIjUsiItr1FtLvGB1xwI3OBffasc9wLPxKtHFgK/ALei+69m2ZE1Eif1bnM2nB421tFazNuttxHjOwimoMdwCspsN34oWiriM4ab9jhI5JmjeRF+2V15ohHHOBBkAuWY4flvFONHDG+KsE5KXxf9DXG4ek/1akF8ZpbLZob2UHysL5mfBhiI3uM2ySwFqgm2n5fi77C+G2QhCeVZmrlA92N1InWbTlUkTwCPNe9EBtpMn4mgV6ZTjWIzGmjjqlOLa2zOtA9BzXouTZBbKQ6KACw3PhdUKkv6s+BXmY8xPjwmLJA9zorAt1zWCbaS+MlEBsZNNZD54PxcpLwU7Y+0D2JxYyPKuNPge5bb3+g1wQ5ASwy/g6xkQ7jjRLYZbyBZM/5Im8IGvOkJmLEkwhH1Q89nbZlxAdzl+i+HF5AbMR3gGMS2E80D/PANtF9bq4NkkgzIh4TGvE6da1usxzaSd65jhpfh9jIZePjwHwJvmHcLFon0RyvIbl9phkRj9GpVWl1DpG8uHrbelCXAyfs+QrERtqJXqqqgZNSwAsfFO2nNZQjvmhqUpM10mh1dlobDm9bjZwiul3cA56oEYBLxqGRYaLri75NPjVuEm3AuIrx4TEDonldT0Xzq1P4euA5XixUeR0z/6KU9jOyc4bv5+ELUNYxkv9Y/+jJ+g8Qozq8aH5pHGtEZtsUK54R+QPUalTm0pvomQAAAABJRU5ErkJggg==" />
                                    @endif

                                    @if ($tag->name === "TV")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAADp0lEQVRoge2Zu09UURDGf4uyKLpADAFENIoJPqLRCIU2VmpiLFA7axMKfPQWlhZamBg7O/0jlMIYQyJoBMRHBIwiERofIcAi8hDWYuZ4l8Mu3HPvZXdJ+JKTuZw9c2e+O3NeA6xjHSuhBugCOvPtSBjUAH1ACugBYvl1JxiqgQ8IiX6gNr/uBMM6iSjxGuhF8tsV6XOiL+A7IkNvQEcKigRAFV5qDOAvNQomnWy4kClYEgZ+yBQ8CYPlyKwZEgaZyKw5Egb2ipTT1akEuAa8BCbVcCG2SeRAeRWI2yR24O0Ha6n1kJamJSze1JqBhM20gJAAziNzLQV0A/EYcB24pz+cAMYsxf3AGeAYsBfYBmwByrRt8GF8HphA0uIP8AsYQr7oU+BtAEIVyDTYh6QZr5RZszWwCWgnNynSBZwMQOai6nfGgCSwFfm6SR1wCXgIFAO/gWfAe+AdMAKMI1/YjB/TF2ZCHIngZiQtEsBOJNKHkGhXIlFrBR44EClTX5LgfRWDo8C09t1l9edLHLiBEJlD0tsF//23iTzWv++E99EJN9Vuu6NeRiJ1wAKSKrleuUqBUfWlwUEvBaSKrM7TyIW/DS//c4UptQtwylXZJnJAZXcYj0KgV6VLRIClROpVDoVyJzi+qtxj9Z9DVsth4Gw25fQ50qPPjRE76BdNat/eIIfx/Pxm/ZZxjlSp/B61hz5h7Fa6KtpEzGlyJpQ7wWHs2qfaFrzUasmmnJ5aE/qcr0NjudqfcNDJmFolKvMVkWmVS+4ZfpAekXl9tgnmCkVqf95BJ2NE/qrcGIVXAVCscs5V0SZiUqrEHpgjBE5tm4jJ0U2h3AmObKum84Y4os91ETvoF3Vqf9jqd94Qf6isjtpDnzB2f7oq2kQGVdbbA3MEc8YatPpX3BDt1cm8YHdkrrnBEPli9T9BrsdZYUekT2VTBE4FgTmsfgqiXCg3RFNIWGCFr2+h4O7st9Vu20oDLWQlcoTFVZSy8D4ui1LgFhKJGdzvQikgFUNOmgmy17WmWFrXmsCrbYHUvmYzGClCTrQgtbOEyl3AQeAwUicoR45Hl4FHDiTKkWmQBCk7ppB6ajoaged4EVvN9gL3ehZ4lcaOGFI3vY/8U+Y4S2u/DchXa2Rx7bdCpZ8j9ywStXEkwqPAZ+ANUvv9GIBEBVLubQCuoI6Yu3o/cIHVnxdhUIZEYgCvbmxOzdTikVlLrQvYbjONIyHqQCZPvp3M1pLInGpNj8Q/XIXyUJ3Ts08AAAAASUVORK5CYII=" />
                                    @endif

                                    @if ($tag->name === "Wi-fi")
                                        <img
                                            src="data:image/png;base64,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" />
                                    @endif

                                    @if ($tag->name === "Riscaldamenti")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAADpklEQVR4nO2bT0hUQRzHP5Zpf1wtCw8Z/ZMuQREdKioigiAvgVnXwKuaxy4evEp1qUP0DzpE0K3AWyT0Ry0PZkSBJB1qsSLTQ2tISm2H+T3ea911982bmd1l3weG2Tdv5n2/Mzv73vx5CzExMTExWtQCPcArYA5IOw5zot0N1Fiu6xKagTeaxm2EcfHkhFr8yn8G2oGEK/EACaANmBAvr3HUE3rwK9/oQjAPjUAS5anLheCoiLW7ECuQcyhPL12IpUSsGN0+F/UoTz9diHk3nlJDy9cKwyaGMX+HzwxDJg1XaZTxWjlbWVc9YzntUHWqju4lKzoNWwjGG9j0T6DsKFYDXAa+A1eAuiJ50Ga5u22hd+KZQN5PwFGH2pExYWJA8v2SeB4460g7MiZMdEu++8Al+fwbOOhAOzK6Jm6hRpG9wAHJ907O9cvxR2CVBW2j6JhYB/wJnL8m8Yycr0ZNadNAH/AFeAs0GdA2jo6JQ5L+DVjAb4zZQJ6OQHkv3DSgbRwdE1clvR/16PPyjQby7GJpA8wDmyJqGyesiS2oivwF9gJ7Avl6A/k2BtKngCfyuSOCthXCmrghaQ8CaU9R3/6aQFpLoPx51OJGGrgbQdsKYUxsRz3eFlFdfDnOSNlncnxEjkc0tQvC9lC4C7VOdw+YzJP3pMSDEk9LvNWCr0iE+Ra8R9uxPNesAr5K3n2S1iTHwVWesvsJzMrx+jzXrEItdAwE0mqk7KKmtjXCmFiQY53l6jopm9LULgjb94CkxNs0yrZIPGXIS1ZsN8C4xK0aZU9L/NyQF2OE6YbtcjwJrA6h0YB6CqSBE5ra1ghjYiVqyyoNXC/w+iuAh1JmMONc2TUAwH783ePb/D/6y2QD8Ejy/gB2RNS2go6JVvwdpSRwETUnSABrUY3Uh9/tp4HDhrSNo2tiN2o/P3PGlxkeAzsNaxslqolTwB3UtvYcaqb4HrVidNyythGKaaLsBkIlT5S9wVIlVJ0qvgdE2Ry1tQGqi1bPrPgeEDdAsQ0Um7gBDFxjGHhRImlOyBxxZRuBFSMtHgnqoDMOmEMtWCZQU9whlra867QGiVM4wJvStrkQKxBv6W0kX0YTXBCxCUrnZekPKE+dLgRr8Xd8kqgXletdCGdQj/rmvcqP4fCPE834jVAKYQzYbLXGWahBvew0gr/e5zKkRLuTIvxlJheFPsNdXysnFT8OqPgGsPW2uMluanUJznQPyPVnBp1Ji8lrxcTk4B/ezjGC6CSq5QAAAABJRU5ErkJggg==" />
                                    @endif

                                    @if ($tag->name === "Aria condizionata")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAFE0lEQVR4nO2aX4gVVRzHP7tKJvsnbS3QTN2SwAID36QyqPZlxQcfkqJQqGTB6iUF7UUqQxGSwFwhqId6CduXepFoN43WJamsl3BbAqVtW1uI3TW3TN3d6eH3O83ce2funDN35nbvdb5wmHtmfr/f+f7OnPM7v3PuQI4cOXIImoCXgBFgHvAarMwDPwG71NcSvFwDJKtVdoV1wIg+fCqkh4xivSCMbxPwtN4fDlOa04fNlgZrGVF8m/X+nItS3LNqYgjhMRhzz9qXsLddy5jXqxdzLxHqYQTYomFHQOpY6ChfT6PACrYj4EymLLLBYLxIIeptnidFHgOCsOmA1cAAcI3/P4W1LdeAfmCVS2dETYGBGnAoafncwc/IB+bN3x6mVKPowB8JxXDugHoNjlb+uOQB9dgJsbjpVwGXERB6ilLDsBqxN/0ICL7VhpzjZdAEhSOgHvP9pHDeJ+TIIRjCbvjUulwiLEYC5d8xcm0q94+FTdss06TjbTFyV1XuVgubgNsyeJ9ex2LkVuj1soPtOBhbK8pKwbhe19oadumAJ/X6ZYzccr1ecLAdB2NreVkpOK3XbSm2DcA9wJ/I8NoYI7sW+APYZ2HXdgq8AvwO3Bsj95Dauwx0Wti1xjk1/FGaRslmp3lCbX6XptEvgK+B1hi5TuA34HVLuy4d8AYSf9bEyLUhXAcs7aaKDxGHjlnKu3RAr8p+kIBXVbARmEWWLNv559IBq9X2HPCwM7uMsRT4GXHmgIPeIPCVg/yb2sYIsMRBL1MsRmKEB3wP3JJhW4uAH7StfhwSnqzQDpxCCI0DdzvqJ0ldV2lbHtLx7Y76qeJbJTIGrEugn3QZvF/b9IBvEuhb4W3gErAX6Ebm6gUK594ZJEdImnRUkgd0IlMuOII6gFGEazfCfRx4y8Xwa1qOBgiaMqqG+4jPy22QViJ0F5IAbUHykGLeR5DgHJufLESWGbOT6wIm1MghJBE6pvWeFIi7rgJR6EE49SIcD2l9AvEB/CW04CC4eDO0RO+ZLW8//u6vD5gB/tL60hSIPwJsSsGO4TKjpU/rY4gPILybKbN8rgPO4g+bk8Bu4IrWTwD7tQEPmAZ2pkC+UuxEuHgIt/34+4EriA8n8f06S0TANkP9V2CK0nkULD8Gfm9OQHoIOA9s1zKMLGmu2BLBKaxMqW8eEtxLcAAJFu3AHUrKQ3pwDTCp9a0qvw34mPg9usEi4H3gWfxP24LltD57D/tkaqVyMPv/rWprUjnv1vqw+tSuPv4XDIMxICoal/tHyOVAZT3wHPKZ6iZgR+DZDuAJ4EXgeeBBS5tzjhwMQn26RLIp0G3ZaBd+CmtQvAz2a70LO2yO4JRoCmQZBB8HLqreLPAucDDQ1kG9N6v1i6pjgxdIKQgCLMOfQwbmNGiD1g9r3ebICyR3v4G/i7tO9Fu6jv/R9g3s9xZ7Veew1jdo/VxAxsSwZUHF4vkzjcyrFq13IYEG5FC0Ff9UaBI7TCAHJXuAB5BYcFWfPaYFvbdeZfaozoRlG4aL4WcOcFfiT6cWxLfpoGLx3+OzwKsq3Evhd/X7kGDVA9wGfGJJDpL9te6i8ynwKPAZMoJMmn4n8p3QO0h2OIP4aIWjlG6GRnH/VqgaU8CgA/iF0s3QEUc7qSPLIFg3MMtg8LS20mWwYlTzC5EpvbYAC5AU2GC73mstkm0oLACOA88QngoPIqnwcZVtaJxC8vNKN0M5cuTIURH+Bdnxog6mBPpFAAAAAElFTkSuQmCC" />
                                    @endif

                                    @if ($tag->name === "Vicino al centro")
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAB9klEQVR4nO2bTU7DMBCFXysOAJvcAYmrlJPAAo4Ep6CsALEDNuUAvQPqtmHRieq6tic/HjtO5pMs1fbEMxnbL0nTAooiTU1llCxzB8AgnryxJ0CcHAkY1ZbQFRBpnE8cZ9YuDb56qIRsP2IEvogxCPIt6cHxX8SIwiBWQjmiJVw1oEX/O4C3FrYmbfd/33oybg3nq4Cd9AlnS8ir4WwdsEs9Q0n8XQPYA/ijsqe2bAFJ+Avt63scVP0JwDN9vms5brFLvuESh1mvAdzguBp2AK4c9pPTgEdy8GK0rantwWFf7BZwUQHY4lz5V9S2JZtkATkQ81cB+KXBf3CqEUtqq8nGTMJktsA3DbzB+SyD2jZk89UhwGIS0AzsOvmGKmVAHqL5sx9eaqvddmK3++rSRPMn9TBUzJLnHodTzWg2Yn8f0GAnLnY9GlwCfBowGUrXgLpjOfsekbsK+OCuAqnqfTg5t9I1oMuWdCZt9hogtQKkt4DLl4/gpOl9gNC4Ke8DBk2SaoDQuKoBpaAawPSrBvRENaAUVAOYftWAnqgGlIJqANOvGtAT1YBSUA1g+lUDCmCQBnAvRhZWGUroR9XelxeSSL0Y4Y7rGhfnvw3OY3JpgMQbn17MXgP0PiB3ABEYNEn6f4HcAeTGXD7JFTgzC0BXgDJ7/gHylyokxUV0DQAAAABJRU5ErkJggg==" />
                                    @endif
                                    
                                        
                                @endforeach
                            </div>

                            {{-- descrizione --}}
                            <div class="col-lg-12 col-md-12 col-sm-12 text-break p-3">
                                <h5 class="px-3">
                                    Su questo annuncio:
                                </h5>
                                <p class="ap_text font-monospace lh-base overflow-hidden mb-0 px-3 h_100 op">
                                    {{$apartment->description}}
                                </p> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
@endsection