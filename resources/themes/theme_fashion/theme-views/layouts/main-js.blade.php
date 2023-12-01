<script>
    "user strict";
    (function ($) {
        $(window).on("load", function () {
            const img = $(".__bg-img");
            img.css("background-image", function () {
                var bg = "url(" + $(this).data("img") + ")";
                var bg = `url(${$(this).data("img")})`;
                return bg;
            });
        });
        $(document).ready(function () {
            $(".scrollRight").on("click", function () {
                const wrapper = $(this).siblings(".scroller-inner");
                var leftPos = wrapper.scrollLeft();
                wrapper.animate({ scrollLeft: leftPos + 140 }, 200);
            });
            $(".scrollLeft").on("click", function () {
                const wrapper = $(this).siblings(".scroller-inner");
                var leftPos = wrapper.scrollLeft();
                wrapper.animate({ scrollLeft: leftPos - 140 }, 200);
            });

            setBaseColor = function (argument) {
                if (argument.length === 6) {
                    var aRgbHex = argument.match(/.{1,2}/g);
                    var aRgb = [
                        parseInt(aRgbHex[0], 16),
                        parseInt(aRgbHex[1], 16),
                        parseInt(aRgbHex[2], 16),
                    ];
                    $(":root").css({
                        "--base": `#${argument}`,
                        "--base-rgb": `${aRgb[0]}, ${aRgb[1]}, ${aRgb[2]}`,
                    });
                } else {

                    throw "Please Enter 6 Digit Color Code";
                }

                return aRgb;
            };

            var countDown = $(".countdown");
            $.each(countDown, function (i, v) {
                $(v).countdown({
                    date: $(v).data("countdown"),
                    offset: +6,
                    day: "Day",
                    days: "Days",
                });
            });

            $(".cookie-accept").on("click", function () {
                $(this).closest(".cookie-section").slideUp(500);
            });
            $(".selected-filters ul li").on("click", function () {
                if ($(".selected-filters ul li").length === 1) {
                    $(this).closest(".selected-filters").remove();
                }
                $(this).remove();
            });
            $(".selected-filters .clear-all").on("click", function () {
                $(this).closest(".selected-filters").remove();
            });

            $(".submenu").closest("li").addClass("has-child");
            $(".menu li a").on("click", function (e) {
                var element = $(this).parent("li");
                if (element.hasClass("open")) {
                    element.removeClass("open");
                    element.find(".submenu").removeClass("open");
                    element.find(".submenu").slideUp(200, "swing");
                } else {
                    element.addClass("open");
                    element.children(".submenu").slideDown(200, "swing");
                    element
                        .siblings("li")
                        .children(".submenu")
                        .slideUp(200, "swing");
                    element.siblings("li").removeClass("open");
                    element.siblings("li").find(".menu li a").removeClass("open");
                    element.siblings("li").find(".submenu").slideUp(200, "swing");
                }
            });

            let mobile_header_top = $(".mobile-header-top");
            $(window).on("scroll", function () {
                if ($(this).scrollTop() > 0) {
                    mobile_header_top.slideUp(200)
                } else {
                    mobile_header_top.slideDown(200)
                }
            });

            $(".easyzoom").each(function () {
                $(this).easyZoom();
            });


            var tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
            );
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            var popoverTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="popover"]')
            );
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
            //
            $(".product-information-view-more").on("click", function () {
                if ($(this).closest(".product-information").hasClass("active")) {
                    $(this).closest(".product-information").removeClass("active");
                    $(this).text($(this).data("view-more"));
                } else {
                    $(this).closest(".product-information").addClass("active");
                    $(this).text($(this).data("view-less"));
                }
            });
            $(".product-information .nav-item-ative").on("click", function () {
                $(this).closest(".product-information").removeClass("active");
                $(this)
                    .closest(".product-information")
                    .find(".product-information-view-more")
                    .text($(".product-information-view-more").data("view-more"));
            });

            var current = location.pathname;
            var $path = current.substring(current.lastIndexOf("/") + 1);
            $(".menu li a").each(function (e) {
                var $this = $(this);
                if ($path == $this.attr("href")) {
                    $this.parent("li").addClass("active open");
                    $this
                        .parent("li")
                        .closest("li")
                        .addClass("active sub-menu-opened");
                } else if ($path == "") {
                    $(".menu li:first-child").addClass("active open");
                }
            });

            const lineLimitFunc = () => {
                const text = $(".line-limit .txt").text();
                const len = text.length;

                if (len > 330) {
                    $(".line-limit .txt").text(
                        $(".line-limit .txt").text().substr(0, 330) + "...  "
                    );
                }
                $(".line-limit .read-more").on("click", function () {
                    if ($(this).hasClass("active")) {
                        $(this).removeClass("active");
                        $(this).text("Read More");
                        $(this)
                            .siblings(".txt")
                            .text(
                                $(".line-limit .txt").text().substr(0, 330) +
                                "...  "
                            );
                    } else {
                        $(this).addClass("active");
                        $(this).siblings(".txt").text(text);
                        $(this).text("Read Less");
                    }
                });
            };
            lineLimitFunc();
            const setHeightFunc = () => {
                const height = $(".newsletter-wrapper").height();
                $("footer").css({
                    marginTop: height / 2,
                });
                $(".newsletter-wrapper").css({
                    marginBottom: (-1 * height) / 2,
                });
            };
            setHeightFunc();
            $(window).on("resize", setHeightFunc);

            const flashDeal = $(".flash-deal-slider").owlCarousel({
                margin: 16,
                items: 2,
                responsiveClass: true,
                nav: false,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 800,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false' }},
                responsive: {
                    320: {
                        items: 3,
                    },
                    992: {
                        items: 4,
                    },
                    1200: {
                        items: 6,
                    },
                },
            });
            $(window).on("load", function () {
                flashDeal.trigger("next.owl.carousel");
            });
            $(".flash-next").on("click", function () {
                flashDeal.trigger("next.owl.carousel", [600]);
            });
            $(".flash-prev").on("click", function () {
                flashDeal.trigger("prev.owl.carousel", [600]);
            });

            const recommendedProducts = $(".recommended-slider").owlCarousel({
                margin: 16,
                items: 1.3,
                responsiveClass: true,
                nav: false,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false' }},
                responsive: {
                320: {
                    items: 2.3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 6,
                },
                },
            });
            $(window).on("load", function () {
                recommendedProducts.trigger("next.owl.carousel");
            });
            $(".recommended-next").on("click", function () {
                recommendedProducts.trigger("next.owl.carousel", [600]);
            });
            $(".recommended-prev").on("click", function () {
                recommendedProducts.trigger("prev.owl.carousel", [600]);
            });

            const fashionHouse = $(".fashion-house-slider").owlCarousel({
                margin: 16,
                items: 1.3,
                responsiveClass: true,
                nav: false,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2500,
                autoplayHoverPause: true,
                smartSpeed: 600,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                responsive: {
                    480: {
                        items: 2.2,
                    },
                    768: {
                        items: 2,
                        margin: 16,
                    },
                    992: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                        margin: 26,
                    },
                },
            });
            $(".fashion-next").on("click", function () {
                fashionHouse.trigger("next.owl.carousel", [600]);
            });
            $(".fashion-prev").on("click", function () {
                fashionHouse.trigger("prev.owl.carousel", [600]);
            });

            const signatureProducts = $(".signature-products-slider").owlCarousel({
                items: 1.4,
                margin: 4,
                responsiveClass: true,
                mouseDrag:false,
                nav: false,
                dots: false,
                loop: false,
                autoplay: false,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                responsive: {
                    425: {
                        items: 2,
                        margin: 5,
                    },
                    768: {
                        items: 2,
                        margin: 5,
                    },
                    992: {
                        items: 4,
                        margin: 5,
                    },
                    1200: {
                        items: 4,
                        margin: 5,
                    },
                },
            });

            const recentShop = $(".recent-shop-slider").owlCarousel({
                margin: 16,
                responsiveClass: true,
                nav: false,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                responsive: {
                    0: {
                        items: 1.4,
                    },
                    480: {
                        items: 3.2,
                    },
                    768: {
                        items: 4.2,
                        margin: 16,
                    },
                    992: {
                        items: 5.2,
                    },
                    1200: {
                        items: 6.2,
                        margin: 26,
                    },
                },
            });
            $(".recent-shop-next").on("click", function () {
                recentShop.trigger("next.owl.carousel", [600]);
            });
            $(".recent-shop-prev").on("click", function () {
                recentShop.trigger("prev.owl.carousel", [600]);
            });

            const topRatedFromStoreTwo = $(".slider").owlCarousel({
                margin: 20,
                responsiveClass: true,
                nav: true,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                items: 1,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                responsive: {
                    500: {
                        items: 2,
                    },
                    992: {
                        items: 1,
                    },
                },
            });
            $(".top-rated-product-from-store-single-next").on("click", function () {
                topRatedFromStoreTwo.trigger("next.owl.carousel", [600]);
            });
            $(".top-rated-product-from-store-single-prev").on("click", function () {
                topRatedFromStoreTwo.trigger("prev.owl.carousel", [600]);
            });

            const topRatedFromStore = $(
                ".top-rated-product-from-store-slider"
            ).owlCarousel({
                margin: 20,
                responsiveClass: true,
                nav: false,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                items: 1,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                responsive: {
                    500: {
                        items: 2,
                    },
                    992: {
                        items: 2,
                    },
                    1200: {
                        items: 3,
                    },
                },
            });
            $(".top-rated-product-from-store-next").on("click", function () {
                topRatedFromStore.trigger("next.owl.carousel", [600]);
            });
            $(".top-rated-product-from-store-prev").on("click", function () {
                topRatedFromStore.trigger("prev.owl.carousel", [600]);
            });

            $(".similler-product-slider").owlCarousel({
                margin: 0,
                responsiveClass: true,
                nav: true,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                responsive: {
                    0: {
                        items: 3,
                        margin: 10,
                    },
                    480: {
                        items: 4,
                        margin: 18,
                    },
                    768: {
                        items: 4,
                        margin: 18,
                    },
                    992: {
                        items: 6,
                        margin: 18,
                    },
                    1200: {
                        items: 8,
                        margin: 26,
                    },
                },
            });

            $(".similler-product-slider-2").owlCarousel({
                margin: 0,
                responsiveClass: true,
                nav: true,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                responsive: {
                    0: {
                        items: 3,
                        margin: 10,
                    },
                    480: {
                        items: 4,
                        margin: 18,
                    },
                    768: {
                        items: 5,
                        margin: 18,
                    },
                    992: {
                        items: 8,
                        margin: 18,
                    },
                    1200: {
                        items: 10,
                        margin: 26,
                    },
                },
            });

            const othersStore = $(".others-store-slider").owlCarousel({
                responsiveClass: true,
                nav: false,
                dots: false,
                loop: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                responsive: {
                    0: {
                        items: 1.2,
                        margin: 10,
                    },
                    480: {
                        items: 2,
                        margin: 26,
                    },
                    768: {
                        items: 2,
                        margin: 26,
                    },
                    992: {
                        items: 3,
                        margin: 26,
                    },
                    1200: {
                        items: 4,
                        margin: 26,
                    },
                },
            });
            $(".store-next").on("click", function () {
                othersStore.trigger("next.owl.carousel", [600]);
            });
            $(".store-prev").on("click", function () {
                othersStore.trigger("prev.owl.carousel", [600]);
            });

            const banner = $(".banner-slider")
                .owlCarousel({
                    margin: 0,
                    responsiveClass: true,
                    nav: false,
                    dots: false,
                    loop: false,
                    rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                    responsive: {
                        0: {
                            items: 1,
                        },
                        768: {
                            items: 6,
                            loop: false,
                        },
                        992: {
                            items: 7,
                        },
                        1200: {
                            items: 6,
                        },
                    },
                    onInitialized: function (property) {
                        let current = property.item.index;
                        $(".owl-item").removeClass("selected-item");
                        let selected = $(property.target)
                            .find(".owl-item")
                            .eq(current);
                        selected.addClass("selected-item");
                    },
                })
                .on("changed.owl.carousel", function (property) {
                    let current = property.item.index;
                    $(".owl-item").removeClass("selected-item");
                    let selected = $(property.target)
                        .find(".owl-item")
                        .eq(current)
                        .addClass("selected-item");
                });
                $(".banner-slider .owl-item").on("click", function () {
                    owlIndex = $(this).index();
                    $(".banner-slider .owl-stage-outer").trigger(
                        "to.owl.carousel",
                        owlIndex
                    );
                    $(".owl-item").removeClass("selected-item");
                    $(this).addClass("selected-item");
                    console.log('owlIndex',owlIndex);
                });

                $(".banner-slider .shapes, .banner-slider .banner-arrow").on(
                    "click",
                    function (e) {
                        owlIndex = $(this).closest(".owl-item").index();
                        $(".banner-slider .owl-stage-outer").trigger(
                            "to.owl.carousel",
                            owlIndex + 1
                        );
                    }
                );

            $(window).on("load", function () {
                $(".select2-init").select2();
            });

            $(".widget .widget-header").each(function () {
                if ($(this).hasClass("open")) {
                    $(this).siblings(".widget-body").show();
                    $(this).removeClass("open");
                } else {
                    $(this).siblings(".widget-body").hide();
                    $(this).addClass("open");
                }
                $(this).on("click", function () {
                    if ($(this).hasClass("open")) {
                        $(this).siblings(".widget-body").slideDown(300);
                        $(this).removeClass("open");
                    } else {
                        $(this).siblings(".widget-body").slideUp(300);
                        $(this).addClass("open");
                    }
                });
            });

            $(".all-categories .form--check").each(function () {
                const $this = $(this);
                if (
                    $this
                        .children(".form--check-inner")
                        .children("input")
                        .is(":checked")
                ) {
                    $this.children(".form-check-subgroup").show();
                } else {
                    $this.children(".form-check-subgroup").hide();
                }
                $this
                    .children(".form--check-inner")
                    .children("input")
                    .on("change", function () {
                        if (
                            $this
                                .children(".form--check-inner")
                                .children("input")
                                .is(":checked")
                        ) {
                            $this.children(".form-check-subgroup").slideDown(300);
                        } else {
                            $this.children(".form-check-subgroup").slideUp(300);
                        }
                    });
            });

            $(".variation-item .subtitle").each(function () {
                if ($(this).hasClass("open")) {
                    $(this).siblings(".variation-body").show();
                    $(this).removeClass("open");
                } else {
                    $(this).siblings(".variation-body").hide();
                    $(this).addClass("open");
                }
                $(this).on("click", function () {
                    if ($(this).hasClass("open")) {
                        $(this).siblings(".variation-body").slideDown(300);
                        $(this).removeClass("open");
                    } else {
                        $(this).siblings(".variation-body").slideUp(300);
                        $(this).addClass("open");
                    }
                });
            });
            if ($("#input-slider").length) {

                var formatForSlider = {
                    from: function (formattedValue) {
                        return Number(formattedValue);
                    },
                    to: function (numericValue) {
                        return Math.round(numericValue);
                    },
                };
                var formatSlider = document.getElementById("input-slider");

                noUiSlider.create(formatSlider, {
                    start: ["20.0", "80.0"],
                    range: {
                        min: 0,
                        max: 1000000,
                    },
                    format: formatForSlider,
                    tooltips: {
                        to: function (numericValue) {
                            return numericValue.toFixed(0);
                        },
                    },
                });


                formatSlider.noUiSlider.set(["0", "1000000"]);

                var formatValues = [
                    document.getElementById("price-range-start"),
                    document.getElementById("price-range-end"),
                ];

                formatSlider.noUiSlider.on(
                    "update",
                    function (values, handle, unencoded) {
                        formatValues[handle].value = values[handle];
                    }
                );
                formatSlider.noUiSlider.on(
                    "change",
                    function (values, handle, unencoded) {
                        formatValues[handle].value = values[handle];
                        inputTypeNumberClick(1, "price");
                    }
                );
            }
            $(".filter-toggle").on("click", function () {
                $(".sidebar").addClass("active");
                $(".overlay").addClass("active");
            });

            $(".close-sidebar").on("click", function () {
                $(".sidebar, .overlay").removeClass("active");
            });
            $(".overlay").on("click", function () {
                $(".sidebar, .overlay, .nav-toggle, .menu").removeClass("active");
            });

            $(".js-password-toggle").each(function () {
                $(this)
                    .siblings("input:password")
                    .css("padding-inline-end", "40px");

                if ($(this).hasClass("type-password")){
                    $(this).html('<i class="bi fill"></i>');
                }else {
                    $(this).html('<i class="bi bi-eye-slash-fill"></i>');
                }

                $(this).on("click", function () {
                    const sibling = $(this).siblings("input");
                    if (sibling.hasClass("type-password")) {
                        sibling.removeClass("type-password");
                        sibling.attr("type", "password");
                        $(this).html('<i class="bi bi-eye-slash-fill"></i>');
                    } else {
                        sibling.addClass("type-password");
                        sibling.attr("type", "text");
                        $(this).html('<i class="bi bi-eye-fill"></i>');
                    }
                });
            });

            var sync1 = $("#sync1");
            var sync2 = $("#sync2");
            var thumbnailItemClass = ".owl-item";
            var slides = sync1
                .owlCarousel({
                    startPosition: 0,
                    items: 1,
                    loop: false,
                    margin: 0,
                    mouseDrag: true,
                    touchDrag: true,
                    pullDrag: false,
                    scrollPerPage: true,
                    autoplayHoverPause: false,
                    nav: false,
                    dots: false,
                    rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                })
                .on("changed.owl.carousel", syncPosition);

            function syncPosition(el) {
                $owl_slider = $(this).data("owl.carousel");
                var loop = $owl_slider.options.loop;

                if (loop) {
                    var count = el.item.count - 1;
                    var current = Math.round(
                        el.item.index - el.item.count / 2 - 0.5
                    );
                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }
                } else {
                    var current = el.item.index;
                }

                var owl_thumbnail = sync2.data("owl.carousel");
                var itemClass = "." + owl_thumbnail.options.itemClass;

                var thumbnailCurrentItem = sync2
                    .find(itemClass)
                    .removeClass("synced")
                    .eq(current);
                thumbnailCurrentItem.addClass("synced");

                if (!thumbnailCurrentItem.hasClass("active")) {
                    var duration = 500;
                    sync2.trigger("to.owl.carousel", [current, duration, true]);
                }
            }
            var thumbs = sync2
                .owlCarousel({
                    startPosition: 0,
                    items: 6,
                    loop: false,
                    margin: 10,
                    autoplay: false,
                    nav: false,
                    dots: false,
                    rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
                    responsive: {
                        576: {
                            items: 4,
                        },
                        768: {
                            items: 5,
                        },
                        992: {
                            items: 5,
                        },
                        1200: {
                            items: 6,
                        },
                        1400: {
                            items: 7,
                        },
                    },
                    onInitialized: function (e) {
                        var thumbnailCurrentItem = $(e.target)
                            .find(thumbnailItemClass)
                            .eq(this._current);
                        thumbnailCurrentItem.addClass("synced");
                    },
                })
                .on("click", thumbnailItemClass, function (e) {
                    e.preventDefault();
                    var duration = 500;
                    var itemIndex = $(e.target).parents(thumbnailItemClass).index();
                    sync1.trigger("to.owl.carousel", [itemIndex, duration, true]);
                })
                .on("changed.owl.carousel", function (el) {
                    var number = el.item.index;
                    $owl_slider = sync1.data("owl.carousel");
                    $owl_slider.to(number, 500, true);
                });
            sync1.owlCarousel();
            var CartPlusMinus = $(".inc-inputs");
            CartPlusMinus.prepend(
                '<div class="dec qtyBtn text-base"><i class="bi bi-dash-lg"></i></div>'
            );
            CartPlusMinus.append(
                '<div class="inc qtyBtn text-base inc-button"><i class="bi bi-plus-lg"></i></div>'
            );
            $(".qtyBtn").on("click", function () {
                var $button = $(this);
                var oldValue = parseFloat($button.parent().find("input").val());
                var oldMaxValue = parseInt(
                    $button.parent().find("input").attr("max")
                );
                var oldMinValue = parseInt(
                    $button.parent().find("input").attr("min")
                );
                var outofstock = $(".add_to_cart_form").data("outofstock");
                var newVal = oldValue;
                if ($(this).hasClass("inc")) {
                    if (oldValue < oldMaxValue) {
                        newVal = oldValue + 1;
                        $('.qtyBtn').removeClass('disabled')
                        $('.qtyBtn').addClass('text-base')
                    } else {
                        toastr.warning(outofstock);
                        $('.qtyBtn').addClass('disabled')
                        $('.qtyBtn').removeClass('text-base')
                    }
                } else {
                    if (oldValue > oldMinValue) {
                        newVal = oldValue - 1;
                        $('.qtyBtn').removeClass('disabled')
                        $('.qtyBtn').addClass('text-base')
                    } else {
                        newVal = oldMinValue;
                    }
                }
                $button.parent().find("input").val(newVal);
                stock_check();
            });

            $('input[name="select-all-cart-product"]').on("click", function () {
                $('input[name="cart-product"]').prop(
                    "checked",
                    $(this).prop("checked")
                );
            });
            $('input[name="cart-product"]').click(function () {
                if (!$(this).prop("checked")) {
                    $('input[name="select-all-cart-product"]').prop(
                        "checked",
                        false
                    );
                }
            });

            $($(".rounded").closest("tr").prev()).each(function () {
                if ($(this)) {
                    $(this).find("td").addClass("border-0");
                }
            });
            if ($('[name="same-billing-address"]').prop("checked")) {
                $("#billing-address").hide();
            } else {
                $("#billing-address").slideDown(300);
            }
            $('[name="same-billing-address"]').on("change", function () {
                if ($('[name="same-billing-address"]').prop("checked")) {
                    $("#billing-address").slideUp(300);
                } else {
                    $("#billing-address").slideDown(300);
                }
            });
            $(".owl-prev").html('<i class="bi bi-chevron-left"></i>');
            $(".owl-next").html('<i class="bi bi-chevron-right"></i>');

            $(".input-file").on("change", function () {
                _readFileDataUrl(this, function (err, files) {
                    if (err) {
                        return;
                    } else {
                        const index = 0;
                        files.map((item, i) => {
                            $("#view").append(`
						<div class="img">
							<i class="bi bi-x-lg"></i>
							<img src="${item}" />
						</div>
						`);
                        });
                        $("#view i").on("click", function () {
                            $(this).closest(".img").remove();
                        });
                    }
                });
            });
            var _readFileDataUrl = function (input, callback) {
                var len = input.files.length,
                    _files = [],
                    res = [];
                var readFile = function (filePos) {
                    if (!filePos) {
                        callback(false, res);
                    } else {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            res.push(e.target.result);
                            readFile(_files.shift());
                        };
                        reader.readAsDataURL(filePos);
                    }
                };
                for (var x = 0; x < len; x++) {
                    _files.push(input.files[x]);
                }
                readFile(_files.shift());
            };

            $(".__chat-menu .nav--tabs-3 li").on("click", function () {
                if ($(this).children("a").hasClass("active")) {
                    $(".__chat-content")
                        .find(".tab-pane")
                        .removeClass("show active");
                    $(".__chat-menu .nav-tabs-menu li a").removeClass("active");
                }
                const firstIndex = $(".__chat-menu")
                    .find(".tab-pane.active")
                    .find(".nav-tabs-menu li:first-child a");
                firstIndex.addClass("active");
                const id = firstIndex.attr("href");
                $(".tab-content").find(id).addClass("show active");
            });

            $(".upload-wrapper").each(function () {
                var prevThumb = $(this).find(".thumb");
                var $this = $(this);
                var prevImg = prevThumb.html();
                function proPicURL(input) {
                    if (input.files && input.files[0]) {
                        var uploadedFile = new FileReader();
                        uploadedFile.onload = function (e) {
                            var preview = prevThumb;
                            preview.html(
                                `<img src="${e.target.result}" alt="user">`
                            );
                            preview.hide();
                            preview.fadeIn(650);
                            $this.find(".remove-img").show();
                        };
                        uploadedFile.readAsDataURL(input.files[0]);
                    }
                }
                $(this)
                    .find("input")
                    .on("change", function () {
                        proPicURL(this);
                    });
                $(".remove-img").on("click", function () {
                    $(this).closest(".upload-wrapper").find(".thumb").html(prevImg);
                    $(this)
                        .closest(".upload-wrapper")
                        .find("input[type=file]")
                        .val("");
                    $(this).hide();
                    validate_step_one();
                });
            });


            function collapse() {
                $(document.body).on(
                    "click",
                    '[data-toggle="collapse"]',
                    function (e) {
                        e.preventDefault();
                        var target = "#" + $(this).data("target");

                        $(this).toggleClass("collapsed");
                        $(target).slideToggle();
                    }
                );
            }
            collapse();


            function copyToClipboard(value) {
                var tempInput = $("<input>");
                $("body").append(tempInput);
                tempInput.val(value).select();
                document.execCommand("copy");
                tempInput.remove();
            }

            $(".coupon-code .copy-btn").click(function () {
                var inputValue = $(".coupon-code .form-control").val();
                copyToClipboard(inputValue);
                alert("Copied to clipboard!");
            });


            $(".search-toggle").on("click", function () {
                $(".search-form-header").toggleClass("open");
            });

            $("img.svg").each(function () {
                var $img = jQuery(this);
                var imgID = $img.attr("id");
                var imgClass = $img.attr("class");
                var imgURL = $img.attr("src");

                jQuery.get(
                    imgURL,
                    function (data) {
                        var $svg = jQuery(data).find("svg");

                        if (typeof imgID !== "undefined") {
                            $svg = $svg.attr("id", imgID);
                        }
                        if (typeof imgClass !== "undefined") {
                            $svg = $svg.attr("class", imgClass + " replaced-svg");
                        }

                        $svg = $svg.removeAttr("xmlns:a");

                        if (
                            !$svg.attr("viewBox") &&
                            $svg.attr("height") &&
                            $svg.attr("width")
                        ) {
                            $svg.attr(
                                "viewBox",
                                "0 0 " +
                                $svg.attr("height") +
                                " " +
                                $svg.attr("width")
                            );
                        }

                        $img.replaceWith($svg);
                    },
                    "xml"
                );
            });

            function themeSwitcher(className, themeName) {
                $(className).on("click", function () {
                    $(".theme-bar button, .darkLight-switcher button").removeClass(
                        "active"
                    );
                    $(this).addClass("active");
                    $("body").attr("theme", themeName);
                    localStorage.setItem("theme", themeName);
                });
            }
            themeSwitcher(".darkLight-switcher .light_button", "dark");
            themeSwitcher(".darkLight-switcher .dark_button", "light");

            themeSwitcher(".theme-bar .light_button", "light");
            themeSwitcher(".theme-bar .dark_button", "dark");

            $(window).on("load", function () {
                let themeName = localStorage.getItem("theme") ?? 'light';
                $(".dir-bar button").removeClass("active");
                if (themeName == "dark") {
                    $(".light_button").removeClass("active");
                    $(".dark_button").addClass("active");
                } else {
                    $(".dark_button").removeClass("active");
                    $(".light_button").addClass("active");
                }
                $("body").attr("theme", themeName);
                $(".settings-sidebar .theme-bar").addClass("d-flex");
            });
        });
    })(jQuery);

</script>


<script>

    $('.customer_login_register_modal').on('click', function () {
        $.ajax({
            url: $('#get-login-modal-data').data('route'),
            method: 'GET',
            beforeSend: function () {
                $("#loading").addClass("d-grid");
            },
            success: function (data) {
                $('#login-and-register-modal-section').html(data.login_modal);
                $('#login-and-register-modal-section').append(data.register_modal);
                $('#SignInModal').modal('show');
            },
            complete: function () {
                $("#loading").removeClass("d-grid");
            },
        });
    });

</script>
