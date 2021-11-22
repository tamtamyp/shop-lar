$(document).ready(function() {
    $('.change-ajax').change(function() {
        let url = $(this).data("url");
        let btn = $(this);
        let selectValue = $(this).val();
        url = url.replace("value_new", selectValue);
        console.log(selectValue)

        $.ajax({
            type: "GET",
            url: url,
            data: {
                selectValue: selectValue
            },
            dataType: "json",
            success: function(response) {
                //         btn.html(response.display); // thay doi ten
                // btn.data("url", response.link);
                $('.change-by-' + response.id).html(" " +
                    response.modified_by);
                $('.change-time-' + response.id).html(" " +
                    response.modified);
                btn.notify("Cập nhật thành công", {
                    position: "top center",
                    className: "success",
                });
            },
        });

    });

    //======= tamtam ========
    $("#back-to-top").click(function() {
        return $("body, html").animate({
            scrollTop: 0
        }, 400), !1
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

    //======= SELECTALL ========
    $('.selectall').click(function() {
        $('.selectbox').prop('checked', $(this).prop('checked'));
    })
    $('.selectbox').change(function() {
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if (total == number) {
            $('.selectall').prop('checked', true);
        } else {
            $('.selectall').prop('checked', false);
        }
    });


    //AJAX
    // load_data();

    // function load_data() {
    //     $.get('http://localhost/shop/public/admin/slider/form', function(res) {
    //         $('#list-slider').html();

    //     });
    // }


    //======= cập nhật status ========
    $(".status-ajax").click(function() {
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
                btn.html(response.status); // thay doi ten
                btn.data("url", response.link);
                btn.data("class", response.class);

                $('.change-by-' + response.id).html(" " +
                    response.modified_by);
                $('.change-time-' + response.id).html(" " +
                    response.modified);
                btn.notify("Cập nhật thành công", {
                    position: "top center",
                    className: "success",
                });
            },
        });
    });


    //======= thông báo xóa ========
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
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
        }
    });
    // $('#btn-showAll').click(function() {
    //     this.style.background = "red";
    // })
    // $('#btn-showActive').click(function() {
    //     this.style.background = "red";
    // })

    $('#name-ajax').change(function(e) {
        var name, slug;

        //Lấy text từ thẻ input title 
        name = document.getElementById("name-ajax").value;

        //Đổi chữ hoa thành chữ thường
        slug = name.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    });


});