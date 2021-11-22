
<?php
use App\Helper\Templates;
$prefix = 'san-pham';
?>
<div class="row">
    @foreach ($product as $item)
        @php
            $id = $item['id'];
            $name = $item['name'];
            $thumb = Templates::showImageProduct($controllerName, $item['thumb'], $name);
            $price = $item['price'];
            $sale_price = $item['sale_price'];
            $link = route('san-pham/index', ['product_id' => $id, 'product_name' => Str::slug($name)]);
        @endphp
        <div class="product product-style-3 equal-elem col-lg-4 col-md-6 col-sm-6 col-xs-6  ">
            <div class="product-thumnail">
                <a href="{{ $link }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                    <figure>
                        {!! $thumb !!}
                    </figure>
                </a>
            </div>
            <div class="product-thumnail">
                <div class="product-info">
                    <a href="{{ $link }}" class="product-name"><span
                            style="height:40px; width:250px;">{{ $name }}</span></a>
                    <div><span class="product-price"><b style="font-size:14px;">
                                @if (!empty($sale_price))
                                    <del aria-hidden="true"><span
                                            style="color:red;">{{ number_format($price) }}&nbsp;</span></del>
                                    <span>{{ number_format($sale_price) }}&nbsp;<span>₫</span></span>
                                @else {{ number_format($price) }}&nbsp;<span>₫</span>
                                @endif
                            </b>
                        </span>
                    </div>
                    <a href="#" data-url="{{route('gio-hang/add',['id'=>$id])}}" class="btn add-to-cart">Add To Cart</a>
                    <br> <br> <br>
                </div>
            </div>
        </div>
    @endforeach
</div>
