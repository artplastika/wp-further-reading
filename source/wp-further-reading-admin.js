jQuery.noConflict();
jQuery(document).ready(function($) {
	$('#wpfr-behaviour-select').on('change', function loadBehaviourOptionsForm() {
		$('#wpfr-behaviour-options').empty();
		$.ajax({
			type: 'POST',
			url: WpfrAjax.ajaxUrl,
			data: { 
				action: 'wpfr_get_options_form',
				behaviour: $('#wpfr-behaviour-select').val(),
				postId: $('input[name=wpfr-post-id]').val()
			},
			success: function(result) {
				$('#wpfr-behaviour-options').html(result);
			}
		});
	});
});

