@extends('frontend.main')
@section('content')
    <main id="main">
        <div class="container">

            <!--MAIN SLIDE-->
            @include('frontend.pages.elements.slide')

            <!--BANNER-->
            @include('frontend.pages.elements.banner')

            <!--On Sale-->
            @include('frontend.pages.elements.sale')

            <!--Latest Products-->
            @include('frontend.pages.elements.latest-products')

            <!--Product Categories-->
            @include('frontend.pages.elements.category-products')

        </div>

    </main>
@endsection
