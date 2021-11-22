@php
use App\Helper\Templates;
$prefix = 'product';
@endphp
@extends('admin.main')
@section('content')
    <div class="container body">
        <div class="main_container">
            <div class="right_col" role="main">
                <div class="page-header zvn-page-header">
                    <div class="zvn-page-header-title">
                        <h3>Sửa Sản phẩm</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Sửa </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li class="pull-right"><a class="collapse-link"><i
                                                class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                @if (count($errors) > 0)

                                    <div class="alert alert-danger">

                                        @foreach ($errors->all() as $err)
                                            {{ $err }}<br>
                                        @endforeach

                                    </div>

                                @endif
                                @foreach ($items as $item)
                                    @php
                                        
                                        $id = $item['id'];
                                        $name = $item['name'];
                                        $description = $item['description'];
                                        $content = $item['content'];
                                        $status = $item['status'];
                                        $categoryName = $item['category_name'];
                                        $thumb = $item['thumb'];
                                        // $thumb_list   = $item['thumb_list'];
                                        $type = $item['type'];
                                        $created = $item['created'];
                                        $created_by = $item['created_by'];
                                        $price = $item['price'];
                                        $sale_price = $item['sale_price'];
                                        
                                    @endphp
                                    @if (session('thongbao'))
                                        <div class="alert alert-success"> {{ session('thongbao') }}</div>
                                    @endif
                                    <form id="demo-form2" data-parsley-validate method="POST"
                                        action="{{ route($prefix . '/update') . '/' . $id }} "
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class='row'>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label for="name">Tên sản phẩm
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" id="name" name="name" value="{{ $name }}"
                                                        required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                                <div class="form-group">
                                                    <label>Mô tả ngắn </label>
                                                    <textarea class="ckeditor"
                                                        name="description">{{ $description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nội dung </label>
                                                    <textarea class="ckeditor"
                                                        name="content">{{ $content }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="name">Danh mục sản phẩm <span
                                                            class="required">*</span>
                                                    </label>
                                                    <select class="form-control col-md-7 col-xs-12" name="category_id">
                                                        @foreach ($category as $cate)
                                                            <option value="{{ $cate->id }}"
                                                                {{ $categoryName == $cate->name ? 'selected' : '' }}>
                                                                {{ $cate->name }}</option>
                                                            @if ($cate->children)
                                                                @foreach ($cate->children as $child)
                                                                    <option value="{{ $child->id }}"
                                                                        {{ $categoryName == $child->name ? 'selected' : '' }}>
                                                                        |---{{ $child->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Trạng
                                                        Thái<span>*</span></label>
                                                    <select class="form-control col-md-7 col-xs-12" id="status"
                                                        name="status">
                                                        <option value="active"
                                                            {{ $status == 'active' ? 'selected' : '' }}>
                                                            Kích hoạt</option>
                                                        <option value="inactive"
                                                            {{ $status == 'inactive' ? 'selected' : '' }}>Chưa Kích
                                                            hoạt
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kiểu bài
                                                        viết<span>*</span></label>
                                                    <select class="form-control col-md-7 col-xs-12" id="type" name="type">
                                                        <option value="normal" {{ $type == 'normal' ? 'selected' : '' }}>
                                                            Bình thường
                                                        </option>
                                                        <option value="featured"
                                                            {{ $type == 'featured' ? 'selected' : '' }}>
                                                            Nổi bật</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Giá bán thường (₫)
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" id="price" name="price" value="{{ $price }}"
                                                        required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Giá khuyến mãi (₫)</label>
                                                    <input type="text" id="sale_price" name="sale_price"
                                                        value="{{ $sale_price }}"
                                                        class="form-control col-md-7 col-xs-12">
                                                </div>
                                                <div class="form-group">
                                                    <label for="thumb">Ảnh sản phẩm
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" id="image" name="thumb"
                                                            class="form-control col-md-7 col-xs-12" accept="image/*"
                                                            value="{{ $thumb }}">
                                                        <span class="input-group-addon">
                                                            <a href="#image" data-toggle="modal"
                                                                data-target="#modelId">Select</a>
                                                        </span>
                                                    </div>
                                                    <img src="{{ url('templates/images') }}/{{ $thumb }}"
                                                        id="show_img" style="width:100%; height:300px">
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    $thumb_list = json_decode($item['thumb_list']);
                                                    ?>
                                                    <label for="">Album ảnh sản phẩm
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" id="image_list" name="thumb_list"
                                                            class="form-control col-md-7 col-xs-12">
                                                        <span class="input-group-addon">
                                                            <a href="#image_list" data-toggle="modal"
                                                                data-target="#model_list">Select</a>
                                                        </span>
                                                    </div>
                                                    <div class="row" id="show_image_list">
                                                        @if (is_array($thumb_list))
                                                            <div class="row">
                                                                @foreach ($thumb_list as $img)
                                                                    <div class="col-md-4">
                                                                        <img src="{{ url('templates/images') }}/{{ $img }}"
                                                                            alt="" style="width:100%; height:70px;">
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <a href="{{ route($prefix) }}"><button class="btn btn-danger"
                                                        type="button">Quay về</button></a>
                                                <button type="submit" class="btn btn-success"
                                                    name="update_slider">Lưu</button>
                                            </div>
                                        </div>
                                    </form>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal_img" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-custom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thư viện</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <iframe src="{{ url('templates/file') }}/dialog.php?field_id=image"
                            style="width:100%; height:700px; overflow-y:auto; border:none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal list -->
    <div class="modal fade modal_list" id="model_list" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thư viện</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <iframe src="{{ url('templates/file') }}/dialog.php?field_id=image_list"
                            style="width:100%; height:700px; overflow-y:auto; border:none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var _url = "{{ url('templates/images') }}";

            $('#modelId').on('hide.bs.modal', function() {
                var _link = $('#image').val();
                var _img = _url + '/' + _link;
                $('#show_img').attr('src', _img);
            });
        });
    </script>
@endsection
