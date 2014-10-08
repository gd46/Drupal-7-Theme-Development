(function($){
	//Activate the wonky april fool's prank.
	//Adds javascript to load after the page loads.
	Drupal.behaviors.d7td_wonky = {
		attach: function(){
    		jQuery(document).ready(function(){
     			 jQuery.fool('wonky');
    		});
		}
	}
})(jQuery);