<section class="top-fashion-house section-gap pb-0">
    <div class="container">
        <div class="section-title-3 mb-0">
            <div class="mb-32px text-capialize">
                <div class="d-flex flex-wrap justify-content-between justify-content-lg-center row-gap-2 column-gap-4 align-items-center">
                    <h2 class="title mb-0">{{ translate('Top_Fashion_House') }}</h2>
                    <div class="cevron-wrapper d-flex align-items-center column-gap-4 justify-content-end ms-auto ms-md-0">
                        <div class="owl-prev fashion-prev">
                            <i class="bi bi-chevron-left"></i>
                        </div>
                        <div class="owl-next fashion-next">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                        <a href="{{route('sellers')}}" class="see-all">{{ translate('see_all') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-hidden">
            <div class="fashion-house-slider-wrapper">
                <div class="fashion-house-slider owl-theme owl-carousel">
                    @foreach($top_sellers as $seller)
                        @if($seller->shop)
                        <div class="fashion-card cursor-pointer thisIsALinkElement" data-linkpath="{{route('shopView',['id'=>$seller['id']])}}">
                            <div class="fashion-card-top">
                                <a href="javascript:" data-linkpath="{{route('shopView',['id'=>$seller['id']])}}" class="thumb thisIsALinkElement">
                                    <div class="position-relative">
                                        <div>
                                            <img loading="lazy" onerror="this.src='{{ theme_asset('assets/img/image-place-holder.png') }}'"
                                            src="{{ asset('storage/app/public/shop/'.$seller->shop->image)}}" alt="shop-logo" title="{{ $seller->shop->name  }}">
                                        </div>
                                        @if($seller->shop->temporary_close || ($seller->shop->vacation_status && ($current_date >= $seller->shop->vacation_start_date) && ($current_date <= $seller->shop->vacation_end_date)))
                                            <span class="temporary-closed position-absolute text-center h6">
                                                <span>{{translate('closed_now')}}</span>
                                            </span>
                                        @endif
                                    </div>
                                </a>

                                <img loading="lazy" src="{{asset('storage/app/public/shop/banner/'.$seller->shop->banner)}}"
                                onerror="this.src='{{ theme_asset('assets/img/image-place-holder.png') }}'" class="cover" alt="banner">

                            </div>
                            <div class="fashion-card-bottom">
                                <span class="btn">
                                    <i class="bi bi-star-fill text-star"></i> {{ round($seller->average_rating ,1) }} {{ translate('rating') }}
                                </span>
                                <span class="btn">
                                    {{ $seller->product_count > 99 ? '99+' : $seller->product_count }} {{ translate('products') }}
                                </span>
                                <a href="javascript:" data-linkpath="{{route('shopView',['id'=>$seller['id']])}}" class="btn __btn-outline thisIsALinkElement">
                                    {{ translate('visit') }}
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
