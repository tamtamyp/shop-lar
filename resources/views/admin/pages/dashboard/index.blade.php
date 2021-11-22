@extends('admin.main')
@section('content')
    @php
    use App\Helper\Templates;
    $menu = Templates::showDashboard();
    @endphp
    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
            <div class="zvn-page-header-title">
                <h3>Dashboard</h3>
            </div>
        </div>

        <div class="row" style="display: inline-block;">
            <div class="top_tiles">
                {{-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 " style="width:300px">
                    <div class="tile-stats"> --}}
                        {!! $menu !!}
                        {{-- <div class="icon"><i class="fa fa-sliders"></i></div>
                        <div class="count">Slider</div>
                        <h3>
                            @php
                                $count = DB::table('slider')->count();
                                echo $count;
                            @endphp
                        </h3>
                        <a href="{{ route('slider') }}" class="">
                            <p>Xem chi tiết</p>
                        </a> --}}
                    {{-- </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
