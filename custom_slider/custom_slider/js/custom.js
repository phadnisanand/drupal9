(function ($, Drupal, once) {
	Drupal.behaviors.myModuleBehavior = {
		attach: function (context, settings) {
			$('.flexslider').flexslider({
				animation: "slide",
				start: function (slider) {
					$('body').removeClass('loading');
				}
			});
		}
	};
})(jQuery, Drupal, once);
