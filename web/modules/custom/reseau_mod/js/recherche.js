(function ($, Drupal) {
  Drupal.behaviors.recherche = {
    attach: function (context, settings) {


      $(context).find("#views-exposed-form-recherche-formations-page-1").once("some-arbitrary-but-unique-keyss").each(function () {

        if (typeof drupalSettings.reseau_mod.recherche !== 'undefined') {
          var profil = drupalSettings.reseau_mod.recherche.profil;
          var structure = drupalSettings.reseau_mod.recherche.structure;
          var recherche = drupalSettings.reseau_mod.recherche.recherche;
        }

        if (typeof drupalSettings.reseau_mod.recherche2 !== 'undefined') {
          var structure2 = drupalSettings.reseau_mod.recherche2.structure;

          // console.log(structure2);
        }

        if (profil) {

          profilcol = $(this).find("[data-drupal-selector='edit-profil-collapsible']");
          profilcol.attr('open', '');
          profilcol.find("summary").attr("aria-expanded", "true");
          profilcol.find("summary").attr("aria-pressed", "true");

          for (var item in profil) {
      
            var value = $("[name='profil[" + profil[item] + "]']");
            value.prop("checked", true);
          }
        }

        if (structure) {

          structurecol = $(this).find("[data-drupal-selector='edit-structure-collapsible']");
          structurecol.attr('open', '');
          structurecol.find("summary").attr("aria-expanded", "true");
          structurecol.find("summary").attr("aria-pressed", "true");

          for (var item in structure) {
        
            var value = $("[name='structure[" + structure[item] + "]']");
            value.prop("checked", true);
          }
        }
        if (recherche) {
          rechercheInput = $(this).find("[data-drupal-selector='edit-recherche']");
          rechercheInput.val(recherche);
        }

        if (structure2) {

          structurecol = $(this).find("[data-drupal-selector='edit-structure-collapsible']");
          structurecol.attr('open', '');
          structurecol.find("summary").attr("aria-expanded", "true");
          structurecol.find("summary").attr("aria-pressed", "true");

          for (var item in structure2) {
            var value = $("[name='structure[" + structure2[item] + "]']");
            value.prop("checked", true);
          }
        }



        $.fn.isInViewport = function () {
          var elementTop = $(this).offset().top;
          var elementBottom = elementTop + $(this).outerHeight();

          var viewportTop = $(window).scrollTop();
          var viewportBottom = viewportTop + $(window).height();

          return elementBottom > viewportTop && elementTop < viewportBottom;
        };

        $(window).on('load resize scroll', function () {
          var sidebarcontentheight = 0;

          $("#sidebar").children().each(function () {
            sidebarcontentheight = sidebarcontentheight + $(this).outerHeight(true);
          });

          var contenuPrincipalHeight = $(".contenuprincipal").outerHeight(true);

          if ((contenuPrincipalHeight >= sidebarcontentheight)) {


            if (sidebarcontentheight < $(window).height()) {

              $("#sidebar").css("position", "sticky");
              $("#sidebar").css("top", "100px");
              $("#sidebar").css("height", "auto");
            } else {
              $("#sidebar").css("position", "relative");
              $("#sidebar").css("top", "0");
              $("#sidebar").css("height", "100%");
            }

          } else {
            $("#sidebar").css("position", "relative");
            $("#sidebar").css("top", "0");
            $("#sidebar").css("height", "100%");
          }


        }); // window.onload






      }); //context


    }
  };
})(jQuery, Drupal);

// https://stackoverflow.com/questions/9622207/updating-existing-url-querystring-values-with-jquery
