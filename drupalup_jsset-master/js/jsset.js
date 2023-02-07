/**
 * @file
 * Contains JS function
 */

(function ($, Drupal, drupalSettings) {
  'use strict';
  Drupal.behaviors.jsDrupalupTest = {
    attach: function (context, settings) {
      once('myCustomBehavior', '.js-var', context).forEach(function (element) {
       $('.js-var').append('<button class="button">' + drupalSettings.js_example.title + '</button>');
      });
    }
  };
})(jQuery, Drupal, drupalSettings, once);
