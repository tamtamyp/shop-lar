@extends('frontend.main')
@section('content')
    <div class="container pb-60">
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
                                                    <td>#{{ $item->id }}<?php echo session()->get('username'); ?></td>
                                                    <td>
                                                        <p><i class="fa fa-clock-o"></i>{{ $item->order_date }}</p>
                                                    </td>
                                                    <td><a>
                                                            @php
                                                                $status = null;
                                                                if ($item->status == 'pending') {
                                                                    echo 'Chờ xác nhận';
                                                                }
                                                                if ($item->status == 'processing') {
                                                                    echo 'Đang xử lý';
                                                                }
                                                                if ($item->status == 'completed') {
                                                                    echo 'Hoàn thành';
                                                                }
                                                                if ($item->status == 'cancelled') {
                                                                    echo 'Đã hủy';
                                                                }
                                                                if ($item->status == 'refunded') {
                                                                    echo 'Đã hoàn tiền';
                                                                }
                                                            @endphp

                                                        </a></td>
                                                    <td>
                                                        <p><i
                                                                class=""></i>{{ number_format($item->total) }}&nbsp;<span>₫</span>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn-show-detail" data-url="{{route('dat-hang/orderDetail',['id'=>$item->id])}}" data-toggle="modal" data-target="#modelId" class><i
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
    </div>
    <!-- Button trigger modal -->

    @include('frontend.pages.shop.order.order_detail')

    <script type="text/javascript">
    </script>
@endsection
