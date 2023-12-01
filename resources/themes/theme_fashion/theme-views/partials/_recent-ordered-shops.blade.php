<section class="recent-shop-section section-gap pb-0">
    <div class="container">
        <div class="section-title mb-0">
            <div class="mb-32px">
                <div class="d-flex justify-content-between text-capitalize row-gap-2 column-gap-4 align-items-center">
                    <h2 class="title mb-0 me-auto">{{ translate('shop_again_from_your_recent_store') }}</h2>
                    <div class="d-flex align-items-center column-gap-4 justify-content-end ms-auto ms-md-0 text-nowrap">
                        <div class="owl-prev recent-shop-prev">
                            <i class="bi bi-chevron-left"></i>
                        </div>
                        <div class="owl-next recent-shop-next">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                        <a href="{{route('sellers')}}" class="see-all">{{ translate('see_all') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-hidden">
            <div class="recent-shop-slider-wrapper">
                <div class="recent-shop-slider owl-theme owl-carousel">
                    @foreach ($recent_order_shops as $product)
                        @if(isset($product) && $product)
                            <div class="recent-shop-card">
                                <div class="img">
                                    <a href="{{route('product',$product->slug)}}" title="{{$product->name}}">
                                        <img loading="lazy" src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product->thumbnail}}"
                                        onerror="this.src='{{ theme_asset('assets/img/image-place-holder.png') }}'" alt="recent-shop">
                                    </a>
                                    <span class="badge badge-soft-base">
                                        {{\App\CPU\Helpers::currency_converter($product->unit_price-\App\CPU\Helpers::get_product_discount($product,$product->unit_price))}}
                                    </span>
                                </div>
                                <div class="cont">
                                    <a href="{{route('shopView',['id'=>$product->seller['id']])}}" class="recent-shop-card-author">
                                        <img loading="lazy" onerror="this.src='{{ theme_asset('assets/img/image-place-holder.png') }}'"
                                            src="{{ asset('storage/app/public/shop/'.$product->seller->shop->image)}}" alt="recent-shop">
                                        <h5 class="subtitle" title="{{ $product->seller->shop->name  }}">{{ $product->seller->shop->name  }}</h5>
                                    </a>
                                    <div class="text-center">
                                        <a href="{{route('shopView',['id'=>$product->seller['id']])}}" class="btn __btn-outline text-capitalize">{{ translate('visit_again') }}</a>
                                    </div>
                                </div>

                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</section>
