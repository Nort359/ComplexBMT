// JavaScript Document

$(function() {
	'use strict';
	
	// Вывод подсказки ( tooltip )
	$( 'img[title], i[title]' ).tooltip();

	$( '.participant-more-information' ).click(function( event ) {
		event.preventDefault();

		var hiddenInf = $( this ).prevAll( '.hidden-info-participant' );

		hiddenInf.slideToggle( 'slow' );

		$( this ).empty();

		if ( !$( this ).attr( 'data-open' ) || $( this ).attr('data-open') === 'false' ) {
			$( this ).attr('data-open', 'true');
			$( this ).append( '<a href=""><i class="glyphicon glyphicon-minus"></i>Меньше информации</a>' );
		} else {
			$( this ).attr('data-open', 'false');
			$( this ).append( '<a href=""><i class="glyphicon glyphicon-plus"></i>Больше информации</a>' );
		}

	});

});