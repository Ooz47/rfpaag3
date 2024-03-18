(function ($, Drupal) {
  Drupal.behaviors.mySidebarMenu = {
    attach: function (context, settings) {

      $(context).find("#sidebar").once("some-arbitrary-but-unique-key").each(function () {

        var $element = $(this).find('.menu-item--active-trail a.is-active');
        var $sub = $element.parent().children('div').children('ul');
        $sub.removeClass('collapse');

        $.fn.isInViewport = function() {
          var elementTop = $(this).offset().top;
          var elementBottom = elementTop + $(this).outerHeight();
      
          var viewportTop = $(window).scrollTop();
          var viewportBottom = viewportTop + $(window).height();
      
          return elementBottom > viewportTop && elementTop < viewportBottom;
      };

      $(window).on('load resize', function() {
      var sidebarcontentheight = 0;

$("#sidebar").children().each(function(){
  sidebarcontentheight = sidebarcontentheight + $(this).outerHeight(true);
});

var contenuPrincipalHeight = $(".contenuprincipal").outerHeight(true);
      
      if ((contenuPrincipalHeight >= sidebarcontentheight) && (sidebarcontentheight < $(window).height()) ){ 

        $("#sidebar").css("position", "sticky");
        $("#sidebar").css("top", "100px");
        $("#sidebar").css("height", "auto");
      }
    });

   
 


      });

    

    }
  };
})(jQuery, Drupal);
