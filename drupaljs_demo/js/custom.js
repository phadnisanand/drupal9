(function ($, Drupal) {
	Drupal.behaviors.myModuleBehavior = {
		attach: function (context, settings) {
			
			  $(document, context).once('my_behavior').each( function() {
					pb = new Drupal.ProgressBar('myProgressBar');
					$("#click_me").html(pb.element);
					
					const messages = new Drupal.Message();
					messages.add('test message', { type: 'status' });
					
					 options = {
						url: 'ajaxdisplay',
						dataType: 'json',
						jsonp: false,
						type: 'GET',
						success: function (response) {
								$(".myclass").text(response[0].data);
						}
					 };
								
					Drupal.ajax(options).execute().done(
							function(comands, statusString, ajaxObject){
									console.log("we're done ;-)");
					})
      });
		}
	};
})(jQuery, Drupal);
