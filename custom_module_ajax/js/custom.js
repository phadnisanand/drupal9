(function ($, Drupal, once) {
	Drupal.behaviors.testmodule = {
		attach: function (context, settings) {
			// issues in code calling 4 times.
			/*$('#showajax', context).on('click',function() {
					console.log('clicking inside behaviour');
			 });*/
			 
			 // solved issue calling only once.
			  once('myCustomBehavior', 'input#showajax', context).forEach(function (element) {
           // Apply the myCustomBehaviour effect to the elements only once.
						$('#showajax', context).on('click',function() {
							console.log('clicking inside behaviour');
					 });
      });
	  }
	}
})(jQuery, Drupal, once);
