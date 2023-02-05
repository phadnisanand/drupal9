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
    attach: function () {
       $.fn.myfunction = function() {
        $.ajax({
          url: Drupal.url('hello-ajax-response'),
          type: 'POST',
          dataType: 'json',
          success: function (response) {
            if (response.hasOwnProperty('time')) {
              $("#block-helloajaxblock .block__content").text(response.time);            
            }
          }
        });
        return this;
    }; 
    
      setInterval(function(){ 
        $("#block-helloajaxblock .block__content").myfunction();
      }, 1000);
    }
  };



})(jQuery, Drupal);

 
