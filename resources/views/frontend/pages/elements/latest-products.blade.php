<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">Latest Products</h3>
    <div class="wrap-top-banner">
        @php
            $items = DB::table('setting')
                ->where('config_key', 'banner3')
                ->get();
            
        @endphp
        @foreach ($items as $item)
            <figure><img src="{{ url('templates/images') }}/{!! $item->config_value !!}" alt="" style="width:1170;
                    height:240;"></figure>
        @endforeach
    </div>
    <div class="wrap-products">
        <div class="wrap-product-tab tab-style-1">
            <div class="tab-contents">
                <div class="tab-content-item active" id="digital_1a">
                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                        data-loop="false" data-nav="true" data-dots="false"
                        data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                        @php
                            $items = DB::table('product')
                                ->where('status', 'active')
                                ->orderby('id', 'desc')
                                ->get();
                        @endphp
                        @foreach ($items as $item)
                            @php
                                $id = $item->id;
                                $thumb = $item->thumb;
                                $name = $item->name;
                                $price = $item->price;
                                $sale_price = $item->sale_price;
                                $link = route('san-pham/index', ['product_id' => $id, 'product_name' => Str::slug($name)]);
                                $sale = round((($price - $sale_price) * 100) / $price, 0);
                            @endphp
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ $link }}" title="{!! Str::slug($name) !!}">
                                        <figure><img src="{{ url('templates/images') }}/{!! $thumb !!}"
                                                style="width:214px;height:214px;" alt="{!! Str::slug($name) !!}">
                                        </figure>
                                    </a>
                                    <div class="group-flash">

                                        @if (!empty($item->sale_price))
                                            <span class="flash-item sale-label">{{ $sale }}%</span>

                                        @endif
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="{{ $link }}" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{ $link }}" class="product-name"><span
                                            style="height:35px;">{!! substr($name, 0, 50) !!}</span></a>
                                    <div class="wrap-price"><span class="product-price">
                                            @if (!empty($sale_price))
                                                <del aria-hidden="true"><span
                                                        style="color:red;">{{ number_format($price) }}&nbsp;</span></del>
                                                <span>{{ number_format($sale_price) }}&nbsp;<span>₫</span></span>
                                            @else {{ number_format($price) }}&nbsp;<span>₫</span>
                                            @endif
                                        </span></div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img
                                            src="{{ asset('templates/frontend/assets/images/products/digital_04.jpg') }}"
                                            width="800" height="800"
                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                        Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img
                                            src="{{ asset('templates/frontend/assets/images/products/digital_17.jpg') }}"
                                            width="800" height="800"
                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                        Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><ins>
                                        <p class="product-price">$168.00</p>
                                    </ins> <del>
                                        <p class="product-price">$250.00</p>
                                    </del></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img
                                            src="{{ asset('templates/frontend/assets/images/products/digital_15.jpg') }}"
                                            width="800" height="800"
                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                        Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><ins>
                                        <p class="product-price">$168.00</p>
                                    </ins> <del>
                                        <p class="product-price">$250.00</p>
                                    </del></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img
                                            src="{{ asset('templates/frontend/assets/images/products/digital_01.jpg') }}"
                                            width="800" height="800"
                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item bestseller-label">Bestseller</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                        Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img
                                            src="{{ asset('templates/frontend/assets/images/products/digital_21.jpg') }}"
                                            width="800" height="800"
                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                        Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img
                                            src="{{ asset('templates/frontend/assets/images/products/digital_03.jpg') }}"
                                            width="800" height="800"
                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                        Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><ins>
                                        <p class="product-price">$168.00</p>
                                    </ins> <del>
                                        <p class="product-price">$250.00</p>
                                    </del></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img
                                            src="{{ asset('templates/frontend/assets/images/products/digital_04.jpg') }}"
                                            width="800" height="800"
                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                        Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img
                                            src="{{ asset('templates/frontend/assets/images/products/digital_05.jpg') }}"
                                            width="800" height="800"
                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item bestseller-label">Bestseller</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                        Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
