@if (isset($web_config['announcement']) && $web_config['announcement']['status']==1)
<div class="offer-bar" data-bg-img="{{theme_asset('assets/img/media/top-offer-bg.png')}}">
    <div class="d-flex py-2 gap-2 align-items-center">
        <div class="offer-bar-close px-2">
            <i class="bi bi-x-lg"></i>
        </div>
        <div class="top-offer-text flex-grow-1 d-flex justify-content-center fw-semibold text-center">
            {{ $web_config['announcement']['announcement'] }}
        </div>
    </div>
</div>
@endif

<header class="bg-base">
    <div class="search-form-header d-xl-none">
        <div class="d-flex w-100 align-items-center">
            <div class="close-search search-toggle" id="hide_search_toggle">
                <i class="bi bi-x-lg"></i>
            </div>
            <form class="search-form sidebar-search-form" action="{{route('products')}}" type="submit">
                <div class="input-group search_input_group">
                    <select class="select2-init header-select2 text-capitalize" id="search_category_value_mobile" name="search_category_value">
                        <option value="all">{{ translate('all_categories') }}</option>
                        @foreach($web_config['main_categories'] as $category)
                            <option value="{{ $category->id }}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                    <input type="search" class="form-control" id="input-value-mobile" onkeyup="global_search_mobile()"
                            placeholder="{{ translate('search_for_items_or_store') }}..." name="name" autocomplete="off">

                    <button class="btn btn-base" type="submit"><i class="bi bi-search"></i></button>
                    <div class="card search-card position-absolute z-99 w-100 bg-white d-none top-100 start-0 search-result-box-mobile"></div>
                </div>
                <input name="data_from" value="search" hidden>
                <input name="page" value="1" hidden>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="mobile-header-top d-sm-none text-capitalize">
            <ul class="header-right-icons mb-2">
                @if ($web_config['business_mode'] == 'multi' && $web_config['seller_registration'])
                <li>
                    <div class="d-flex">
                        <a href="{{route('shop.apply')}}" class="btn __btn-outline">{{translate('seller_reg')}}.</a>
                    </div>
                </li>
                @else
                    <li></li>
                @endif
                <li>
                    <a href="javascript:">
                        <i class="">{{ session('currency_symbol') }}</i>
                        <i class="ms-1 text-small bi bi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu __dropdown-menu">
                        <ul class="currencies">
                            @foreach ($web_config['currencies'] as $key => $currency)
                                <li class="{{($currency['code'] == session('currency_code')?'active':'')}} currency_change_function" data-currencycode="{{$currency['code']}}">{{ $currency->name }}</li>
                            @endforeach
                            <span id="currency-route" data-currency-route="{{route('currency.change')}}"></span>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:">
                        <i class="bi bi-translate"></i>
                        <i class="ms-1 text-small bi bi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu __dropdown-menu">
                        <ul class="language">
                            @php( $local = \App\CPU\Helpers::default_lang())
                            @foreach(json_decode($language['value'],true) as $key =>$data)
                                @if($data['status']==1)
                                    <li class="{{($data['code'] == $local?'active':'')}} thisIsALinkElement" data-linkpath="{{route('lang',[$data['code']])}}">
                                        <img loading="lazy" src="{{theme_asset('assets/img/flags')}}/{{ $data['code'].'.png'}}"
                                        onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'" alt="{{$data['name']}}">
                                        <span>{{ ucwords($data['name']) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="header-wrapper">
            <a href="{{route('home')}}" class="logo">
                <img loading="lazy" class="d-sm-none mobile-logo-cs" src="{{asset("storage/app/public/company")."/".$web_config['mob_logo']->value}}" alt="logo-white"
                onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                <img loading="lazy" class="d-none d-sm-block" src="{{asset("storage/app/public/company")."/".$web_config['web_logo']->value}}" alt="logo-white"
                onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
            </a>
            <div class="menu-area text-capitalize">
                <ul class="menu me-xl-4">
                    <li>
                        <a href="{{route('home')}}" class="{{ Request::is('/')?'active':'' }}">{{ translate('home') }}</a>
                    </li>
                    @php($categories = \App\CPU\CategoryManager::get_categories_with_counting())
                    <li>
                        <a href="javascript:">{{ translate('all_categories')}}</a>
                        <ul class="submenu">
                            @foreach($categories as $key => $category)
                                @if ($key <= 10)
                                    <li>
                                        <a class="py-2" href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category['name']}}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($categories->count() > 10)
                            <li>
                                <a href="{{route('products')}}" class="btn-text">{{ translate('view_all') }}</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @if($web_config['brand_setting'])
                    <li>
                        <a href="{{route('brands')}}" class="{{ Request::is('brands')?'active':'' }}">{{ translate('all_brand') }}</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{route('products',['data_from'=>'discounted','page'=>1])}}" class="{{ request('data_from')=='discounted'?'active':'' }}">
                            {{ translate('offers') }}
                            <div class="offer-count flower-bg d-flex justify-content-center align-items-center offer-count-custom ">
                                {{ ($web_config['total_discount_products'] < 100 ? $web_config['total_discount_products']:'99+') }}
                            </div>
                        </a>
                    </li>

                    @if($web_config['business_mode'] == 'multi')
                        <li>
                            <a href="{{route('sellers')}}" class="{{ Request::is('sellers')?'active':'' }}">{{translate('sellers')}}</a>
                        </li>

                        @if ($web_config['seller_registration'])
                            <li class="d-sm-none">
                                <a href="{{route('shop.apply')}}"  class="{{ Request::is('shop.apply')?'active':'' }}">{{translate('seller_reg')}}.</a>
                            </li>
                        @endif
                    @endif

                </ul>

                <ul class="header-right-icons">
                    <li class="d-none d-xl-block">
                        @if(auth('customer')->check())
                        <a href="{{ route('wishlists') }}">
                            <div class="position-relative mt-1 px-8px">
                                <i class="bi bi-heart"></i>
                                <span class="btn-status wishlist_count_status">{{session()->has('wish_list')?count(session('wish_list')):0}}</span>
                            </div>
                        </a>
                        @else
                        <a href="javascript:" class="customer_login_register_modal">
                            <div class="position-relative mt-1 px-8px">
                                <i class="bi bi-heart"></i>
                                <span class="btn-status">{{translate('0')}}</span>
                            </div>
                        </a>
                        @endif
                    </li>
                    <li id="cart_items" class="d-none d-xl-block">
                        @include('theme-views.layouts.partials._cart')
                    </li>
                    <li class="d-none d-sm-block">
                        <a href="javascript:">
                            <i class="">{{ session('currency_symbol') }}</i>
                            <i class="ms-1 text-small bi bi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu __dropdown-menu">
                            <ul class="currencies">
                                @foreach ($web_config['currencies'] as $key => $currency)
                                <li class="{{($currency['code'] == session('currency_code')?'active':'')}} currency_change_function" data-currencycode="{{$currency['code']}}">{{ $currency->name }}</li>
                                @endforeach
                                <span id="currency-route" data-currency-route="{{route('currency.change')}}"></span>
                            </ul>
                        </div>
                    </li>
                    <li class="d-none d-sm-block">
                        <a href="javascript:">
                            <i class="bi bi-translate"></i>
                            <i class="ms-1 text-small bi bi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu __dropdown-menu">
                            <ul class="language">
                                @php( $local = \App\CPU\Helpers::default_lang())
                                @foreach(json_decode($language['value'],true) as $key =>$data)
                                    @if($data['status']==1)
                                        <li class="{{($data['code'] == $local?'active':'')}} thisIsALinkElement" data-linkpath="{{route('lang',[$data['code']])}}">
                                            <img loading="lazy" src="{{theme_asset('assets/img/flags')}}/{{ $data['code'].'.png'}}"
                                            onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'" alt="{{$data['name']}}">
                                            <span>{{ ucwords($data['name']) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="d-xl-none">
                        <a href="javascript:" class="search-toggle">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                    @if(auth('customer')->check())
                    <li class="me-2 me-sm-0">
                        <a href="javascript:">
                            <i class="bi bi-person d-none d-xl-inline-block"></i>
                            <i class="bi bi-person-circle d-xl-none"></i>
                            <span class="mx-1 d-none d-md-block">{{auth('customer')->user()->f_name}}</span>
                            <i class="ms-1 text-small bi bi-chevron-down d-none d-md-block"></i>
                        </a>
                        <div class="dropdown-menu __dropdown-menu">
                            <ul class="language">
                                <li class="thisIsALinkElement" data-linkpath="{{route('account-oder')}}">
                                    <img loading="lazy" src="{{theme_asset('assets/img/user/shopping-bag.svg')}}" alt="img/user"
                                    onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                                    <span>{{ translate('my_order') }}</span>
                                </li>
                                <li class="thisIsALinkElement" data-linkpath="{{route('user-profile')}}">
                                    <img loading="lazy" src="{{theme_asset('assets/img/user/profile.svg')}}" alt="img/user"
                                    onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                                    <span>{{ translate('my_profile') }}</span>
                                </li>
                                <li class="thisIsALinkElement" data-linkpath="{{route('customer.auth.logout')}}">
                                    <img loading="lazy" src="{{theme_asset('assets/img/user/logout.svg')}}" alt="img/user"
                                    onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                                    <span>{{translate('sign_Out')}}</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @else
                    <li class="me-2 me-sm-0">
                        <a href="javascript:" class="customer_login_register_modal">
                            <i class="bi bi-person d-none d-xl-inline-block"></i>
                            <i class="bi bi-person-circle d-xl-none"></i>
                            <span class="mx-1 d-none d-md-block">{{ translate('login') }} / {{ translate('register') }}</span>
                        </a>
                    </li>
                    @endif

                    <div class="darkLight-switcher d-none d-xl-block">
                        <button type="button" title="{{ translate('Dark_Mode') }}" class="dark_button">
                            <img loading="lazy" class="svg" src="{{theme_asset('assets/img/icons/dark.svg')}}" alt="dark-mode">
                        </button>
                        <button type="button" title="{{ translate('Light_Mode') }}" class="light_button">
                            <img loading="lazy" class="svg" src="{{theme_asset('assets/img/icons/light.svg')}}" alt="light-mode">
                        </button>
                    </div>


                    @if ($web_config['business_mode'] == 'multi' && $web_config['seller_registration'])
                    <li class="me-2 me-xl-0 d-none d-sm-block">
                        <a href="{{route('shop.apply')}}" class="btn __btn-outline">{{translate('seller_reg')}}.</a>
                    </li>
                    @endif

                    <li class="nav-toggle d-xl-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <span></span>
                        <span></span>
                        <span></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header justify-content-end">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body text-capitalize d-flex flex-column">
        <div>
            <ul class="menu scrollY-60 ">
                <li>
                    <a href="{{route('home')}}">{{ translate('home') }}</a>
                </li>
                <li>
                    <a href="javascript:">{{ translate('all_categories') }}</a>
                    <ul class="submenu">
                        @foreach($categories as $key => $category)
                        @if ($key <= 10)
                        <li>
                            <a class="py-2" href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category['name']}}</a>
                        </li>
                        @endif
                        @endforeach

                        @if ($categories->count() > 10)
                        <li>
                            <a href="{{route('products')}}" class="btn-text">{{ translate('view_all') }}</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if($web_config['brand_setting'])
                <li>
                    <a href="{{route('brands')}}" >{{ translate('all_brand') }}</a>
                </li>
                @endif
                <li>
                    <a class="d-flex align-items-center gap-2" href="{{route('products',['data_from'=>'discounted','page'=>1])}}">
                        {{ translate('offers') }}
                        <div class="offer-count flower-bg d-flex justify-content-center align-items-center offer-count-custom">
                            {{ ($web_config['total_discount_products'] < 100 ? $web_config['total_discount_products']:'99+') }}
                        </div>
                    </a>
                </li>

                @if($web_config['business_mode'] == 'multi')
                    <li>
                        <a href="{{route('sellers')}}">{{translate('sellers')}}</a>
                    </li>

                    @if ($web_config['seller_registration'])
                        <li class="d-sm-none">
                            <a href="{{route('shop.apply')}}" >{{translate('seller_reg')}}.</a>
                        </li>
                    @endif
                @endif

            </ul>
        </div>

        <div class="d-flex align-items-center gap-2 justify-content-between py-4 mt-3">
            <span class="text-dark">{{ translate('theme_mode') }}</span>
            <div class="theme-bar">
                <button class="light_button active">
                    <img loading="lazy" class="svg" src="{{theme_asset('assets/img/icons/light.svg')}}" alt="light-mode">
                </button>
                <button class="dark_button">
                    <img loading="lazy" class="svg" src="{{theme_asset('assets/img/icons/dark.svg')}}" alt="dark-mode">
                </button>
            </div>
        </div>

        @if(auth('customer')->check())
            <div class="d-flex justify-content-center mb-2 pb-3 mt-auto px-4">
                <a href="{{route('customer.auth.logout')}}" class="btn btn-base w-100">{{ translate('logout') }}</a>
            </div>
        @else
            <div class="d-flex justify-content-center mb-2 pb-3 mt-auto px-4">
                <a href="javascript:" class="btn btn-base w-100 customer_login_register_modal">
                    {{ translate('login') }} / {{ translate('register') }}
                </a>
            </div>
        @endif
    </div>
</div>
