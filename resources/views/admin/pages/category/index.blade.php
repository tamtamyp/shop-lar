@php
$prefix = 'category';
@endphp
@extends('admin.main')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
            <div class="zvn-page-header-title">
                <h3>Danh sách chuyên mục</h3>
            </div>
            <div class="zvn-add-new pull-right">
                <a href="{{ route($prefix . '/add') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm
                    mới</a>
            </div>
        </div>
        {{-- <div class="row">
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
                            <div class="col-md-6 showStatus">
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


                            </div>
                            <form action="">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive" id="">
                                {{-- <div class="alignleft actions bulkactions">
                                    <select name="bulk_action" class="form-control" id="bulk_action">
                                        <option value selected>Hành động</option>
                                        <option value="delete">Xóa</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inctive</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="submit" id="apply" class="btn btn-primary" name="apply" value="Áp dụng">
                                </div> --}}

                                <div class="col-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body menu-builder">
                                            <div class="dd" id="nestable">
                                                <ol class="dd-list">
                                                    @forelse($items as $item)
                                                        @php
                                                            $id = $item['id'];
                                                            $name = $item['name'];
                                                            $status = $item['status'];
                                                            $created = $item['created'];
                                                            $created_by = $item['created_by'];
                                                            $modified = $item['modified'];
                                                            $modified_by = $item['modified_by'];
                                                            $slug = $item['slug'];
                                                        @endphp
                                                        <li class="dd-item" data-id="{{ $id }}">
                                                            <div class="pull-right item_actions">
                                                                <a class="btn btn-sm btn-primary float-right edit"
                                                                    href="{{ route($prefix . '/edit') . '/' . $id }}">
                                                                    <i class="fa fa-pencil"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger float-right delete"
                                                                    onclick="deleteData({{ $id }})">
                                                                    <i class="fa fa-trash"></i>
                                                                    <span>Delete</span>
                                                                </button>
                                                                <form id="delete-form-{{ $id }}"
                                                                    action="{{ route($prefix . '/delete') . '/' . $id }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf()
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                            <div class="dd-handle">{{ $name }}</div>
                                                            @if ($item->children)
                                                                <ol class="dd-list">
                                                                    @foreach ($item->children as $child)

                                                                        @php
                                                                            $id = $child['id'];
                                                                            $name = $child['name'];
                                                                            $status = $child['status'];
                                                                            $created = $child['created'];
                                                                            $created_by = $child['created_by'];
                                                                            $modified = $child['modified'];
                                                                            $modified_by = $child['modified_by'];
                                                                            $slug = $child['slug'];
                                                                        @endphp

                                                                        <li class="dd-item"
                                                                            data-id="{{ $id }}">
                                                                            <div class="pull-right item_actions">

                                                                                <a class="btn btn-sm btn-primary float-right edit"
                                                                                    href="{{ route($prefix . '/edit') . '/' . $id }}">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                    <span>Edit</span>
                                                                                </a>
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger float-right delete"
                                                                                    onclick="deleteData({{ $id }})">
                                                                                    <i class="fa fa-trash"></i>
                                                                                    <span>Delete</span>
                                                                                </button>
                                                                                <form id="delete-form-{{ $id }}"
                                                                                    action="{{ route($prefix . '/delete') . '/' . $id }}"
                                                                                    method="POST" style="display: none;">
                                                                                    @csrf()
                                                                                    @method('DELETE')
                                                                                </form>
                                                                            </div>
                                                                            <div class="dd-handle">
                                                                                <span>{{ $name }}</span>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ol>
                                                            @endif
                                                        </li>
                                                    @empty
                                                        <div class="text-center">
                                                            <strong>No menu item found.</strong>
                                                        </div>
                                                    @endforelse
                                                </ol>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>

                                {{-- <table class="table table-striped jambo_table bulk_action" id="list-slider">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title"><input type="checkbox" class="selectall"></th>
                                            <th class="column-title">Id</th>
                                            <th class="column-title">Name</th>
                                            <th class="column-title">Slug</th>
                                            <th class="column-title">Tạo mới</th>
                                            <th class="column-title">Chỉnh sửa</th>
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
                                                $created = $item['created'];
                                                $created_by = $item['created_by'];
                                                $modified = $item['modified'];
                                                $modified_by = $item['modified_by'];
                                                $slug = $item['slug'];
                                            @endphp

                                            <tr class="even pointer" id="ahaha">
                                                <td class=""><input class="selectbox" name="ids[]"
                                                        type="checkbox" value="{{ $id }}"></td>
                                                <td class="">{{ $id }}</td>
                                                <td>
                                                    <p style="color:black;">{{ $name }}</p>


                                                </td>

                                                <td>{{ $slug }}</td>
                                                <td>
                                                    <p><i class="fa fa-user"> {{ $created_by }}</i></p>
                                                    <p><i class="fa fa-clock-o"> {{ $created }}</i></p>
                                                </td>
                                                <td>
                                                    <p><i class="fa fa-user change-by-{{ $id }}">
                                                            {{ $modified_by }}</i></p>
                                                    <p><i class="fa fa-clock-o change-time-{{ $id }}">
                                                            {{ $modified }}</i></p>
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
                                            @if ($item->children)
                                                @foreach ($item->children as $child)

                                                    @php
                                                        $id = $child['id'];
                                                        $name = $child['name'];
                                                        $status = $child['status'];
                                                        $created = $child['created'];
                                                        $created_by = $child['created_by'];
                                                        $modified = $child['modified'];
                                                        $modified_by = $child['modified_by'];
                                                        $slug = $child['slug'];
                                                    @endphp
                                                    <tr class="even pointer" id="ahaha">
                                                        <td class=""><input class="selectbox"
                                                                name="ids[]" type="checkbox" value="{{ $id }}">
                                                        </td>
                                                        <td class="">{{ $id }}</td>
                                                        <td>
                                                            |---{{ $name }}


                                                        </td>
                                                        <td>{{ $slug }}</td>
                                                        <td>
                                                            <p><i class="fa fa-user"> {{ $created_by }}</i></p>
                                                            <p><i class="fa fa-clock-o"> {{ $created }}</i></p>
                                                        </td>
                                                        <td>
                                                            <p><i class="fa fa-user change-by-{{ $id }}">
                                                                    {{ $modified_by }}</i></p>
                                                            <p><i class="fa fa-clock-o change-time-{{ $id }}">
                                                                    {{ $modified }}</i></p>
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
                                                                    type="button"
                                                                    class="btn btn-icon btn-danger btn-delete"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-original-title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </tbody>

                                </table>
                                @if (count($items) == 0)
                                    <div class="alert alert-default" align="center">

                                        Danh sách đang cập nhật.

                                    </div>

                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--end-box-lists-->
        <!--box-pagination-->

        {{-- <div class="row" style="
                      @if (count($items) < 1)
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
        </div> --}}
        <!--end-box-pagination-->
    </div>
    <!-- /page content -->
    {{-- HIGHLIGHTCODE --}}
    {{-- <script type="text/javascript">
        window.addEventListener("DOMContentLoaded", function(e) {
            var myHilitor2 = new Hilitor("idAdminSearch");
            myHilitor2.setMatchType("left");
            document.getElementById("keywords").addEventListener("keyup", function(e) {
                myHilitor2.apply(this.value);
            }, false);
        }, false);
    </script> --}}
@endsection
