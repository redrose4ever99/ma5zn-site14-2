"use strict";

$(document).ready(function(){
    getVariantPrice();
});

$('.addWishlist_function_view_page').on('click', function () {
    let id = $(this).data('id');
    addWishlist_function(id);
});

$('.addCompareList_view_page').on('click', function () {
    let id = $(this).data('id');
    addCompareList(id);
});
