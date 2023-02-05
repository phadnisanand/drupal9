(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.mycustomblock = {
    attach: function (context) {
      var data = drupalSettings.test;
      //alert(data);
    }
  };
})(jQuery, Drupal, drupalSettings);
