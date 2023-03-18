(function ($, Drupal) {

  'use strict';
  Drupal.behaviors.mybehavior = {
    attach: function (context, settings) {
      $("#click_me", context).click(function (event) {
          alert('hello'); 
      });
 
       $("#click_me2", context).click(function (event) {
          alert('hello 2'); 
      });


    }
  };

})(jQuery, Drupal);