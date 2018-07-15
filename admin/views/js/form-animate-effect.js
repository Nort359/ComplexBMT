$(document).ready(function() {
	'use strict';
	
	/* ==== Анимирования формы записи ==== */
		
	var $inputsRecord = $(".record .element-input input");
	
	$inputsRecord.focus(function() {
		
		$(this).prev("p.input-placeholder")
			   .fadeIn(500)
			   .toggleClass("input-placeholder-active")
			   .css({
					top: '-65%',
					color: '#53B73F',
		
					fontSize: '16px',
					fontStyle: 'italic'
				});
				
		$(this).next("div.input-undeline")
			   .css({
				   transform: 'scale(1)'
				});
				
		$(this).css({
			boxShadow: '0 0 5px 1px #53B73F',
			border: '1px solid #53B73F'
		});
	}).blur(function() {
		
		$(this).prev("p.input-placeholder")
			   .fadeOut(500)
			   .toggleClass("input-placeholder-active")
			   .css({
					'top': '-5%',
					color: '#5A5A5A',
		
					fontSize: '14px',
					fontStyle: 'none'
				});
				
		$(this).next("div.input-undeline")
			   .css({
				   transform: 'scale(0)'
				});
				
		$(this).css({
			boxShadow: 'none',
			border: '1px solid rgba(0, 0, 0, .2)'
		});
	});
	
	/* ==== КОНЕЦ: Анимирования формы записи ==== */

}); // конец события ready