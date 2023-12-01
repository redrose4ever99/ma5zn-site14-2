<footer class="footer">
    <div class="container">
        <div class="newsletter-wrapper">
            <div class="newsletter-wrapper-inner">
                <div class="cont">
                    <h5 class="title">{{ translate('newsletter') }}</h5>
                    <p>{{ translate('be_the_first_one_to_know_about_discounts_offers_and_events') }}</p>
                </div>
                <form class="newsletter-form" action="{{ route('subscription') }}" method="post">
                    @csrf
                    <div class="position-relative">
                        <label class="position-relative m-0 d-block">
                            <i class="bi bi-envelope-at envelop-icon"></i>
                            <input type="text" placeholder="{{ translate('enter_your_email') }}" class="form-control" name="subscription_email" required>
                        </label>
                        <button type="submit" class="btn btn-base">{{ translate('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container"></div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="pb-3">
                <div class="row">
                    <div class="col-lg-6 border-right-lg">
                        <div class="footer-top-wrapper flex-column">
                            <a href="{{route('home')}}" class="logo">
                                <img loading="lazy" src="{{asset("storage/app/public/company")."/".$web_config['footer_logo']->value}}" alt="logo-white"
                                onerror="this.src='{{theme_asset('assets/img/image-place-holder-2_1.png')}}'">
                            </a>
                            <div class="content line-limit w-100">
                                <p class="txt"></p>
                                {{ Str::limit((strip_tags(str_replace('&nbsp;', ' ', json_decode($web_config['about'])->value))), 180) }}
                                <a href="{{route('about-us')}}">{{ translate('read_more') }}</a>
                            </div>
                        </div>
                        <div class="footer-address">
                            <div class="footer-address-card d-flex gap-3">
                                <img loading="lazy" src="{{theme_asset('assets/img/footer/address/pin.png')}}" alt="footer/address"
                                onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                                <div>
                                    <h6 class="name">{{ translate('address') }}</h6>
                                    <a href="https://www.google.com/maps/place/{{ \App\CPU\Helpers::get_business_settings('shop_address')}}" target="_blank"
                                        class="text-dark">{{ \App\CPU\Helpers::get_business_settings('shop_address')}}
                                    </a>
                                </div>
                            </div>
                            <div class="footer-address-card d-flex gap-3">
                                <img loading="lazy" src="{{theme_asset('assets/img/footer/address/envelop.png')}}" alt="footer/address"
                                onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                                <div>
                                    <h6 class="name">{{ translate('email') }}</h6>
                                    <a class="text-dark" href="mailto:{{$web_config['email']->value}}">{{$web_config['email']->value}}</a>
                                </div>
                            </div>
                            <div class="footer-address-card d-flex gap-3">
                                <img loading="lazy" src="{{theme_asset('assets/img/footer/address/phone.png')}}" alt="footer/address"
                                onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                                <div>
                                    <h6 class="name">{{ translate('hotline') }}</h6>
                                    <div><a href="tel:{{$web_config['phone']->value}}" class="text-dark">{{$web_config['phone']->value}}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-xl-5">
                            <div class="footer-bottom-wrapper text-capitalize">
                                <div class="footer-widget">
                                    <h5 class="title">{{ translate('accounts') }}</h5>
                                    <ul class="links">
                                        <li>
                                            @if(auth('customer')->check())
                                                <a href="{{route('user-profile')}}">{{translate('profile_info')}}</a>
                                            @else
                                                <a href="javascript:" class="customer_login_register_modal">{{translate('profile_info')}}</a>
                                            @endif
                                        </li>
                                        <li>
                                            @if(auth('customer')->check())
                                                <a href="{{route('account-oder')}}">{{translate('orders')}}</a>
                                            @else
                                                <a href="javascript:" class="customer_login_register_modal">{{translate('orders')}}</a>
                                            @endif
                                        </li>

                                        @if ($web_config['ref_earning_status'])
                                        <li>
                                            @if(auth('customer')->check())
                                                <a href="{{route('refer-earn')}}">{{ translate('refer_&_earn') }}</a>
                                            @else
                                                <a href="javascript:" class="customer_login_register_modal">{{translate('refer_&_earn')}}</a>
                                            @endif
                                        </li>
                                        @endif

                                        <li>
                                            <a href="{{ route('helpTopic') }}">{{ translate('FAQs') }}</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="footer-widget ">
                                    <h5 class="title">{{ translate('quick_links') }}</h5>
                                    <ul class="links">
                                        <li>
                                            <a href="{{route('about-us')}}">{{ translate('about_us') }}</a>
                                        </li>
                                        <li>
                                            <a href="{{route('shop.apply')}}">{{ translate('sell_on') }} {{ $web_config['name']->value }}</a>
                                        </li>
                                        @if(isset($web_config['refund_policy']['status']) && $web_config['refund_policy']['status'] == 1)
                                            <li>
                                                <a href="{{route('refund-policy')}}">{{translate('refund_policy')}}</a>
                                            </li>
                                        @endif
                                        @if(isset($web_config['cancellation_policy']['status']) && $web_config['cancellation_policy']['status'] == 1)
                                            <li>
                                                <a href="{{route('cancellation-policy')}}">{{translate('cancellation_policy')}}</a>
                                            </li>
                                        @endif
                                        @if(isset($web_config['return_policy']['status']) && $web_config['return_policy']['status'] == 1)
                                            <li>
                                                <a href="{{route('return-policy')}}">{{translate('return_policy')}}</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="footer-widget">
                                    <h5 class="title">{{ translate('support') }}</h5>
                                    <ul class="links">
                                        <li>
                                            @if(auth('customer')->check())
                                                <a href="{{route('chat', ['type' => 'seller'])}}">{{ translate('live_chat') }}</a>
                                            @else
                                                <a href="javascript:" class="customer_login_register_modal">{{ translate('live_chat') }}</a>
                                            @endif
                                        </li>
                                        <li>
                                            @if(auth('customer')->check())
                                                <a href="{{route('account-tickets')}}">{{translate('support_ticket')}}</a>
                                            @else
                                                <a href="javascript:" class="customer_login_register_modal">{{translate('support_ticket')}}</a>
                                            @endif
                                        </li>
                                        <li>
                                            <a href="{{ route('track-order.index') }}">{{translate('track_order')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contacts') }}">{{translate('contact_us')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top py-20px">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <h5 class="footer-tags-title text-capitalize">{{ translate('popular_tags') }}</h5>
                        <ul class="tags">

                            @foreach ($web_config['tags'] as $item)
                            <li>
                                <a href="{{route('products')}}?search_category_value=all&name={{ str_replace(' ','+', trim($item->tag)) }}&data_from=search&page=1">{{ $item->tag }}</a>
                            </li>
                            @endforeach

                            @if ($web_config['tags']->count() == 0)
                            <li>
                                <a href="javascript:">{{ translate('no_Data_Found') }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-xl-5">
                            @if($web_config['android']['status'] || $web_config['ios']['status'])
                            <h5 class="footer-tags-title text-capitalize">{{ translate('download_our_app') }}</h5>
                            <div class="app-btns">
                                @if($web_config['android']['status'])
                                    <a href="{{ $web_config['android']['link'] }}">
                                        <img loading="lazy" src="{{theme_asset('assets/img/app-btn/google.png')}}" alt="app-btn"
                                        onerror="this.src='{{theme_asset('assets/img/image-place-holder-4_1.png')}}'">
                                    </a>
                                @endif

                                @if($web_config['ios']['status'])
                                    <a href="{{ $web_config['ios']['link'] }}">
                                        <img loading="lazy" src="{{theme_asset('assets/img/app-btn/apple.png')}}" alt="app-btn"
                                        onerror="this.src='{{theme_asset('assets/img/image-place-holder-4_1.png')}}'">
                                    </a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-base py-4">
            <div class="container">
                <div class="d-flex justify-content-evenly gap-4 justify-content-md-between flex-wrap">
                    <div class="text-center text-white">
                        {{ $web_config['copyright_text']->value }}
                    </div>
                    <ul class="links d-flex flex-wrap justify-content-center me-md-auto column-gap-4 row-gap-1">
                        <li>
                            <a href="{{route('terms')}}" class="text-white">{{translate('terms_&_conditions')}}</a>
                        </li>
                        <li>
                            <a href="{{route('privacy-policy')}}" class="text-white">{{translate('privacy_policy')}}</a>
                        </li>
                    </ul>
                    @if($web_config['social_media'])
                    <ul class="social-icons">
                        @foreach ($web_config['social_media'] as $item)
                            <li>
                                @if ($item->name == "twitter")
                                    <a href="{{$item->link}}" target="_blank" class="font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0 0 24 24">
                                        <g opacity=".3"><polygon fill="#fff" fill-rule="evenodd" points="16.002,19 6.208,5 8.255,5 18.035,19" clip-rule="evenodd"></polygon><polygon points="8.776,4 4.288,4 15.481,20 19.953,20 8.776,4"></polygon></g><polygon fill-rule="evenodd" points="10.13,12.36 11.32,14.04 5.38,21 2.74,21" clip-rule="evenodd"></polygon><polygon fill-rule="evenodd" points="20.74,3 13.78,11.16 12.6,9.47 18.14,3" clip-rule="evenodd"></polygon><path d="M8.255,5l9.779,14h-2.032L6.208,5H8.255 M9.298,3h-6.93l12.593,18h6.91L9.298,3L9.298,3z"  fill="currentColor"></path>
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{$item->link}}" target="_blank">
                                        <i class="{{$item->icon}}"></i>
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
