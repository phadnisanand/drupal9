(function ($, Drupal) {
	Drupal.behaviors.myModuleBehavior = {
		attach: function (context, settings) {
			$(document, context).once('my_behavior').each( function() {
				pb = new Drupal.ProgressBar('myProgressBar');
				$("#click_me").html(pb.element);
				
				const messages = new Drupal.Message();
				messages.add('test message', { type: 'status' });
				
				var input = document.createElement('input');
        		input.classList.add('form-autocomplete');
        		input.setAttribute('data-autocomplete-path', 'autocomplete/articles');

				var container = document.createElement('div');
				container.className = 'nodeselector-widget';
				container.appendChild(input);
				Drupal.behaviors.autocomplete.attach(container);
				$(".myclass11").append(container);
				
				var input1 = document.createElement('input');
				input1.setAttribute('class', 'datepicker');
				input1.setAttribute("type", "date")
				var container1 = document.createElement('div');
				container1.appendChild(input1);
				$(".myclass11").append(container1);
					
				
			/*	var $myDialog = $('<div>My dialog text</div>').appendTo('body');
				Drupal.dialog($myDialog, {
					title: 'A title',
					buttons: [{
						text: 'Close',
						click: function() {
							$(this).dialog('close');
						}
					}]
				}).showModal();*/
				
				/* var ajaxSettings = {
				url: 'node/1',
				dialogType: 'modal',
				dialog: { width: 400 },
				};
				var myAjaxObject = Drupal.ajax(ajaxSettings);
				myAjaxObject.execute();*/
		
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
