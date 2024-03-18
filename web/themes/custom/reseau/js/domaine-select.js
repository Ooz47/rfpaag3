(function ($, Drupal) {
  Drupal.behaviors.domaineSelect = {
    attach: function (context, settings) {

      $(context).find(".bef-nested").once("some-arbitrary-but-unique-key").each(function () {

        // var $element = $(this).find('.form-check-input');
        // var $sub = $element.parent().children('div').children('ul');
        // $sub.removeClass('collapse');

        console.log($element);
        var countChecked = function(element) {
          var n = $( "input:checked" ).length;
          // $( "div" ).text( n + (n === 1 ? " is" : " are") + " checked!" );
         
          console.log(element);
        };
        // countChecked();
         
        // $element.on( "click", countChecked($element) );

        var selected = [];
        $(".form-check-input").change(function() {
          if(this.checked) {
            console.log(this);
            console.log($(this));
            var $sub = $(this).parent().parent().parent().children('ul');
            console.log($sub);
           $sub.css("display", "block");
          }
      });

      });

   

    }
  };
})(jQuery, Drupal);
