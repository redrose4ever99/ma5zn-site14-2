"use strict";

setTimeout(function () {
    $('.stripe-button-el').hide();
    $('.razorpay-payment-button').hide();
}, 10);


$('.digital_payment_btn').on('click', function (){
    $('#digital_payment').slideToggle('slow');
});

$('#pay_offline_method').on('change', function () {
    pay_offline_method_field(this.value);
});

