<!-- jQuery -->
<script src="{{ asset('templates/admin/js/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('templates/admin/asset/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('templates/admin/js/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('templates/admin/asset/nprogress/nprogress.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('templates/admin/asset/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('templates/admin/asset/iCheck/icheck.min.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('templates/admin/js/custom.min.js') }}"></script>

<script src="{{ asset('templates/admin/js/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('templates/admin/js/hilitor.js') }}"></script>


<script src="{{ asset('templates/admin/js/myjs.js') }}"></script>

<script src="{{ asset('templates/admin/js/notify.min.js') }}"></script>
<script src="https://kit.fontawesome.com/c4bc9982b0.js" crossorigin="anonymous"></script>

<script src="{{ asset('templates/admin/js/jquery.nestable.js') }}"></script>


<script type="text/javascript">
    $(".btn-round.is-home-ajax").click(function() {
        let url = $(this).data("url");
        let btn = $(this);
        let currentClass = btn.data("class");
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response) {
                btn.removeClass(currentClass);
                btn.addClass(response.class); // them class mới ()
                btn.html(response.is_home); // thay doi ten
                btn.data("url", response.link);
                btn.data("class", response.class);

                $('.change-by-' + response.id).html(" " +
                    response.modified_by);
                $('.change-time-' + response.id).html(" " +
                    response.modified);
                console.log(response.id);
                btn.notify("Cập nhật thành công", {
                    position: "top center",
                    className: "success",
                });
            },
        });
    });
    $('.btn-order-detail').click(function() {
        let url = $(this).data('url');
        $.ajax({
            type: 'get',
            url: url,
            dataType: 'json',
            success: function(response) {
                console.log(response.product);
                $('.customer-id').text(response.items.id);
                $('.customer-name').text(response.items.order_name);
                $('.customer-phone').text(response.items.order_phone);
                $('.customer-email').text(response.items.order_email);
                $('.customer-address').text(response.items.order_address);
                var pro = "";
                response.product.forEach(element => {
                    pro += '<tr class="even pointer"><td>' + element['product_name'] + '</td><td>' + element['quantity'] + '</td><td>' + element['price'] + '&nbsp;<span>₫</span></td> </tr>'
                });
                document.getElementById('ds_product').innerHTML = pro;
            },
        })
    })
    $(function() {
            $('.dd').nestable({
                maxDepth: 2
            });
            $('.dd').on('change', function(e) {
                
            });
        });
</script>
