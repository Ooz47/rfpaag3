(function ($, Drupal, window, document) {

  'use strict';

  // To understand behaviors, see https://drupal.org/node/756722#behaviors
  Drupal.behaviors.front = {
    attach: function (context, settings) {

      $(context).find(".popupaccueil").once("popupaccueilpresent").each(function () {
        var myModalEl = document.querySelector('.popupaccueil')
        // var modal = bootstrap.Modal.getOrCreateInstance(myModalEl) 
      
        var myModal = new bootstrap.Modal(myModalEl,  {
          keyboard: true
        })
        myModal.show();
      });

      $(context).find("#block-reseau-footer").once("some-arbitrary-but-unique-key").each(function () {
        $('#block-reseau-footer li').first().on('click', function (e) {
          e.preventDefault();
          window.location = "javascript:tarteaucitron.userInterface.openPanel();"
          $('#tarteaucitronBack').fadeIn(300);
          $('#tarteaucitron').fadeIn(500);
        });
      });

      $(context).find(".remotevideo").once("some-arbitrary-but-unique-key1").each(function () {
        $(document).on("click", ".remote_video_disabled", function (e) {
          e.preventDefault();
          window.location = "javascript:tarteaucitron.userInterface.openPanel();"
          $('#tarteaucitronBack').fadeIn(300);
          $('#tarteaucitron').fadeIn(500);
        });
      });

      $(context).find(".social-media-sharing").once("some-arbitrary-but-unique-key2").each(function () {
        $(document).on("click", ".partage_disabled", function (e) {
          e.preventDefault();
          window.location = "javascript:tarteaucitron.userInterface.openPanel();"
          $('#tarteaucitronBack').fadeIn(300);
          $('#tarteaucitron').fadeIn(500);
        });
      });

      function scrollToAnchor(){
        var aTag = $(".horizontal-tabs-panes");
        $('html,body').animate({scrollTop: aTag.offset().top - 100},400);
    }
    $(context).find(".page-node-verticale .horizontal-tabs-list").once("some-arbitrary-but-unique-keylast").each(function () {
      $(document).on("click", ".horizontal-tab-button", function (e) {
        // e.preventDefault();
        scrollToAnchor();
      });
    });
    


      /* Cookie accessibilité */
      function createCookie(name, value, days) {
        let expires = "";
        if (days) {
          const date = new Date();
          date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
          expires = `; expires=${date.toGMTString()}`;
        }
        document.cookie = `${name}=${value}${expires}; SameSite=Strict; path=/`;
      }

      function readCookie(name) {
        const nameEQ = `${name}=`;
        const ca = document.cookie.split(";");
        for (let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) === " ") c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) === 0)
            return c.substring(nameEQ.length, c.length);
        }
        return null;
      }

      function eraseCookie(name) {
        createCookie(name, "", -1);
      }

      $(context).find(".AccessBtn").once("some-arbitrary-but-unique-key4").each(function () {
        var cookieSize = readCookie('font-size') * 1;
        if (cookieSize == 0 || cookieSize == '' || isNaN(cookieSize)) {
          var size = 1;
        } else {
          var size = cookieSize;
        }

        var btnplus = $(".AccessBtn-plus");
        var btnmoins = $(".AccessBtn-moins");
        var btncontraste = $(".AccessBtn-contraste");

        var adjustFontSize = function () {
          createCookie('font-size', size, 365);
          $("html").css({
            fontSize: size + "rem"
          });
        };

        adjustFontSize();
        btnplus.click(function () {
          if (size > 1.4) {
            return;
          }
          size += .05;
          adjustFontSize();
        });

        var setContrast = function () {
          if (contrastCookie) {
            $("body").addClass('contraste');
            btncontraste.text('Version standard');
          }
        };
        var contrastCookie = readCookie('contrastCookie');
        setContrast();
        var applyContrast = function (contrastCookie) {
          if (contrastCookie) {
            $("body").removeClass('contraste');
            btncontraste.text('Version contrasté');
            eraseCookie('contrastCookie');
          } else {
            $("body").addClass('contraste');
            btncontraste.text('Version standard');
            createCookie('contrastCookie', 'contraste', 365);
          }
        };

        btnmoins.click(function () {
          if (size < 1.05) {
            return;
          }
          size -= .05;
          adjustFontSize();
        });

        btncontraste.click(function () {
          // console.log('click');
          var contrastCookie = readCookie('contrastCookie');
          applyContrast(contrastCookie);
        });

      }); //AccessBtn


      /* Custom nav pour agenda slick */
  
      $(".agenda-view .slick-prev").css("opacity", 0);
      $(context).find(".agenda-view").once("some-arbitrary-but-unique-key5").each(function () {
     
        $('.agenda-view .slick-prev').click(function () {
          $('.slick--view--agenda .slick__slider').slick('slickPrev');
          $(".agenda-view .slick-next").css("opacity", 1);
          var $element = $(context).find('.slick--view--agenda .slick__slider .slick-list .slick-track .slick-slide:first');
          if ($element.hasClass('slick-active')) {
            $(this).css("opacity", 0);
          }
        });
        $('.agenda-view .slick-next').click(function () {
          $('.slick--view--agenda .slick__slider').slick('slickNext');
          $(".agenda-view .slick-prev").css("opacity", 1);
          var $element = $(context).find('.slick--view--agenda .slick__slider .slick-list .slick-track .slick-slide:last');
          if ($element.hasClass('slick-active')) {
            $(this).css("opacity", 0);
          }
        });
      });


    }
  };

})(jQuery, Drupal, this, this.document);
