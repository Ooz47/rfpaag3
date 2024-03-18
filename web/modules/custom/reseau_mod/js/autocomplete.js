(function ($, Drupal, window, document) {

    'use strict';
  
    // To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.autocompleteReferenceEntityId  = {
      attach: function (context, settings) {


$(document).ready(function () {

      // Remove reference IDs for autocomplete elements on init.
      $('.form-autocomplete', context).once('replaceReferenceIdOnInit').each(function () {
        let splitValues = (this.value && this.value !== 'false') ?
          Drupal.autocomplete.splitValues(this.value) : [];

        if (splitValues.length > 0) {
          let labelValues = [];
          for (let i in splitValues) {
            let value = splitValues[i].trim();
            let entityIdMatch = value.match(/\s*\((.*?)\)$/);
            if (entityIdMatch) {
              labelValues[i] = value.replace(entityIdMatch[0], '');
            }
          }

          if (labelValues.length > 0) {
            $(this).data('real-value', splitValues.join(', '));
            this.value = labelValues.join(', ');
          }
        }
      });
    


  let autocomplete = Drupal.autocomplete.options;
  autocomplete.originalValues = [];
  autocomplete.labelValues = [];

  /**
   * Add custom select handler.
   */
  autocomplete.select = function (event, ui) {
    autocomplete.labelValues = Drupal.autocomplete.splitValues(event.target.value);
    autocomplete.labelValues.pop();
    autocomplete.labelValues.push(ui.item.label);
    autocomplete.originalValues.push(ui.item.value);

    $(event.target).data('real-value', autocomplete.originalValues.join(', '));
    event.target.value = autocomplete.labelValues.join(', ');

    return false;
  }



// console.log('here');











  });


    }
};

})(jQuery, Drupal, this, this.document);