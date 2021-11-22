@extends('frontend.main')
@section('content')
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                </ul>
            </div>
            <div class=" main-content-area">
                <div class="wrap-address-billing">
                    @if (count($errors) > 0)

                                    <div class="alert alert-danger">

                                        @foreach ($errors->all() as $err)
                                            {{ $err }}<br>
                                        @endforeach

                                    </div>

                                @endif
                    <h3 class="box-title">Thông tin thanh toán</h3>
                    <form action="{{route('dat-hang/save')}}" method="post" name="frm-billing">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <p class="row-in-form">
                                <label for="fname">Họ và tên<span>*</span></label>
                                <input id="fname" type="text" name="fname" value="" placeholder="Nhập tên"
                                    required="required">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Số điện thoại<span>*</span></label>
                                <input id="phone" type="number" name="phone" value="" placeholder="Nhập số điện thoại"
                                    required="required">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Email<span>*</span></label>
                                <input id="email" type="email" name="email" value="" placeholder="Nhập email"
                                    required="required">
                            </p>
                            <p class="row-in-form">
                                <label for="add">Địa chỉ:<span>*</span></label>
                                <input id="add" type="text" name="address" value="" placeholder="Nhập địa chỉ"
                                    required="required">
                            </p>
                            <p class="row-in-form">
                                <label for="add">Ghi chú:</label>
                                <input id="add" type="text" name="note" value="">
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="wrap-iten-in-cart">
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
                                            <div>{{ $cartItem['name'] }}
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
                                            <div class="quantity">
                                                <div class="quantity-input">
                                                    <input type="text" name="product-quatity"
                                                        value="{{ $cartItem['quantity'] }}" data-max="120"
                                                        pattern="[0-9]*">
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <div class="order-summary">
                                        <h4 class="title-box"></h4>
                                        <p class="summary-info "><span class="title">Tổng tiền hàng: </span><b
                                                class="index">{{ number_format($total) }}&nbsp;<span>₫</span></b>
                                        </p>
                                        <p class="summary-info "><span class="title">Phí vận chuyển: </span><b
                                                class="index">{{ number_format(30000) }}&nbsp;<span>₫</span></b>
                                        </p>
                                        <p class="summary-info "><span class="title">Tổng thanh toán: </span><b
                                                class="index"
                                                name="">{{ number_format($total + 30000) }}&nbsp;<span>₫</span></b>
                                        </p>
                                        <input style="display:none;" type="text" name="total"
                                                        value="{{ $total + 30000 }}" data-max="120"
                                                        pattern="[0-9]*">
                                    </div>
                                    <br><br>
                                    <div class="summary-item ">
                                        <button type="submit" class="btn btn-medium">Đặt hàng</button>
                                    </div>
                                </ul>
                            </div>

                        </div>

                    </form>
                </div>
                


            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
@endsection
