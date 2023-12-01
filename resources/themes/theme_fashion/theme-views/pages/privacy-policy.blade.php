@extends('theme-views.layouts.app')

@section('title', translate('privacy_policy').' | '.$web_config['name']->value.' '.translate('ecommerce'))

@section('content')

<main class="main-content d-flex flex-column gap-3 pb-3">
    <div class="page_title_overlay py-5">
        <img loading="lazy" src="{{ $page_title_banner ? asset('storage/app/public/banner/'.json_decode($page_title_banner['value'])->image) : ''}}"
            class="bg--img" alt="privacy-policy" onerror="this.src='{{ theme_asset('assets/img/page-title-bg.png') }}'">

        <div class="container">
            <h1 class="text-center text-capitalize">{{translate('privacy_policy')}}</h1>
        </div>
    </div>
    <div class="container">
        <div class="card my-4">
            <div class="card-body p-lg-4 text-dark page-paragraph">
                {!!$privacy_policy->value!!}
            </div>
        </div>
    </div>
</main>

@endsection
