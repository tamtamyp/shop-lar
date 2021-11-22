@extends('frontend.main')
@section('content')
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                </ul>
            </div>
            <div class=" main-content-area">
                @if (session()->has('cart'))

                    <div class="wrap-iten-in-cart">
                        <h3 class="box-title">Products Name</h3>
                        <ul class="products-cart">
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($cart as $id => $cartItem)
                                @php
                                    if (!empty($cartItem['sale_price'])) {
                                        $total += $cartItem['sale_price'] * $cartItem['quantity'];
                                    } else {
                                        $total += $cartItem['price'] * $cartItem['quantity'];
                                    }
                                @endphp
                                <li class="pr-cart-item">
                                    <div class="product-image">
                                        <figure><img src="{{ url('templates/images') }}/{!! $cartItem['thumb'] !!}" alt="">
                                        </figure>
                                    </div>
                                    <div class="product-name">
                                        <a class="link-to-product"
                                            href="{{ route('san-pham/index', ['product_id' => $cartItem['id'], 'product_name' => Str::slug($cartItem['name'])]) }}">{{ $cartItem['name'] }}</a>
                                    </div>
                                    <div class="price-field product-price">
                                        <p class="price" align="right">
                                            @if (!empty($cartItem['sale_price']))
                                                <del aria-hidden="true"><span
                                                        style="color:red;">{{ number_format($cartItem['price']) }}&nbsp;<span>₫&nbsp;&nbsp;</span></span></del>
                                                <span>{{ number_format($cartItem['sale_price']) }}&nbsp;<span>₫&nbsp;&nbsp;</span></span>
                                            @else
                                                {{ number_format($cartItem['price']) }}&nbsp;<span>₫&nbsp;&nbsp;</span>
                                            @endif
                                    </div>
                                    <div class="quantity">
                                        <div class="quantity-input">
                                            <input type="text" name="product-quatity" value="{{ $cartItem['quantity'] }}"
                                                data-max="120" pattern="[0-9]*">
                                        </div>
                                    </div>
                                    <div class="price-field sub-total">
                                        <p class="price">

                                            @if (!empty($cartItem['sale_price']))
                                                {{ number_format($cartItem['sale_price'] * $cartItem['quantity']) }}&nbsp;<span>₫</span>
                                            @else
                                                {{ number_format($cartItem['price'] * $cartItem['quantity']) }}&nbsp;<span>₫</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="delete">
                                        <a href="#" data-url="{{ route('gio-hang/delete', ['id' => $cartItem['id']]) }}"
                                            class="btn  delete-cart" title="">
                                            <span>Delete from your cart</span>
                                            <i class="fa fa-times-circle" aria-hidden=""></i>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @if (count($cart) > 0)
                        <div class="summary">
                            <div class="order-summary">
                                <h4 class="title-box"></h4>
                                <p class="summary-info "><span class="title">Total</span><b
                                        class="index">{{ number_format($total) }}&nbsp;<span>₫</span></b></p>
                            </div>
                            <div class="checkout-info">



                                <a class="btn btn-checkout" href="{{ route('dat-hang') }}">Check out</a>

                                <a class="link-to-shop" href="{{ route('san-pham') }}">Continue Shopping<i
                                        class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="update-clear">
                                <a class="btn btn-clear clear-shoping-cart" href="#"
                                    data-url="{{ route('gio-hang/clear') }}">Clear Shopping Cart</a>
                                <a class="btn btn-update" href="{{ route('gio-hang') }}">Update Shopping Cart</a>
                            </div>
                        </div>
                    @else Bạn chưa thêm sản phẩm vào giỏ hàng <br>
                    @endif
                @else Bạn chưa thêm sản phẩm vào giỏ hàng
                @endif

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
@endsection
