@php
use App\Helper\Templates;
$prefix = 'category';

// function showCategory($category, $parent_id = 0, $char = '')
// {
//     foreach ($category as $key => $item) {

//         // Nếu là danh mục con thì hiển thị
//         if ($item->parent_id == $parent_id) {
//             // echo '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
//             // Xử lý hiển thị danh mục
//             $selected=old('parent_id')==$item->id ? 'selected':'';
//             echo '<option value="'.$item->id.'"'.$selected.'>'.$char .$item->name.'</option>';

//             // Xóa danh mục đã lặp
//             unset($category[$key]);

//             // Tiếp tục đệ quy để tìm danh mục con của danh mục đang lặp
//             showCategory($category,$item->id, $char.'|---');
//         }
//     }
// }

@endphp
@extends('admin.main')
@section('content')
    <div class="container body">
        <div class="main_container">
            <div class="right_col" role="main">
                <div class="page-header zvn-page-header">
                    <div class="zvn-page-header-title">
                        <h3>Thêm danh mục</h3>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Thêm </h2>
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
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                    method="POST" action="{{ route($prefix . '/save') }} " enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên <span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="name-ajax" name="name" value="" required="required"
                                                class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Slug <span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="slug" name="slug" value="" required="required"
                                                class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục
                                            cha<span>*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12" name="parent_id">
                                                <option value="0" {{ old('parent_id') == 0 ? 'selected' : '' }}>Trống
                                                </option>
                                                @foreach ($category as $cate)
                                                    <option value="{{ $cate->id }}" {{old('parent_id')==$cate->id ? 'selected':''}}>{{ $cate->name }}</option>
                                                    @if ($cate->children)
                                                        @foreach ($cate->children as $child)
                                                            <option value="{{ $child->id }}" {{old('parent_id')==$cate->id ? 'selected':''}}>|---{{ $child->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng
                                            Thái<span>*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12" id="status" name="status">
                                                <option value="default">Select status</option>
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                    Kích hoạt</option>
                                                <option value="inactive"
                                                    {{ old('status') == 'inactive' ? 'selected' : '' }}>Chưa Kích hoạt
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kiểu hiển
                                            thị<span>*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12" id="display" name="display">
                                                <option value="default">Select </option>
                                                <option value="list" {{ old('display') == 'list' ? 'selected' : '' }}>
                                                    Danh sách</option>
                                                <option value="grid" {{ old('display') == 'grid' ? 'selected' : '' }}>
                                                    Lưới
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group" name = "status">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng thái</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="radio" value="active">
                                                    <i class="helper"></i>active
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="radio" value="inactive">
                                                    <i class="helper"></i>inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <a href="{{ route($prefix) }}"><button class="btn btn-danger"
                                                    type="button">Quay về</button></a>
                                            <button type="submit" class="btn btn-success" name="update_slider">Lưu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
