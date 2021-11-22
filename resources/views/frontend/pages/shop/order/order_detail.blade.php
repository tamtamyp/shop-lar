<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Đơn hàng #<p class="customer-id"></p></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid thong-tin-thanh-toan">
                    <b>Thông tin thanh toán</b>
                    <br><br>Họ tên: <p class="customer-name"></p>
                    <br>Số điện thoại: <p class="customer-phone"></p>
                    <br>Email: <p class="customer-email"></p>
                    <br>Địa chỉ:<p class="customer-address"></p>
                </div>
                <div>
                    <table class="table jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Sản phẩm</th>
                                <th class="column-title">Số lượng</th>
                                <th class="column-title">Giá</th>
                            </tr>
                        </thead>
                        <tbody id="ds_product">
                            {{-- <tr class="even pointer">
                                <td>
                                    <p id="product-name"></p>
                                </td>
                                <td>
                                    <p id="product-quantity"></p>
                                </td>
                                <td>
                                    <p id="product-total"></p>&nbsp;<span>₫</span>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
