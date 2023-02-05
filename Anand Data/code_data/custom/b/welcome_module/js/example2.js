(function($) {
  // Argument passed from InvokeCommand.
  $.fn.myAjaxCallback = function(argument) {
    console.log('myAjaxCallback is called.');
    // Set textfield's value to the passed arguments.
    alert(argument);
  };
})(jQuery);