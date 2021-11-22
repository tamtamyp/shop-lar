<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.elements.head')
</head>

<body class="home-page home-01 ">

    <!-- mobile menu -->
    @include('frontend.elements.mobile')

    <!--header-->
    @include('frontend.elements.header')

    @yield('content')

    @include('frontend.elements.footer')

    @include('frontend.elements.script')
</body>

</html>
<script type="text/javascript">
    //======= back to top ========
    $(document).ready(function() {
        $("#back-to-top").click(function() {
            return $("body, html").animate({
                scrollTop: 0
            }, 400), !1
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    })
</script>
