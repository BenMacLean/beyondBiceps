jQuery(document).ready(function ($) {
    "use strict";

    $.fn.is_on_screen = function () {
        var win = $(window);

        var viewport = {
            top: win.scrollTop(),
            left: win.scrollLeft()
        };

        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();

        var bounds = this.offset();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();

        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
    };

    $(".entry-video__preview-play").on("click", function() {
        var $videoIframe = $( this ).closest( ".entry-video" ).find( "iframe"),
            $videoImage = $( this ).closest( ".entry-video" ).find( ".entry-video__preview" );
        $videoImage.animate({
            "opacity" : 0
        }, 300 ).css("visibility", "hidden");
        $videoIframe.attr( "src", $videoIframe.attr("src") + "?autoplay=1" );
        return false;
    });

    $('input, textarea').focus(function(){
        $(this).data("placeholder", $(this).attr("placeholder")).closest(".wpcf7-form-control-wrap").addClass("wpcf7-form-control_type_focus");
        $(this).attr("placeholder", '');
    });

    $("input, textarea").blur(function(){
       $(this).attr("placeholder", $(this).data("placeholder")).closest(".wpcf7-form-control-wrap").removeClass("wpcf7-form-control_type_focus");
    });

    $(".js-anchor-link").on('click', function() {
        var elem_id = $(this).attr('href'),
            $elem = $(elem_id),
            offsetTop = $elem.offset().top,
            scrolling = offsetTop;

        $("body, html").animate({
            scrollTop : scrolling
        }, 1500);

       return false;
    });

    $( "select" ).select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    // Quantity
    $('.quantity-actions span').on('click', function() {
        var quantityContainer = $(this).closest('.quantity'),
            quantityInput = quantityContainer.find('.qty'),
            quantityVal = quantityInput.attr('value');

        if( $(this).hasClass('plus') ) {
            quantityInput.attr('value', parseInt(quantityVal) + 1);
        } else if( $(this).hasClass('minus') ) {
            if( quantityVal > 1 ) {
                quantityInput.attr('value', parseInt(quantityVal) - 1);
            }
        }
    });
    
    $(document).on('click', function(event) {
        if($(event.target).closest(".mobile-nav-search, .form_search-fullscreen").length) return;
        if( $("#js-search-fullscreen").hasClass("active") ) {
            $('#js-search-fullscreen').removeClass("active");
        }
        event.stopPropagation();
    });

    $(document).on('click', function(event) {
        if($(event.target).closest(".mobile-menu, .mobile-side-nav").length) return;
            if( $("html").hasClass("disable-scroll mobile-menu-open") ) {
                $("html").removeClass("disable-scroll").removeClass("mobile-menu-open");
            }
            $(".mobile-side-nav").animate({
                right : "-270px"
            }, 300);
            setTimeout(function() {
                if( $(".mobile-side-nav").hasClass("active") ) {
                    $(".mobile-side-nav").removeClass("active");
                }
            }, 300);
            if( $(".mobile-nav-toggle").hasClass("active") ) {
                $(".mobile-nav-toggle").removeClass("active");
            }
        event.stopPropagation();
    });

    $('.mobile-nav-toggle').on('click', function() {
        var $this = $(this),
            $html = $('html'),
            $mobileNav = $("#" + $this.attr('target-data')),
            mobileMenuHeight = $(".mobile-menu").outerHeight();

        if( $(".top-bar").length ) {
            mobileMenuHeight = mobileMenuHeight + $(".top-bar").outerHeight();
        }

        $html.toggleClass("disable-scroll").toggleClass("mobile-menu-open");
        $this.toggleClass("active");

        if( ! $mobileNav.hasClass("active") ) {
            $mobileNav.css({
                "padding-top" : mobileMenuHeight + "px"
            }).animate({
                right : 0
            }, 300).addClass("active");
        } else {
            $mobileNav.animate({
                right : "-270px"
            }, 300);
            setTimeout(function() {
                $mobileNav.removeClass("active");
            }, 300);
        }
    });

    $('.user-menu__item_search-button').on('click', function() {
        var $this = $(this);
        $("#" + $this.attr('target-data')).toggleClass('active');

        return false;
    });

    $('.mobile-nav-menu .submenu-toggle').on('click', function() {
        var $this = $(this);
        if( ! $this.hasClass("active") ) {
            $this.addClass("active").next(".sub-menu").slideDown(300).parent("li").addClass("dropdown_open");
        } else {
            $this.removeClass("active").next(".sub-menu").slideUp(300).parent("li").removeClass("dropdown_open");
        }
    });

    if( $(".header_position_sticky").length ) {
        var stickyHeader = $(".header_position_sticky");
        $(".header_position_sticky").affix({
            offset : {
                top: $( stickyHeader ).outerHeight()
            }
        });
    }

    if( $(".thumbnail__caption-text_view_hide").length ) {
        var thumbnailTextBlock = $(".thumbnail__caption-text_view_hide");

        thumbnailTextBlock.each(function() {
            $(this).data( "height", $(this).outerHeight()).height(0);
        });

        $(".thumbnail_js_hover").hover(function() {
            var animateElement = $(this).find(thumbnailTextBlock);

            animateElement.animate({
                "height" : animateElement.data("height") + "px"
            }, {
                queue: false,
                duration: 300,
                specialEasing: {
                    height: "easeInOutCubic"
                }
            });
            animateElement.animate({
                "opacity" : "1"
            }, 700, "easeInOutCubic");

        }, function() {
            var animateElement = $(this).find(thumbnailTextBlock);

            animateElement.animate({
                "height" : "0"
            }, {
                queue: false,
                duration: 300,
                specialEasing: {
                    height: "easeInOutCubic"
                }
            });
            animateElement.animate({
                "opacity" : "0"
            }, 100, "easeInOutCubic");
        });
    }

	$(document).on("click", ".woocommerce-notice__close", function() {
     $(this).closest(".woocommerce-notice").hide();
      return false;
	});

    //if(".live-customizer__palette-item input").prop("checked", true);

    $(".live-customizer__palette-item").on("click", function() {
       $(this).addClass("live-customizer__palette_active").siblings().removeClass("live-customizer__palette_active");
    });
	
	$(document).on("change", ".single-product .product-type-variable table.variations select", function() {
		$(this).parent().find('.select2-selection__rendered').text($(this).find('option[value="'+ $(this).val() +'"]').text());
	});

});