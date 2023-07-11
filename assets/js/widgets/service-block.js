(function($) {
    'use strict';

    var WidgetServiceBlock1Handler = function ($scope) {
      //Service Block Hover
      if ($('.service-item-current-style1').length) {
        var $service_block = $('.service-item-current-style1 .inner-box');
        $($service_block).on('mouseenter', function (e) {
                $(this).find('.content-box .inner').stop().slideDown(400);
                return false;
            });
        $($service_block).on('mouseleave', function (e) {
                $(this).find('.content-box .inner').stop().slideUp(400);
                return false;
            });
        }
    };
    var WidgetServiceBlock3Handler = function ($scope) {
        //Service Block Hover
        if ($('.service-item-current-style3').length) {
          var $service_block = $('.service-item-current-style3 .inner-box');
          $($service_block).on('mouseenter', function (e) {
                  $(this).find('.content-box .inner').stop().slideDown(400);
                  return false;
              });
          $($service_block).on('mouseleave', function (e) {
                  $(this).find('.content-box .inner').stop().slideUp(400);
                  return false;
              });
          }
      };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-cpt-services.skin-style-current-theme1",
            WidgetServiceBlock1Handler
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-cpt-services.skin-style-current-theme3",
            WidgetServiceBlock3Handler
        );
    });


})(jQuery);