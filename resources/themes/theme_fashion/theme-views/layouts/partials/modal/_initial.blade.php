@if($web_config['popup_banner'])
<div class="modal fade initial-modal" id="initialModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close bg-text-2" data-bs-dismiss="modal" aria-label="Close"></button>
            <a href="{{$web_config['popup_banner']['url']}}" target="_blank">
                <img loading="lazy" src="{{ asset('storage/app/public/banner')}}/{{$web_config['popup_banner']['photo'] }}"
                    onerror="this.src='{{ theme_asset('assets/img/image-place-holder.png') }}'"
                    class="w-100 rounded intial-promo-banner" alt="promo">
            </a>
        </div>
    </div>
</div>
@endif
