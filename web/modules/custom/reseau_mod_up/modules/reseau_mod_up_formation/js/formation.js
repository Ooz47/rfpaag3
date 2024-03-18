(function ($, Drupal, window, document) {

    'use strict';
  
    // To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.formation = {
      attach: function (context, settings) {
        // console.log("hello");

$(context).find(".field--name-field-ctc-ref-handicap").once("aute-reference-handicap").each(function () {
    // console.log($(this).find("input").first().attr("name"));

    var inputName = $(this).find("input").first().attr("name");
    var value = $( 'input[name="'+inputName+'"]:checked' ).val();

   //Au chargement de l'entité on vérifie sur un choix est selectionnée
    if(value === undefined) {
        // si undefined on coche le premier
        $( 'input[name="'+inputName+'"]' )[0].checked= true;
        $( 'input[name="'+inputName+'"]' ).val(0);
    }

    $('input[name="'+inputName+'"]').change(function(){
        var value = $( 'input[name="'+inputName+'"]:checked' ).val();
        var champFonction = $(this).closest(".field--name-field-ctc-ref-handicap").siblings(".field--name-field-ctc-fonction").find("input");
        
        console.log(value);

        if(value == 1) {
            // console.log(value);
          
            // console.log(champFonction);
            // console.log(champFonction.val());
            // if(champFonction.val() === '' ) {
                champFonction.val("Référent Handicap");
            // }
        }
        else {
            if(champFonction.val() === 'Référent Handicap' ) {
                champFonction.val("");
            }
        }

        });

// console.log(this);
  });


    }
};

})(jQuery, Drupal, this, this.document);