<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>
@php
    $items = DB::table('setting')->where('config_key','favicon')->get();
    
@endphp
    @foreach ($items as $item)
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('templates/images') }}/{!!$item->config_value!!}">
    @endforeach

<link
    href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
    rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
    rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/flexslider.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/chosen.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/color-01.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('templates/frontend/assets/css/mycss.css') }}">
