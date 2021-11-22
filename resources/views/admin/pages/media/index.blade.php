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
        
        <!--end-box-pagination-->
    </div>
@endsection
