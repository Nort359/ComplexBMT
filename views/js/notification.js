$(function() {
	'use strict';

	var $notification 		= $('.alert-element'),
		$notificationText 	= $('.alert-element .text'),
		maxWidth 			= 0;
		/*
	for (var i = 0; i < $notificationText.length; i++) {
		var widthNotification = $notificationText[i].width();

		if ( maxWidth < widthNotification ) {
			maxWidth = widthNotification;
		} else {
			$notificationText[i].width( maxWidth );
		}

	}*/

	setTimeout(function(){
		$notification.toggleClass('is-active');
	}, 500);


});