@php
$prefix = 'order';
@endphp
@extends('admin.main')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
        </div>
        <form method="post" action="" id="formData">
            @csrf
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Danh sách đơn hàng</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="table-responsive">
                                        <table class="table jambo_table bulk_action">
                                            <thead>
                                                <tr class="headings" style="text-align:center; font-weight: bold;">
                                                    <td class="column-title">Đơn hàng</td>
                                                    <td class="column-title">Ngày đặt</td>
                                                    <td class="column-title">Tình trạng</td>
                                                    <td class="column-title">Tổng thanh toán</td>
                                                    <td class="column-title"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                    <tr class="even pointer">
                                                        <td>#{{ $item->id }}{{ $item->customer_name }}</td>
                                                        <td>
                                                            <p><i class="fa fa-clock-o"></i>{{ $item->order_date }}</p>
                                                        </td>
                                                        <td>
                                                            <select 
                                                            data-url="{{ route($prefix . '/status', ['status' => $item->status, 'id' => $item->id]) }}"
                                                                class="form-control col-md-7 col-xs-12 change-ajax"
                                                                id="status" name="status">
                                                                <option {{ $item->status == 'pending' ? 'selected' : '' }}
                                                                    value="pending">
                                                                    Chờ xác nhận</option>
                                                                <option
                                                                    {{ $item->status == 'processing' ? 'selected' : '' }}
                                                                    value="processing">
                                                                    Đang xử lý</option>
                                                                <option
                                                                    {{ $item->status == 'completed' ? 'selected' : '' }}
                                                                    value="completed">
                                                                    Hoàn thành</option>
                                                                <option
                                                                    {{ $item->status == 'cancelled' ? 'selected' : '' }}
                                                                    value="cancelled">
                                                                    Đã hủy</option>
                                                                <option
                                                                    {{ $item->status == 'refunded' ? 'selected' : '' }}
                                                                    value="refunded">
                                                                    Đã hoàn tiền</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <p><i
                                                                    class=""></i>{{ number_format($item->total) }}&nbsp;<span>₫</span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <a href="" class="btn-order-detail"
                                                                data-url="{{ route('order/detail', ['id' => $item->id]) }}"
                                                                data-toggle="modal" data-target="#modelId" class><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @include('admin.pages.order.order_detail')
        <!--end-box-lists-->
        <!--box-pagination-->

        <div class="row" style="
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
        </div>
        <!--end-box-pagination-->
    </div>
    <!-- /page content -->
    {{-- HIGHLIGHTCODE --}}
    <script type="text/javascript">
    </script>
@endsection
