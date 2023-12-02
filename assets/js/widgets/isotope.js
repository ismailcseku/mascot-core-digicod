(function($) {
  'use strict';

  var $gallery_isotope = $(".isotope-layout");



  var TM_masonryIsotope = function ($scope) {
    //isotope firsttime loading
    if( $gallery_isotope.length > 0 ) {
      $gallery_isotope.each(function () {
        var $each_istope = $(this);
        $each_istope.imagesLoaded(function(){
          if ($each_istope.hasClass("masonry")){
            var isotope_inner = $each_istope.children('.isotope-layout-inner'),
            size = $each_istope.find('.isotope-item-sizer').width();
            tmMasonryItemsHeightResizer(size, $each_istope);

            isotope_inner.isotope({
              isOriginLeft: THEMEMASCOT.isLTR.check(),
              itemSelector: '.isotope-item',
              layoutMode: "masonry",
              masonry: {
                columnWidth: '.isotope-item-sizer'
              },
              getSortData : {
                name : function ( itemElem ) {
                  return $( itemElem ).find('.title').text();
                },
                date : '[data-date]',
              },
              filter: "*"
            });
          } else{
            var isotope_inner = $each_istope.children('.isotope-layout-inner');
            isotope_inner.isotope({
              isOriginLeft: THEMEMASCOT.isLTR.check(),
              itemSelector: '.isotope-item',
              layoutMode: "fitRows",
              getSortData : {
                name : function ( itemElem ) {
                  return $( itemElem ).find('.title').text();
                },
                date : '[data-date]',
              },
              filter: "*"
            });
          }
        });

        //search for isotope with single item and add a class to remove left right padding.
        var count = $each_istope.find('.isotope-item:not(.isotope-item-sizer)').length;
        if( count == 1 ) {
          $each_istope.addClass('isotope-layout-single-item');
        }
      });
    }
    
    //isotope filter
    $('.isotope-layout-filter').on('click', 'a', function(e) {
      var $this = $(this);
      var $this_parent = $this.parent('div');
      $this.addClass('active').siblings().removeClass('active');

      var fselector = $this.data('filter');
      var linkwith = $this_parent.data('link-with');
      if ( $('#'+linkwith).hasClass("masonry") ){
        var $this = $('#'+linkwith);
        var isotope_inner = $this.children('.isotope-layout-inner'),
        size = $this.find('.isotope-item-sizer').width();
        tmMasonryItemsHeightResizer(size, $this);
        isotope_inner.isotope({
          isOriginLeft: THEMEMASCOT.isLTR.check(),
          itemSelector: '.isotope-item',
          layoutMode: "masonry",
          masonry: {
            columnWidth: '.isotope-item-sizer'
          },
          filter: fselector
        });
      } else {
        var $this = $('#'+linkwith);
        var isotope_inner = $this.children('.isotope-layout-inner');
        isotope_inner.isotope({
          isOriginLeft: THEMEMASCOT.isLTR.check(),
          itemSelector: '.isotope-item',
          layoutMode: "fitRows",
          filter: fselector
        });
      }
      return false;
    });

    //isotope sorter
    $('.isotope-layout-sorter').on('click', 'a', function(e) {
      var $this = $(this);
      var $this_parent = $this.parent('div');
      $this.addClass('active').siblings().removeClass('active');

      var sortby = $this.data('sortby');
      var linkwith = $this_parent.data('link-with');
      if( sortby === "shuffle" ) {
        $('#'+linkwith).isotope('shuffle');
      } else {
        $('#'+linkwith).isotope({
          isOriginLeft: THEMEMASCOT.isLTR.check(),
          sortBy: sortby
        });
      }
      return false;
    });
  };




  //elementor front start
  $(window).on("elementor/frontend/init", function () {
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-interactive-tabs-title.default",
          TM_masonryIsotope
      );
  });
})(jQuery);