@extends('frontend.main')
@section('content')

    <!--main area-->
    <main id="main" class="main-site left-sidebar">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>
                            @if (!empty($categoryName))
                            @foreach ( $categoryName as $name )
                                
                            @endforeach
                                {{ $name->name }}
                            @else All Products
                            @endif


                        </span></li>
                </ul>
            </div>
            <div class="row">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                    <div class="banner-shop">
                        @php
                            $items = DB::table('setting')
                                ->where('config_key', 'banner_product')
                                ->get();
                            
                        @endphp
                        @foreach ($items as $item)
                            <figure><img src="{{ url('templates/images') }}/{!! $item->config_value !!}" alt="" style="width:870px;
                                    height:272px;"></figure>
                        @endforeach
                    </div>

                    <div class="wrap-shop-control">

                        <h1 class="shop-title">
                            @if (!empty($categoryName))
                            @foreach ( $categoryName as $name )
                                
                            @endforeach
                                {{ $name->name }}
                            @else All Products
                            @endif
                        </h1>

                        <div class="wrap-right">

                            <div class="sort-item orderby ">
                                <select name="orderby" class="use-chosen">
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>
                            <div class="change-display-mode">
                                <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                                <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                            </div>
                        </div>
                    </div>
                    <!--end wrap shop control-->
                    @include('frontend.pages.shop.product.product')

                    <div class="wrap-pagination-info">
                        {!! $product->appends(request()->all())->links() !!}
                        <p class="result-count">Hiển thị @php
                            echo count($product);
                        @endphp sản phẩm</p>
                    </div>
                </div>
                <!--end main products area-->

                @include('frontend.pages.shop.side.side')

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
