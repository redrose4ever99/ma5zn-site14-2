<section class="promo-section d-none d-sm-block ">
    <div class="container">
        <div class="promo-wrapper">
            @if ($promo_banner_left)
                <a href="{{ $promo_banner_left['url'] }}" target="_blank" class="img1 overflow-hidden promo-1">
                    <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_left['photo']) }}" alt="img/promo-images" class="w-100"
                    onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                </a>
            @else
                <a href="javascript:void(0)" class="img2 overflow-hidden opacity-0">
                    <img loading="lazy" src="" alt="">
                </a>
            @endif

            @if($promo_banner_middle_top || $promo_banner_middle_bottom)
                <div class="promo-2">
                    @if ($promo_banner_middle_top)
                        <a href="{{ $promo_banner_middle_top['url'] }}" target="_blank" class="img2 overflow-hidden">
                            <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_middle_top['photo']) }}" alt="img/promo-images"
                        onerror="this.src='{{theme_asset('assets/img/image-place-holder-4_1.png')}}'">
                        </a>
                    @else
                        <a href="javascript:void(0)" class="img2 overflow-hidden opacity-0">
                            <img loading="lazy" src="" alt="">
                        </a>
                    @endif

                    @if ($promo_banner_middle_bottom)
                        <a href="{{ $promo_banner_middle_bottom['url'] }}" target="_blank" class="img3 overflow-hidden">
                            <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_middle_bottom['photo']) }}" alt="img/promo-images"
                        onerror="this.src='{{theme_asset('assets/img/image-place-holder-4_1.png')}}'">
                        </a>
                        @else
                        <a href="javascript:void(0)" class="img3 overflow-hidden opacity-0">
                            <img loading="lazy" src="" alt="">
                        </a>
                    @endif
                </div>
            @endif

            @if ($promo_banner_right)
                <a href="{{ $promo_banner_right['url'] }}" target="_blank" class="img1 overflow-hidden promo-3 {{ $promo_banner_left || $promo_banner_middle_top || $promo_banner_middle_bottom != null ? '' :'w-100'}}">
                    <img loading="lazy" src="{{ asset('storage/app/public/banner/'.$promo_banner_right['photo']) }}" alt="img/promo-images"
                    onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                </a>
            @endif

        </div>
    </div>
</section>
