/**
 * @file
 * Getting the server time via AJAX.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Replaces content of hello Ajax block with response from Ajax call.
   */
  Drupal.behaviors.helloAjaxGetTime = {
     attach: function (context, settings)  {

       $('#edit-button', context).click(function () {
          $.ajax({
          url: Drupal.url('crud/submit_data'),
          type: 'POST',
          data: $("#create-form").serialize(),
          dataType: 'json',
          success: function (response) {
             $("#result").text(response);
          }
        });
    });

    }
  };

})(jQuery, Drupal);

