@php
use App\Helper\Templates;
$prefix = 'setting';
@endphp
@extends('admin.main')
@section('content')
    <div class="container body">
        <div class="main_container">
            <div class="right_col" role="main">
                <div class="page-header zvn-page-header">
                    <div class="zvn-page-header-title">
                        <h3>Chỉnh sửa cài đặt</h3>
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
                                        $config_key = $item['config_key'];
                                        $config_value = $item['config_value'];
                                        
                                    @endphp
                                    @if (session('thongbao'))
                                        <div class="alert alert-success"> {{ session('thongbao') }}</div>
                                    @endif
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                        method="POST" action="{{ route($prefix . '/update') . '/' . $config_key }}"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                for="name">{{ $config_key }} 
                                            </label>
                                            @if (strpos($config_value, '.ico') !== false || strpos($config_value, '.jpg') !== false || strpos($config_value, '.png') !== false || strpos($config_value, '.jpeg') !== false)

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <img src="{{ url('templates/images') }}/{{ $config_value }}"
                                                        id="show_img" style="width:100%;">
                                                    <div class="input-group">
                                                        <input type="text" id="image" name="config_value"
                                                            class="form-control col-md-7 col-xs-12" accept="image/*"
                                                            value="{{ $config_value }}">
                                                        <span class="input-group-addon">
                                                            <a href="#image" data-toggle="modal"
                                                                data-target="#modelId">Select</a>
                                                        </span>
                                                    </div>
                                                </div>

                                            @else
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="name" name="config_value" value="{{ $config_value  }}"
                                                    required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                            @endif
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
