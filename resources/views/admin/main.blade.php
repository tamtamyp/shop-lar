<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.elements.head')
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('admin.elements.side')
        <!-- top navigation -->
        @include('admin.elements.top-navigation')
        <!-- /top navigation -->
        <!-- page content -->
        @yield('content')
        <!-- /page content -->
        <!-- footer -->
        @include('admin.elements.footer')
        <!-- /footer -->
    </div>
</div>
    @include('admin.elements.script')
</body>
</html>