$(document).ready(function() {
	'use strict';
	
	/* ==== Таймер ==== */

	var $days = $(".timer p.timer-days"),
		$hours = $(".timer p.timer-hours"),
		$minutes = $(".timer p.timer-minutes"),
		$seconds = $(".timer p.timer-seconds"),
		
		$span_days = $(".timer p.timer-days + span"),
		$span_hours = $(".timer p.timer-hours + span"),
		$span_minutes = $(".timer p.timer-minutes + span"),
		$span_seconds = $(".timer p.timer-seconds + span"),
		
		$priceOld = $(".prices p.price-old"),
		$priceNew = $(".prices p.price-new"),
		
		discount = 10,
		
		priceOld_text = 10599,
		priceNew_text = Math.round(priceOld_text - (priceOld_text * discount / 100)),
		
		days_text = parseInt($days.text()),
		hours_text = parseInt($hours.text()),
		minutes_text = parseInt($minutes.text()),
		seconds_text = parseInt($seconds.text()),
		
		chekerTimer = false;
	
	
	setInterval(function() {
		if(seconds_text > 0) {
			seconds_text--;
		} else {
			if(minutes_text > 0) {
				minutes_text--;
				seconds_text = 59;
			} else {
				if(hours_text > 0) {
					hours_text--;
					minutes_text = 59;
				} else {
					if(days_text > 0) {
						days_text--;
						hours_text = 59;
					} else {
						chekerTimer = true;
					}
				}
			}
		}
		
		
		if(!chekerTimer) {
			$days.text(days_text);
			$hours.text(hours_text);
			$minutes.text(minutes_text);
			$seconds.text(seconds_text);
			
			if(seconds_text || minutes_text) {
				$seconds.css({
					color: "#3CB31F",
					border: "3px solid #3CB31F"
				});
				
				$span_seconds.css({
					color: "#3CB31F"
				});
			}
			
			if(minutes_text || hours_text) {
				$minutes.css({
					color: "#3CB31F",
					border: "3px solid #3CB31F"
				});
				
				$span_minutes.css({
					color: "#3CB31F"
				});
			}
			
			if(hours_text || days_text) {
				$hours.css({
					color: "#3CB31F",
					border: "3px solid #3CB31F"
				});
				
				$span_hours.css({
					color: "#3CB31F"
				});
			}
			
			if(days_text) {
				$days.css({
					color: "#3CB31F",
					border: "3px solid #3CB31F"
				});
				
				$span_days.css({
					color: "#3CB31F"
				});
			}
			
			$priceOld.text(priceOld_text);
			$priceNew.text(priceNew_text);
			
			$priceOld.css({
				textDecoration: "line-through"
			});
			
			$priceNew.css({
				color: "#3CB31F"
			});
			
		} else {
			clearTimeout();
			
			$seconds.css({
					color: "#5A5A5A",
					border: "3px solid #5A5A5A"
			});
				
			$span_seconds.css({
				color: "#5A5A5A"
			});
			
			$minutes.css({
				color: "#5A5A5A",
				border: "3px solid #5A5A5A"
			});
			
			$span_minutes.css({
				color: "#5A5A5A"
			});
			
			$hours.css({
				color: "#5A5A5A",
				border: "3px solid #5A5A5A"
			});
			
			$span_hours.css({
				color: "#5A5A5A"
			});
			
			$days.css({
				color: "#5A5A5A",
				border: "3px solid #5A5A5A"
			});
			
			$span_days.css({
				color: "#5A5A5A"
			});
			
			$priceOld.css({
				color: "#3CB31F",
				textDecoration: "none"
			});
			
			$priceNew.css({
				color: "#5A5A5A",
				textDecoration: "line-through"
			});
			
			$("p.large-text.end-action").text("Срок действия акции истёк");
			
		}
		
	}, 1000);

	/* ==== КОНЕЦ: Таймер ==== */

}); // конец события ready