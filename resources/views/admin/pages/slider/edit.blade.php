@php
use App\Helper\Templates;
$prefix = 'slider';
@endphp
@extends('admin.main')
@section('content')
    <div class="container body">
        <div class="main_container">
            <div class="right_col" role="main">
                <div class="page-header zvn-page-header">
                    <div class="zvn-page-header-title">
                        <h3>Sửa Slider</h3>
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
                                        $link = $item['link'];
                                        $thumb = Templates::showImage($controllerName, $item['thumb'], $name);
                                        $status = $item['status'];
                                        
                                    @endphp
                                    @if (session('thongbao'))
                                        <div class="alert alert-success"> {{ session('thongbao') }}</div>
                                    @endif
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                        method="POST" action="{{ route($prefix.'/update') . '/' . $id }}"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên <span
                                                    class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="name" name="name" required="required"
                                                    class="form-control col-md-7 col-xs-12" value="{{ $name }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control" name="link" value="{{ $link }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mô tả
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="ckeditor" name="description"
                                                    id="description">{!! $description !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng
                                                Thái<span>*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control col-md-7 col-xs-12" id="status" name="status">
                                                    <option value="default">Select status</option>
                                                    <option {{ $status == 'active' ? 'selected' : '' }} value="active">
                                                        Kích hoạt</option>
                                                    <option {{ $status == 'inactive' ? 'selected' : '' }}
                                                        value="inactive">Chưa Kích hoạt</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thumb">Hình ảnh
                                                <span class="required">*</span>
                                            </label>
                                            <div class=" col-md-6 col-sm-6 col-xs-12">{!!$thumb!!}
                                                <input type="text" id="image" name="thumb"
                                                    class="form-control col-md-7 col-xs-12" accept="image/*"
                                                    placeholder="Input image" value="">
                                                <span class="input-group-addon">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modelId">Select</button>
                                                </span>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng thái</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="radio radio-inline">
                                                    <label>
                                                        <input type="radio" name="radio"
                                                            {{ $status == 'active' ? 'checked' : '' }} value="active">
                                                        <i class="helper"></i>active
                                                    </label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <label>
                                                        <input type="radio" name="radio"
                                                            {{ $status == 'inactive' ? 'checked' : '' }} value="inactive">
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
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-custom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <iframe src="{{ url('templates/file/dialog.php?field_id=image') }}"
                            style="width:100%; height:700px; overflow-y:auto; border:none;"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
    </script>
@endsection
