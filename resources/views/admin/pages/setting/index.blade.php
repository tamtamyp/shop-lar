@php
use App\Helper\Templates;
$prefix = 'setting';
@endphp
@extends('admin.main')
@section('content')

    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
            <div class="zvn-page-header-title col-md-6">
                <h3>Cài đặt</h3>
            </div>
            <form action="">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-btn">

                        </div>
                        <input id="keywords" type="text" class="form-control" name="search_value"
                            value="">
                        <span class="input-group-btn">
                            <button id="btn-search" type="submit" class="btn btn-primary">Tìm kiếm</button>
                            <a href="{{route($prefix)}}"><button id="btn-clear" type="button" class="btn btn-success"
                                style="margin-right: 0px">Xóa tìm kiếm</button></a>
                        </span>
                        <input type="hidden" name="search_field" value="all">
                    </div>
                </div>
            </form>
        </div>
        <!--box-lists-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Danh sách</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title col-md-2">Config_key</th>
                                        <th class="column-title col-md-5">Config_value</th>
                                        <th class="column-title col-md-2">Chỉnh sửa</th>
                                        <th class="column-title col-md-1">Hành động</th>
                                    </tr>
                                </thead>
                                @foreach ($items as $item)
                                    @php
                                        $config_key = $item['config_key'];
                                        $config_value = $item['config_value'];
                                        $modified = $item['modified'];
                                        $modified_by = $item['modified_by'];
                                        
                                    @endphp
                                    <tbody>
                                        <tr class="even pointer">
                                            <td width="10%">{!! $config_key !!}</td>
                                            <td>
                                                @if ($config_key == 'favicon' || $config_key == 'logo'|| strpos($config_key, 'banner') !== false)
                                                    <img src="{{ url('templates/images') }}/{!!$config_value !!}" style="width: 70px; height: 70px;">
                                                    @else {!! $config_value !!}
                                                @endif
                                            
                                            </td>
                                            <td>
                                                <p><i class="fa fa-user"></i> {!! $modified_by !!}</p>
                                                <p><i class="fa fa-clock-o"></i> {!! $modified !!}</p>
                                            </td>
                                            <td class="last">
                                                <div class="zvn-box-btn-filter">
                                                    <a href="{{ route($prefix . '/edit') . '/' . $config_key }}"
                                                        type="button" class="btn btn-icon btn-success" data-toggle="tooltip"
                                                        data-placement="top" data-original-title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end-box-lists-->
        <div class="row" style="
                                               @if (count($items) <=1)
            display:none;
            @endif

            ">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Phân trang
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="m-b-0"><span class="label label-success label-pagination"></span></p>
                            </div>
                            <div class="col-md-6">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination zvn-pagination">
                                        {!! $items->appends(request()->all())->links() !!}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
