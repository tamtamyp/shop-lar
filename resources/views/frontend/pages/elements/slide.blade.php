@php
use App\Helper\Templates;
@endphp
<div class="wrap-main-slide">
    <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
        @foreach ($items as $item)
            @php
                $description = $item['description'];
                $name        = $item['name'];
                $thumb = Templates::showImageHome($controllerName,$item['thumb'],$name);
                $link = $item['link'];
            @endphp
            <div class="item-slide">
                {!!$thumb!!}
                {{-- <img src="{{ asset('templates/frontend/assets/images/main-slider-1-1.jpg') }}" alt=""
                    class="img-slide"> --}}
                <div class="slide-info slide-1">
                    {{-- <h2 class="f-title">Kid Smart <b>Watches</b></h2> --}}
                    <span class="subtitle">{!! $description !!}</span>
                    {{-- <p class="sale-info">Only price: <span class="price">$59.99</span></p> --}}
                    <br>
                    <a href="{{$link}}" class="btn-link">Shop Now</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
