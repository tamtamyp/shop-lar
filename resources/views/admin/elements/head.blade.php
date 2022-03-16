<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{ asset('templates/admin/img/favicon.ico') }}" type="image/ico" />
<title>Admin | Index</title>
<!-- Bootstrap -->
<link href="{{ asset('templates/admin/asset/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ asset('templates/admin/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- NProgress -->
<link href="{{ asset('templates/admin/asset/nprogress/nprogress.css') }}" rel="stylesheet">
<!-- iCheck -->
<link href="{{ asset('templates/admin/asset/iCheck/skins/flat/green.css') }}" rel="stylesheet">
<!-- bootstrap-progressbar -->
<link href="{{ asset('templates/admin/asset/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
    rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{ asset('templates/admin/css/custom.min.css') }}" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{ asset('templates/admin/css/mycss.css') }}" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{-- back to top --}}
<style type="text/css">
    .modalImportExcel {
        width: 30%;
    }
    .back-to-top {
        position: fixed;
        top: auto;
        left: auto;
        right: 15px;
        bottom: 15px;
        font-size: 32px;
        opacity: 0.8;
        z-index: 9999;
        cursor: pointer;
    }

    .back-to-top:hover {
        opacity: 1;
    }

    .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        max-width: 600px;
        list-style: none;
        font-size: 13px;
        line-height: 20px;
    }

    .dd-list {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .dd-list .dd-list {
        padding-left: 30px;
    }

    .dd-item,
    .dd-empty,
    .dd-placeholder {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        min-height: 20px;
        font-size: 13px;
        line-height: 20px;
    }

    .dd-handle {
        display: block;
        height: 30px;
        margin: 5px 0;
        padding: 5px 10px;
        color: #333;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid #ccc;
        background: #fafafa;
        border-radius: 3px;
        box-sizing: border-box;
    }

    .dd-handle:hover {
        color: #2ea8e5;
        background: #fff;
    }

    .dd-item>button {
        position: relative;
        cursor: pointer;
        float: left;
        width: 25px;
        height: 20px;
        margin: 5px 0;
        padding: 0;
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
        border: 0;
        background: transparent;
        font-size: 12px;
        line-height: 1;
        text-align: center;
        font-weight: bold;
    }

    .dd-item>button:before {
        display: block;
        position: absolute;
        width: 100%;
        text-align: center;
        text-indent: 0;
    }

    .dd-item>button.dd-expand:before {
        content: "+";
    }

    .dd-item>button.dd-collapse:before {
        content: "-";
    }

    .dd-expand {
        display: none;
    }

    .dd-collapsed .dd-list,
    .dd-collapsed .dd-collapse {
        display: none;
    }

    .dd-collapsed .dd-expand {
        display: block;
    }

    .dd-empty,
    .dd-placeholder {
        margin: 5px 0;
        padding: 0;
        min-height: 30px;
        background: #f2fbff;
        border: 1px dashed #b6bcbf;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .dd-empty {
        border: 1px dashed #bbb;
        min-height: 100px;
        background-color: #e5e5e5;
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
    }

    .dd-dragel {
        position: absolute;
        pointer-events: none;
        z-index: 9999;
    }

    .dd-dragel>.dd-item .dd-handle {
        margin-top: 0;
    }

    .dd-dragel .dd-handle {
        box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1);
    }

    .dd-nochildren .dd-placeholder {
        display: none;
    }

    .menu-builder .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        max-width: inherit;
        list-style: none;
        font-size: 13px;
        line-height: 20px;
    }

    .menu-builder .dd .item_actions {
        z-index: 9;
        position: relative;
        top: 10px;
        right: 10px;
    }

    .menu-builder .dd .item_actions .edit {
        margin-right: 5px;
    }

    .menu-builder .dd-handle {
        display: block;
        height: 50px;
        margin: 5px 0;
        padding: 14px 25px;
        color: #333;
        text-decoration: none;
        font-weight: 700;
        border: 1px solid #ccc;
        background: #fafafa;
        border-radius: 3px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .closed-sidebar:not(.closed-sidebar-mobile) .app-header .app-header__logo .navbar-brand {
        display: none;
    }

    .dataTables_wrapper .dataTables_length {
        padding-top: 1rem;
        padding-left: 1rem;
    }

    .dataTables_wrapper .dataTables_filter {
        padding-top: 1rem;
        padding-right: 1rem;
    }

    .dataTables_wrapper .dataTables_info {
        padding-left: 1rem;
        padding-bottom: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-right: 1rem;
    }

</style>
