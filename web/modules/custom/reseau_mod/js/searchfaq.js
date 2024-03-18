(function($) {
  // Argument passed from InvokeCommand.
  $.expr[":"].contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});
  $.fn.MyJavascriptCallbackFunction = function(argument) {
    $('div.accordion-item').slideUp( "fast" );
    $('article img').css('display','none');

    var result = argument.split(' ');

var foundin = {};
$.each (result, function (index, valeur) {
  foundin[index] = $('div.accordion-item:contains('+result[index]+')');
  
});

$.each (foundin, function (index, valeur) {

  valeur.slideDown( "fast" );

});

// A améliorer éventuellement pour effacer texte riche précédent accordeon vide apres recherche
// $.each (result, function (index, valeur) {
//   foundinaccordion[index] = $('.accordion:contains('+result[index]+')');
//     console.log(foundinaccordion);
// });

// $.each (foundinaccordion, function (index, valeur) {
//   console.log(valeur);
//   valeur.css('display','block');
// });

  };
})(jQuery);