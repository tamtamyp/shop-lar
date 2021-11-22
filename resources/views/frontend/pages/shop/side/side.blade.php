<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
    <div class="widget mercado-widget categories-widget">
        <h2 class="widget-title">All Categories</h2>
        <div class="widget-content">
            <ul class="list-category">
                @foreach ($category as $cate)
                    @php
                        $link = route('san-pham/danh-muc', ['id' => $cate->id, 'category_name' => Str::slug($cate->name)]);
                    @endphp
                    <li class="category-item has-child-cate">
                        <a href="{{ $link }}" class="cate-link">{{ $cate->name }}</a>
                        @if ($cate->children->count() > 0)
                            <span class="toggle-control">+</span>
                            @foreach ($cate->children as $child)
                                @php
                                    $link = route('san-pham/danh-muc', ['id' => $child->id, 'category_name' => Str::slug($child->name)]);
                                @endphp
                                <ul class="sub-cate">
                                    <li class="category-item"><a href="{{ $link }}"
                                            class="cate-link">{{ $child->name }}</a></li>
                                </ul>
                            @endforeach
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- Categories widget-->

    {{-- <div class="widget mercado-widget filter-widget brand-widget">
        <h2 class="widget-title">Brand</h2>
        <div class="widget-content">
            <ul class="list-style vertical-list list-limited" data-show="6">
                <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li>
                <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
                <li class="list-item"><a class="filter-link " href="#">Printer & Ink</a></li>
                <li class="list-item"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                <li class="list-item"><a class="filter-link " href="#">Sound & Speaker</a></li>
                <li class="list-item"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
                <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                <li class="list-item default-hiden"><a class="filter-link " href="#">Sound & Speaker</a></li>
                <li class="list-item default-hiden"><a class="filter-link " href="#">Shop Smartphone & Tablets</a>
                </li>
                <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>'
                        class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down"
                            aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div> --}}
    <!-- brand widget-->

    <div class="widget mercado-widget filter-widget price-filter">
        <h2 class="widget-title">Price</h2>
        <div class="widget-content">
            <div id="slider-range"></div>
            <p>
                <label for="amount">Price:</label>
                <input type="text" id="amount" readonly>
                <button class="filter-submit">Filter</button>
            </p>
        </div>
    </div><!-- Price-->

    {{-- <div class="widget mercado-widget filter-widget">
        <h2 class="widget-title">Color</h2>
        <div class="widget-content">
            <ul class="list-style vertical-list has-count-index">
                <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
            </ul>
        </div>
    </div> --}}
    <!-- Color -->

    {{-- <div class="widget mercado-widget filter-widget">
        <h2 class="widget-title">Size</h2>
        <div class="widget-content">
            <ul class="list-style inline-round ">
                <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                <li class="list-item"><a class="filter-link " href="#">M</a></li>
                <li class="list-item"><a class="filter-link " href="#">l</a></li>
                <li class="list-item"><a class="filter-link " href="#">xl</a></li>
            </ul>
            <div class="widget-banner">
                <figure><img src="{{ asset('templates/frontend/assets/images/size-banner-widget.jpg') }}" width="270"
                        height="331" alt=""></figure>
            </div>
        </div>
    </div> --}}
    <!-- Size -->

    <div class="widget mercado-widget widget-product">
        <h2 class="widget-title">featured Products</h2>
        <div class="widget-content">
            <ul class="products">
                @foreach ($featured as $item)
                    @php
                        $id = $item['id'];
                        $thumb = $item['thumb'];
                        $name = $item['name'];
                        $price = $item['price'];
                        $sale_price = $item['sale_price'];
                    @endphp
                    <li class="product-item">
                        <div class="product product-widget-style">
                            <div class="thumbnnail">
                                <a href="{{route('san-pham/index', ['product_id' => $id, 'product_name' => Str::slug($name)])}}" title="{{ Str::slug($name)}}">
                                    <figure><img src="{{ asset('templates/images') }}/{!! $thumb !!}" alt=""
                                            style="width:83px; height:83px;"></figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="{{route('san-pham/index', ['product_id' => $id, 'product_name' => Str::slug($name)])}}" class="product-name"><span>{!! substr($name, 0, 50) !!}</span></a>
                                <div class="wrap-price"><span class="product-price">
                                        @if (!empty($sale_price))
                                            <span>{{ number_format($sale_price) }}&nbsp;<span>₫</span></span>
                                        @else {{ number_format($price) }}&nbsp;<span>₫</span>
                                        @endif
                                    </span></div>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div><!-- brand widget-->

</div>
<!--end sitebar-->
