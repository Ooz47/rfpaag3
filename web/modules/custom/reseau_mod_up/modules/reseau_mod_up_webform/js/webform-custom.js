(function ($, Drupal, window, document) {

    'use strict';
  
    // To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.webformcustom = {
      attach: function (context, settings) {
        // console.log("hello");

var inputFormation =  $( 'select[id="edit-formations"]' );


$(context).find(inputFormation).once("inputFormation").each(function () {
    

    // inputFormation.chosen("destroy").trigger('chosen:updated');
    // $( "#edit_formations_chosen" ).chosen("destroy");
    // $( "#edit-formations" ).chosen("destroy");
    $('select[id="edit-secteurs"]').change(function(){
        // console.log(this);
        inputFormation.chosen("destroy");
    }
    );

// console.log($( "#edit_formations_chosen" ));
  });


    }
};

})(jQuery, Drupal, this, this.document);