@extends('theme-views.layouts.app')

@section('title', $web_config['name']->value.' '.translate('online_shopping').' | '.$web_config['name']->value.' '.translate('ecommerce'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="twitter:url" content="{{ config('app.url') }}">
    <meta property="twitter:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">
@endpush

@section('content')

    @include('theme-views.partials._banner-section')

    <div class="container d-none d-xl-block">
        @include('theme-views.layouts.partials._search-form-partials')
    </div>

    @if ($categories->count() > 0)
        @include('theme-views.partials._categories')
    @endif

    @if ($promo_banner_middle_top)
        <div class="container d-sm-none mt-3">
            <a href="{{ $promo_banner_middle_top['url'] }}" target="_blank" class="img1 promo-1">
                <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_middle_top['photo']) }}" class="img-fluid" alt="img/promo-images"
                onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
            </a>
        </div>
    @endif





    @if ($web_config['flash_deals'])
        @include('theme-views.partials._flash-deals')
    @endif

    @if ($promo_banner_left)
        <div class="container d-sm-none overflow-hidden pt-4">
            <a href="{{ $promo_banner_left['url'] }}" target="_blank" class="img3 img-fluid">
                <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_left['photo']) }}" class="img-fluid" alt="img/promo-images"
                onerror="this.src='{{theme_asset('assets/img/image-place-holder-4_1.png')}}'">
            </a>
        </div>
    @endif

    @include('theme-views.partials._recommended-product')

    @if ($promo_banner_left && $promo_banner_middle_top && $promo_banner_middle_bottom && $promo_banner_right)
        @include('theme-views.partials._promo-banner')
    @endif

    @include('theme-views.partials._deal-of-the-day')

    @if ($promo_banner_middle_bottom)
        <div class="container d-sm-none overflow-hidden pt-4">
            <a href="{{ $promo_banner_middle_bottom['url'] }}" target="_blank" class="img2">
                <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_middle_bottom['photo']) }}" class="img-fluid" alt="img/promo-images"
                onerror="this.src='{{theme_asset('assets/img/image-place-holder-4_1.png')}}'">
            </a>
        </div>
    @endif

    @include('theme-views.partials.__featured-product')

    @include('theme-views.partials._all-products-home')

    @include('theme-views.partials._signature-product')

    @if ($web_config['business_mode'] == 'multi' && count($top_sellers) > 0)
        @include('theme-views.partials._top-stores')
    @endif

    @if ($promo_banner_right)
        <div class="container d-sm-none overflow-hidden pt-4">
            <a href="{{ $promo_banner_right['url'] }}" target="_blank" class="d-block promotional-banner">
                <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_right['photo']) }}" class="w-100 img-fluid" alt="promo-banner-right"
                onerror="this.src='{{theme_asset('assets/img/image-place-holder-4_1.png')}}'">
            </a>
        </div>
    @endif

    @include('theme-views.partials._most-demanded-product')

    @if ($web_config['business_mode'] == 'multi' && \App\CPU\get_customer() != 'offline' && count($recent_order_shops)>0)
        @include('theme-views.partials._recent-ordered-shops')
    @endif

    @if ($promo_banner_bottom)
        <div class="container">
            <div class="mt-32px">
                <a href="{{ $promo_banner_bottom->url }}" target="_blank" class="d-block promotional-banner">
                    <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_bottom['photo']) }}"
                    onerror="this.src='{{ theme_asset('assets/img/image-place-holder-6_1.png') }}'" class="w-100" alt="promo-banner-bottom">
                </a>
            </div>
        </div>
    @endif

    @if ($web_config['business_mode'] == 'multi')
        @include('theme-views.partials._other-stores')
    @endif

    @include('theme-views.partials._how-to-section')

@endsection

@if ($main_banner->count() <= 1)
@push('script')
    <script src="{{ theme_asset('assets/js/home-blade.js') }}"></script>
@endpush
@endif
