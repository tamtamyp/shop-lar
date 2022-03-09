<script src="{{ asset('templates/frontend/assets/js/jquery-1.12.4.minb8ff.js') }}?ver=1.12.4"></script>
<script src="{{ asset('templates/frontend/assets/js/jquery-ui-1.12.4.minb8ff.js') }}?ver=1.12.4"></script>
{{-- <script src="{{ asset('templates/frontend/assets/js/bootstrap.min.js') }}"></script> --}}
<script src="{{ asset('templates/frontend/assets/js/jquery.flexslider.js') }}"></script>
<script src="{{ asset('templates/frontend/assets/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('templates/frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('templates/frontend/assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('templates/frontend/assets/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('templates/frontend/assets/js/functions.js') }}"></script>
<script src="{{ asset('templates/admin/js/notify.min.js') }}"></script>
<script src="{{ asset('templates/frontend/assets/js/my-js.js') }}"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="{{ asset('templates/file/js/custom.js') }}"></script>

<script type="text/javascript">
    function addToCart(e) {
        e.preventDefault();
        let url = $(this).data('url');
        let id = $('.update-Quantity').data('id');
        let quan = $('.update-Quantity').val();
        let quantity = quan ? quan : 1;
        let btn = $(this);
        // alert(quantity);
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                quantity: quantity
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 200) {
                    btn.notify(response.message, {
                        position: "top center",
                        className: "success",
                    });
                }
            },
            error: function() {

            }
        })
    }
    $(function() {

        $('.add-to-cart').on('click', addToCart);
    })
    $('.delete-cart').click(function(e) {
        e.preventDefault();
        let url = $(this).data('url');
        let data = {
            _token: '{{csrf_token()',
            _method: 'GET'
        };
        if (confirm('Bạn chắc chắn muốn xóa?') == true) {

            $.get(url, data, function(res) {
                if (res.status_code == 200) {
                    $.notify(res.message, "success");
                } else {
                    $.notify(res.message, "error");
                }
            })
        } else {
            return false;
        }
    })
    $('.clear-shoping-cart').click(function(e) {
        e.preventDefault();
        let url = $(this).data('url');
        let data = {
            _token: '{{csrf_token()',
            _method: 'GET'
        };
        if (confirm('Bạn chắc chắn muốn xóa toàn bộ giỏ hàng?') == true) {

            $.get(url, data, function(res) {
                if (res.status_code == 200) {
                    location.reload();
                } else {
                    $.notify(res.message, "error");
                }
            })
        } else {
            return false;
        }
    })
    $('.btn-show-detail').click(Custom.btnShowDetailClick)
</script>