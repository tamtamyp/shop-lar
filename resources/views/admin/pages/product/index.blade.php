@php
use App\Helper\Templates;
$prefix = 'product';
@endphp
@extends('admin.main')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
            <div class="zvn-page-header-title">
                <h3>Danh sách sản phẩm</h3>
            </div>
            <div class="zvn-add-new pull-right">
                <a href="{{ route($prefix . '/add') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm
                    mới</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Bộ lọc</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            {{-- <div class="col-md-6 showStatus">
                                @if (DB::table($prefix)->count() != 0)
                                    <a href="{{ route($prefix) }}" type="button" class="btn btn-primary">
                                        All <span class="badge bg-white">
                                            @php
                                                $count = DB::table($prefix)->count();
                                                echo $count;
                                            @endphp
                                        </span>
                                    </a>
                                @endif
                                @if (DB::table($prefix)->where('status', 'active')->count() != 0)
                                    <a href="{{ route($prefix . '/showActive') }}" type="button"
                                        class="btn btn-success showActive">
                                        Active <span class="badge bg-white">
                                            @php
                                                $count = DB::table($prefix)
                                                    ->where('status', 'active')
                                                    ->count();
                                                echo $count;
                                            @endphp
                                        </span>
                                    </a>
                                @endif
                                @if (DB::table($prefix)->where('status', 'inactive')->count() != 0)
                                    <a href="{{ route($prefix . '/showInactive') }}" type="button"
                                        class="btn btn-success showInactive">
                                        Inactive <span class="badge bg-white">
                                            @php
                                                $count = DB::table($prefix)
                                                    ->where('status', 'inactive')
                                                    ->count();
                                                echo $count;
                                            @endphp
                                        </span>
                                    </a>
                                @endif
                                <div>
                                    <button class="btn btn-success" type="submit">
                                        <i class="fas fa-file-excel"></i> Export Excel
                                    </button>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                {!! Form::open(['method' => 'get']) !!}
                                <button class="btn btn-primary">
                                    All <span class="badge bg-white">
                                        @php
                                            $count = DB::table($prefix)->count();
                                            echo $count;
                                        @endphp
                                    </span>
                                </button>
                                <button class="btn btn-success">
                                    Active <span class="badge bg-white">
                                        @php
                                            $count = DB::table($prefix)
                                                ->where('status', 'active')
                                                ->count();
                                            echo $count;
                                        @endphp
                                    </span>
                                </button>
                                <button class="btn btn-success">
                                    Inactive <span class="badge bg-white">
                                        @php
                                            $count = DB::table($prefix)
                                                ->where('status', 'inactive')
                                                ->count();
                                            echo $count;
                                        @endphp
                                    </span>
                                </button>
                                {{ Form::close() }}
                                <button class="btn btn-success" type="submit">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                            </div> --}}
                            {{-- <form action="">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle btn-active-field"
                                                data-toggle="dropdown" aria-expanded="false">
                                                Search by All <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li><a href="#" class="select-field" data-field="all">Search by All</a>
                                                </li>
                                                <li><a href="#" class="select-field" data-field="id">Search by ID</a></li>
                                                <li><a href="#" class="select-field" data-field="username">Search by
                                                        Username</a>
                                                </li>
                                                <li><a href="#" class="select-field" data-field="fullname">Search by
                                                        Fullname</a>
                                                </li>
                                                <li><a href="#" class="select-field" data-field="email">Search by
                                                        Email</a></li>
                                            </ul>
                                        </div>
                                        <input id="keywords" type="text" class="form-control" name="search_value"
                                            value="">
                                        <span class="input-group-btn">
                                            <button id="btn-search" type="submit" class="btn btn-primary">Tìm kiếm</button>
                                            <button id="btn-clear" type="button" class="btn btn-success"
                                                style="margin-right: 0px">Xóa tìm kiếm</button>
                                        </span>
                                        <input type="hidden" name="search_field" value="all">
                                    </div>
                                </div>
                            </form> --}}
                            </>
                            <div class="row" style="margin-bottom: 50px;">
                                <div class="col-lg-12">
                                    {!! Form::open(['method' => 'get']) !!}
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select class="form-control" name="status" onchange="this.form.submit()">
                                                <option value="">--- Trạng thái ---</option>
                                                <option {{ $status == 'active' ? 'selected' : '' }} value="active">Active
                                                </option>
                                                <option {{ $status == 'inactive' ? 'selected' : '' }} value="inactive">
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="search_value" value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                                    </div>
                                    {!! Form::close() !!}
                                    <div class="col-sm-1 mb-lg-4">
                                        <form action="{{ route('exportProduct') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status"
                                                value="{{ request()->has('status') ? request()->status : '' }}" />
                                            <button class="btn btn-success" type="submit">
                                                <i class="fas fa-file-excel"></i> Export Excel
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-sm-1 mb-lg-4">
                                        
                                            <button class="btn btn-success" type="submit" data-toggle="modal"
                                                data-target="#exampleModalCenter">
                                                <i class="fas fa-plus-circle"></i> Import Excel
                                            </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--box-lists-->
            @if (Session::has('error'))
                <div class="alert alert-danger">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('error') }}

                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}

                </div>
            @endif
            <form method="post" action="{{ route($prefix . '/action') }}" id="formData">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Danh sách</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li class="pull-right"><a class="collapse-link"><i
                                                class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="table-responsive" id="">
                                    <div class="alignleft actions bulkactions">
                                        <select name="bulk_action" class="form-control" id="bulk_action">
                                            <option value selected>Hành động</option>
                                            <option value="delete">Xóa</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inctive</option>
                                        </select>
                                    </div>
                                    <div>
                                        <input type="submit" id="apply" class="btn btn-success" name="apply"
                                            value="Áp dụng">
                                    </div>
                                    <table class="table table-striped jambo_table bulk_action" id="list-slider">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title"><input type="checkbox" class="selectall">
                                                </th>
                                                <th class="column-title">Id</th>
                                                <th class="column-title"> </th>
                                                <th class="column-title">Tên sản phẩm</th>
                                                <th class="column-title">Danh mục</th>
                                                <th class="column-title">Giá</th>
                                                <th class="column-title">Tạo mới</th>
                                                <th class="column-title">Chỉnh sửa</th>
                                                <th class="column-title">Kiểu sản phẩm</th>
                                                <th class="column-title">Trạng thái</th>
                                                <th class="column-title">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody id="idAdminSearch">
                                            @foreach ($items as $item)
                                                @php
                                                    $id = $item['id'];
                                                    $name = $item['name'];
                                                    $status = $item['status'];
                                                    $categoryName = $item['category_name'];
                                                    $thumb = Templates::showImageMini($controllerName, $item['thumb'], $name);
                                                    $price = $item['price'];
                                                    $sale_price = $item['sale_price'];
                                                    $type = $item['type'];
                                                    $created = $item['created'];
                                                    $created_by = $item['created_by'];
                                                    $modified = $item['modified'];
                                                    $modified_by = $item['modified_by'];
                                                @endphp
                                                <tr class="even pointer" id="ahaha">
                                                    <td class=""><input class="selectbox" name="ids[]"
                                                            type="checkbox" value="{{ $id }}"></td>
                                                    <td class="">{{ $id }}</td>
                                                    <td>{!! $thumb !!}</td>
                                                    <td width="15%">
                                                        <div><b></b> {{ $name }}</div><br>
                                                    </td>
                                                    <td>{!! $categoryName !!}</td>
                                                    <td>
                                                        @if (!empty($sale_price))
                                                            <del
                                                                aria-hidden="true"><span>{{ $price }}&nbsp;<span>₫</span></span></del>
                                                            <br><span>{{ $sale_price }}&nbsp;<span>₫</span></span>
                                                        @else
                                                            {{ $price }}&nbsp;<span>₫</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p><i class="fa fa-user"></i> {{ $created_by }}</p>
                                                        <p><i class="fa fa-clock-o"></i> {{ $created }}</p>
                                                    </td>
                                                    <td>
                                                        <p><i class="fa fa-user change-by-{{ $id }}"></i> {{ $modified_by }}</p>
                                                        <p><i class="fa fa-clock-o change-time-{{ $id }}"></i> {{ $modified }}</p>
                                                    </td>
                                                    <td>
                                                        <select
                                                            data-url="{{ route($prefix . '/type', ['type' => $type, 'id' => $id]) }}"
                                                            class="form-control col-md-7 col-xs-12 change-ajax" id="type"
                                                            name="type">
                                                            <option {{ $type == 'featured' ? 'selected' : '' }}
                                                                value="featured">
                                                                Nổi bật</option>
                                                            <option {{ $type == 'normal' ? 'selected' : '' }}
                                                                value="normal">
                                                                Bình thường</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button
                                                            data-url="{{ route($prefix . '/status', ['status' => $status, 'id' => $id]) }}"
                                                            type="button" data-class="btn-success"
                                                            class="btn btn-round status-ajax
                                                        @php
                                                        $class = $status =='active' ? 'btn-success':'btn-danger';
                                                        echo $class;
                                                        @endphp ">{{ $status }}</button>
                                                    </td>
                                                    <td class="last">
                                                        <div class="zvn-box-btn-filter">
                                                            <a href="{{ route($prefix . '/edit') . '/' . $id }}"
                                                                type="button" class="btn btn-icon btn-success"
                                                                data-toggle="tooltip" data-placement="top"
                                                                data-original-title="Edit">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="{{ route($prefix . '/delete') . '/' . $id }}"
                                                                type="button" class="btn btn-icon btn-danger btn-delete"
                                                                data-toggle="tooltip" data-placement="top"
                                                                data-original-title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                    @if (count($items) == 0)
                                        <div class="alert alert-default" align="center">

                                            Danh sách đang cập nhật.

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end-box-lists-->
            <!--box-pagination-->

            <div class="row" style=" @if (count($items) < 1) display:none; @endif

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
                                    <p class="m-b-0"><span class="label label-success label-pagination"></span>
                                        <button class="btn btn-outline-primary" type="">All(@php
                                            $count = DB::table($prefix)->count();
                                            echo $count;
                                        @endphp)</button>
                                        <button class="btn btn-outline-primary" type="">Active(@php
                                            $count = DB::table($prefix)
                                                ->where('status', 'active')
                                                ->count();
                                            echo $count;
                                        @endphp)</button>
                                        <button class="btn btn-outline-primary" type="">Inactive(@php
                                            $count = DB::table($prefix)
                                                ->where('status', 'inactive')
                                                ->count();
                                            echo $count;
                                        @endphp)</button>
                                    </p>
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
            <!--end-box-pagination-->
        </div>
        @include('admin.pages.product.modalImportExcel')

        <!-- /page content -->
    @endsection
