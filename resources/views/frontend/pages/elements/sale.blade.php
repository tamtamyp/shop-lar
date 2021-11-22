<div class="wrap-show-advance-info-box style-1 has-countdown">
    <h3 class="title-box">On Sale</h3>
    <div class="wrap-countdown mercado-countdown" data-expire="2021/12/12 12:34:56"></div>
    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false"
        data-nav="true" data-dots="false"
        data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
        @php
            $items = DB::table('product')->where('status', 'active')->orderby('id','desc')->get();
        @endphp
        @foreach ($items as $item)
            @php
            $id=$item->id;
                $thumb      = $item->thumb;
                $name       = $item->name;
                $price      = $item->price;
                $sale_price = $item->sale_price;
                $link = route('san-pham/index', ['product_id' => $id, 'product_name' => Str::slug($name),]);
                $sale = round((($price-$sale_price)*100/($price)),0);
            @endphp
        @if (!empty($item->sale_price))
            <div class="product product-style-2 equal-elem ">
                <div class="product-thumnail">
                    <a href="{{ $link }}" title="{!!Str::slug($name)!!}">
                        <figure><img
                                src="{{ url('templates/images') }}/{!! $thumb !!}"
                                style="width:214px;height:214px;" alt="{!!Str::slug($name)!!}">
                        </figure>
                    </a>
                    <div class="group-flash">
                        <span class="flash-item sale-label">{{$sale}}%</span>
                    </div>
                    <div class="wrap-btn">
                        <a href="{{ $link }}" class="function-link">quick view</a>
                    </div>
                </div>
                <div class="product-info">
                    <a href="{{ $link }}" class="product-name"><span style="height:35px;">{!! substr($name,0,50) !!}</span></a>
                    <div class="wrap-price"><span class="product-price">
                        <del aria-hidden="true"><span
                            style="color:red;">{{ number_format($price) }}&nbsp;</span></del>
                    <span>{{ number_format($sale_price) }}&nbsp;<span>₫</span></span>
                    </span></div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
