@php
use App\Helper\Templates;
$prefix = 'media';
@endphp
@extends('admin.main')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
            <div class="zvn-page-header-title">
                <h3>Thư viện</h3>
            </div>
        </div>
        <div>
            <iframe src="{{url('templates/file/dialog.php')}}" style="width:100%; height:800px; overflow-y:auto; border:none;"></iframe>
        </div>
        {{-- fix upload https://stackoverflow.com/questions/60544865/responsive-file-manager-and-tinymce/60552341#60552341 --}}
        <!--end-box-pagination-->
    </div>
@endsection
