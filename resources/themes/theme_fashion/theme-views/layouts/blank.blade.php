<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('storage/app/public/company')}}/{{$web_config['fav_icon']->value}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('storage/app/public/company')}}/{{$web_config['fav_icon']->value}}">
    <link rel="stylesheet" href="{{asset('public/assets/back-end/css/toastr.css')}}"/>
    <link rel="stylesheet" media="screen" href="{{asset('public/assets/front-end/css/theme.min.css')}}">
    <link rel="stylesheet" media="screen" href="{{asset('public/assets/front-end/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/back-end/css/toastr.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/assets/front-end/css/master.css')}}"/>
</head>
<body class="toolbar-enabled">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="loading" class="d--none">
                <div class="__inline-19">
                    <img loading="lazy" width="200" src="{{asset('public/assets/front-end/img/loader.gif')}}" alt="loader">
                </div>
            </div>
        </div>
    </div>
</div>

@yield('content')

<a class="btn-scroll-top" href="javascript:" data-scroll>
    <span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">{{translate('top')}}</span><i
        class="btn-scroll-top-icon czi-arrow-up"> </i>
</a>

<script src="{{asset('public/assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('public/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src={{asset("public/assets/back-end/js/toastr.js")}}></script>
<script src="{{asset('public/assets/front-end/js/theme.min.js')}}"></script>
<script src="{{asset('public/assets/front-end/js/slick.min.js')}}"></script>

<script src="{{asset('public/assets/front-end/js/sweet_alert.js')}}"></script>
<script src={{asset("public/assets/back-end/js/toastr.js")}}></script>

{!! Toastr::message() !!}

<script>
    "use strict";
    function currency_select(val)
    {
        if(val==='multi_currency'){
            toastr.warning('{{ translate("Multi_currency_is_depends_on_exchange_rate_and_your_gateway_configuration") }} {{ translate("So_if_you_do_not_need_multi_currency_it_will_be_better_select_single_currency") }} {{ translate("We_prefer_to_use_single_currency") }}', {
            CloseButton: true,
            ProgressBar: true
        });
        }
    }
</script>
</body>
</html>
