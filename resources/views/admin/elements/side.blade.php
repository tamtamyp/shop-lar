@php
use App\Helper\Templates;
$menu = Templates::showSidebar();
@endphp
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('home') }}" class="site_title"><i class="fa fa-paw"></i>
                <span>Việt Phục</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                @php
                    $user = DB::table('user')
                        ->where('username', session()->get('username'))
                        ->get();
                    
                @endphp
                @foreach ($user as $u)
                    <img style="width:70px; height:70px" src="{{ asset('templates/images') }}@php
                        session()->put('avatar', $u->avatar);
                        echo '/' . session()->get('avatar');
                    @endphp" alt="" class="img-circle profile_img">
                @endforeach
                {{-- <img src="{{ asset('templates/admin/img/img.jpg') }}" alt="..." class="img-circle profile_img"> --}}
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>@php
                    echo session()->get('username');
                @endphp</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    {!! $menu !!}
                    {{-- <li><a><i class="fa fa-home"></i> Home</a></li>
                    <li><a><i class="fa fa-user"></i> User</a></li>
                    <li><a><i class="fa fa fa-building-o"></i> Category</a></li>
                    <li><a><i class="fa fa-newspaper-o"></i> Article</a></li>
                    <li><a><i class="fa fa-sliders"></i> Silders</a></li> --}}
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
