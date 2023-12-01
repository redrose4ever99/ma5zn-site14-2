<div class="d-flex justify-content-center">
    <a href="javascript:">
        <img loading="lazy" src="{{theme_asset("assets/img/media/OTP-Verification-fail.png")}}" alt="logo" class="img-fluid"
            width="220">
    </a>
</div>

<h3 class="title text-center my-3 text-capitalize">{{ translate('something_went_wrong') }} !</h3>
<p class="text-center text-muted">
    {{ translate('sorry_the_number_and_email_you_provided_during_order_is_incorrect').' '.translate('We_cannot_send_any_verification_code').' '.translate('please_contact_with_admin_or_your_seller') }}
</p>

<div class="d-flex flex-column justify-content-center align-items-center gap-3 mt-5">
    @if(auth('customer')->check())
        <a href="{{route('account-tickets')}}" class="btn btn-base form-control w-auto min-w-180">{{translate('Open_Support_Ticket')}}</a>
    @else
        <button type="button" class="btn btn-base form-control w-auto min-w-180 customer_login_register_modal">{{translate('Open_Support_Ticket')}}</button>
    @endif
</div>