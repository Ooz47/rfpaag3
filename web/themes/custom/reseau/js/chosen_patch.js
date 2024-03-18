Drupal.behaviors.reseauChosenAccessibilityFix = {
    attach: function(context, settings) {
      jQuery('body').on('chosen:ready', function(evt, params) {
        jQuery('.js-form-item.js-form-type-select', context).each(function(index, element) {
          jQuery(this).find('.chosen-container-multi input.chosen-search-input').attr('aria-label', jQuery.trim(jQuery(this).find('label').text()));
        });
      });
    }
  }