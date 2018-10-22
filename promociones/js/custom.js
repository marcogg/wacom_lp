/*
	Countdown
	*/
	if( $('#countdown').get(0) ) {
		var countdown_date  = $('#countdown').data('countdown-date'),
			countdown_title = $('#countdown').data('countdown-title');

		$('#countdown').countdown(countdown_date).on('update.countdown', function(event) {
			var $this = $(this).html(event.strftime(countdown_title
				+ '<span class="days fuente-pixel-contador"><span class="text-color-primary">%D</span> Día%!d</span> '
				+ '<span class="hours fuente-pixel-contador"><span class="text-color-primary">%H</span> Hrs</span> '
				+ '<span class="minutes fuente-pixel-contador"><span class="text-color-primary">%M</span> Min</span> '
				+ '<span class="seconds fuente-pixel-contador"><span class="text-color-primary">%S</span> Seg</span> '
			));
		});
	}
	
	
	
	// Init Instafeed
    if( $('#instafeed').get(0) ) {
    	feed.run();
    }