<?php

use App\Helper\URL;
$mainmenu = URL::showMenu();
?>
<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item">
                                @php
                                    $items = DB::table('setting')
                                        ->where('config_key', 'hotline')
                                        ->get();
                                    
                                @endphp
                                @foreach ($items as $item)
                                    <a title="Hotline: {{ $item->config_value }}"
                                        href="tel:{!! $item->config_value !!}"><span
                                            class="icon label-before fa fa-mobile"></span>Hotline:
                                        {!! $item->config_value !!}</a>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>
                            @if (session()->get('level') == 'admin')
                                <li class="menu-item"><a title="Admin" href="{{ route('dashboard') }}">Trang
                                        Admin</a></li>
                            @endif
                            @if (session()->has('username'))
                                <li class="dropdown">
                                    <a href="javascript:;" class="user-profile dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-expanded="false">
                                        @php
                                            $user = DB::table('user')
                                                ->where('username', session()->get('username'))
                                                ->get();
                                            
                                        @endphp
                                        @foreach ($user as $u )
                                            
                                        <img style="width:20px; height: 20px; border-radius: 50%; margin-right: 10px;"
                                            src="{{ asset('templates/images') }}@php
                                            session()->put('avatar', $u->avatar);
                                                echo '/' . session()->get('avatar');
                                            @endphp" alt="">
                                            
                                        @endforeach
                                        {{-- <img src="{{ asset('templates/admin/img/img.jpg') }}" alt=""> --}}
                                        <?php
                                        $username = Session::get('username');
                                        if ($username) {
                                            echo $username;
                                        }
                                        ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a class="dropdown-item" href="{{route('dat-hang/order')}}"> Đơn hàng</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                                    class="fa fa-sign-out pull-right"></i>Log Out</a></li>
                                    </ul>
                                </li>

                            @else
                                <li class="menu-item"><a title="Login" href="{{ route('login') }}">Login</a></li>
                                <li class="menu-item"><a title="Register" href="register.html">Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        @php
                            $items = DB::table('setting')
                                ->where('config_key', 'logo')
                                ->get();
                            
                        @endphp
                        @foreach ($items as $item)
                            <a href="{{ route('home') }}" class="link-to-home"><img
                                    src="{{ url('templates/images') }}/{!! $item->config_value !!}" alt="mercado"
                                    style="width:100px"></a>
                        @endforeach

                    </div>

                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form action="#" id="form-search-top" name="form-search-top">
                                <input type="text" name="search" value="" placeholder="Search here...">
                                <button form="form-search-top btn-search" type="button"><i class="fa fa-search"
                                        aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="wrap-icon right-section">
                        <div class="wrap-icon-section minicart">
                            <a href="{{ route('gio-hang') }}" class="link-direction">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <div class="left-info">
                                    <span class="index">
                                        <?php
                                        if (session()->get('cart')) {
                                            echo count(session()->get('cart'));
                                        } else {
                                            echo 0;
                                        }
                                        ?> items</span>
                                    <span class="title">CART</span>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nav-section header-sticky">
                <div class="header-nav-section">
                    <div class="container">
                        <marquee scrollamount="100" scrolldelay="900" >
                            <span style="color: red; font-size: 20px;">
                                 Chào mừng bạn đến với cổ phục Việt Nam 
                            </span>
                            </marquee>
                        {{-- <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info">
                            <li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span
                                    class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span
                                    class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top new items</a><span
                                    class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top Selling</a><span
                                    class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top rated items</a><span
                                    class="nav-label hot-label">hot</span></li>
                        </ul> --}}
                    </div>
                </div>

                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                            <li class="menu-item home-icon">
                                <a href="{{ route('home') }}" class="link-term mercado-item-title"><i
                                        class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            {!! $mainmenu !!}
                            {{-- <li class="menu-item">
                                <a href="about-us.html" class="link-term mercado-item-title">About Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="shop.html" class="link-term mercado-item-title">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="cart.html" class="link-term mercado-item-title">Cart</a>
                            </li>
                            <li class="menu-item">
                                <a href="checkout.html" class="link-term mercado-item-title">Checkout</a>
                            </li>
                            <li class="menu-item">
                                <a href="contact-us.html" class="link-term mercado-item-title">Contact Us</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
