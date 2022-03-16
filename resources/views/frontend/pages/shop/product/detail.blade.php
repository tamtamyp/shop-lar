<?php
use App\Helper\Templates;
$prefix = 'san-pham';
?>
@extends('frontend.main')
@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">
            @foreach ($items as $item)
                @if (empty($item['thumb_list']))
                    {
                    <style>
                        button.owl-prev  {
                            display: none
                        }

                        ;

                        button.owl-next {
                            display: none;
                        }

                    </style>
                    }
                @endif
                @php
                    $id = $item['id'];
                    $name = $item['name'];
                    $description = $item['description'];
                    $content = $item['content'];
                    $status = $item['status'];
                    $categoryName = $item['category_name'];
                    $thumb = $item['thumb'];
                    $type = $item['type'];
                    $created = $item['created'];
                    $created_by = $item['created_by'];
                    $price = $item['price'];
                    $sale_price = $item['sale_price'];
                @endphp
                <div class="wrap-breadcrumb">
                    <ul>
                        <li class="item-link"><a href="#" class="link">home</a></li>
                        <li class="item-link"><span>{{ $name }}</span></li>
                    </ul>
                </div>

                <div class="row">

                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                        <div class="wrap-product-detail">
                            <div class="detail-media">
                                <div class="product-gallery">
                                    <ul class="slides">
                                        <li data-thumb="{{ url('templates/images') }}/{{ $thumb }}">
                                            <img src="{{ url('templates/images') }}/{{ $thumb }}"
                                                alt="product thumbnail" style="width:470px; height:470px;" />
                                        </li>
                                        <?php
                                        $thumb_list = json_decode($item['thumb_list']);
                                        ?>
                                        @if (is_array($thumb_list))
                                            @foreach ($thumb_list as $img)
                                                <li data-thumb="{{ url('templates/images') }}/{{ $img }}">
                                                    <img src="{{ url('templates/images') }}/{{ $img }}"
                                                        alt="product thumbnail" style="width:470px; height:470px;" />
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="detail-info">
                                {{-- <div class="product-rating">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <a href="#" class="count-review">(05 review)</a>
                                </div> --}}
                                <h2 class="product-name">{{ $name }}</h2>
                                <div class="short-desc">
                                    {!! $description !!}
                                </div>
                                <div class="wrap-price"><span class="product-price">
                                        @if (!empty($sale_price))
                                            <del aria-hidden="true"><span
                                                    style="color:red;">{{ number_format($price) }}&nbsp;</span></del>
                                            <span>{{ number_format($sale_price) }}&nbsp;<span>₫</span></span>
                                        @else
                                            {{ number_format($price) }}&nbsp;<span>₫</span>
                                        @endif
                                    </span></div>
                                <div class="quantity">
                                    <span>Quantity:</span>
                                    <div class="quantity-input">
                                        <input class="update-Quantity" data-id="{{ $id }}" type="text"
                                            name="product-quatity" value="1" data-max="120" pattern="[0-9]*">

                                        <a class="btn btn-reduce" href="#"></a>
                                        <a class="btn btn-increase" href="#"></a>
                                    </div>
                                </div>
                                <div class="wrap-butons">
                                    <a href="#" data-url="{{ route('gio-hang/add', ['id' => $id]) }}"
                                        class="btn add-to-cart">Add to Cart</a>

                                </div>
                            </div>
                            <div class="advance-info">
                                <div class="tab-control normal">
                                    <a href="#description" class="tab-control-item active">Content</a>
                                </div>
                                <div class="tab-contents">
                                    <div class="tab-content-item active" id="description">
                                        {!! $content !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->

                    <!--end main products area-->

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                        <div class="widget widget-our-services ">
                            <div class="widget-content">
                                <ul class="our-services">

                                    <li class="service">
                                        <a class="link-to-service" href="#">
                                            <i class="fa fa-truck" aria-hidden="true"></i>
                                            <div class="right-content">
                                                <b class="title">Free Shipping</b>
                                                <span class="subtitle">On Oder Over $99</span>
                                                <p class="desc">Lorem Ipsum is simply dummy text of the
                                                    printing...
                                                </p>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="service">
                                        <a class="link-to-service" href="#">
                                            <i class="fa fa-gift" aria-hidden="true"></i>
                                            <div class="right-content">
                                                <b class="title">Special Offer</b>
                                                <span class="subtitle">Get a gift!</span>
                                                <p class="desc">Lorem Ipsum is simply dummy text of the
                                                    printing...
                                                </p>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="service">
                                        <a class="link-to-service" href="#">
                                            <i class="fa fa-reply" aria-hidden="true"></i>
                                            <div class="right-content">
                                                <b class="title">Order Return</b>
                                                <span class="subtitle">Return within 7 days</span>
                                                <p class="desc">Lorem Ipsum is simply dummy text of the
                                                    printing...
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- Categories widget-->

                        <div class="widget mercado-widget widget-product">
                            <h2 class="widget-title">Popular Products</h2>
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
                                                    <a href="{{ route('san-pham/index', ['product_id' => $id, 'product_name' => Str::slug($name)]) }}"
                                                        title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                        <figure><img
                                                                src="{{ asset('templates/images') }}/{!! $thumb !!}"
                                                                alt="" style="width:83px; height:83px;"></figure>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <a href="{{ route('san-pham/index', ['product_id' => $id, 'product_name' => Str::slug($name)]) }}"
                                                        class="product-name"><span>{!! substr($name, 0, 50) !!}</span></a>
                                                    <div class="wrap-price"><span class="product-price">
                                                            @if (!empty($sale_price))
                                                                <span>{{ number_format($sale_price) }}&nbsp;<span>₫</span></span>
                                                            @else
                                                                {{ number_format($price) }}&nbsp;<span>₫</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                    </div>
                    <!--end sitebar-->

                    {{-- <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Related Products</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('templates/frontend/assets/images/products/digital_04.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('templates/frontend/assets/images/products/digital_17.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('templates/frontend/assets/images/products/digital_15.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('templates/frontend/assets/images/products/digital_01.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('templates/frontend/assets/images/products/digital_21.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('templates/frontend/assets/images/products/digital_03.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('templates/frontend/assets/images/products/digital_04.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('templates/frontend/assets/images/products/digital_05.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                        </div>
                    </div><!--End wrap-products-->
                </div>
            </div> --}}


                </div>
                <!--end row-->
            @endforeach
        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
