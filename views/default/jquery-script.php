<?php
	$append .= "<script type='text/javascript'>
			      jQuery(window).load(function() {
				jQuery('.ngslideshow').nivoSlider({
					effect:'". $wpns_effect ."',
					slices:". $wpns_slices .",
					animSpeed:". $fadespeed .", // Slide transition speed
					pauseTime:". $autospeed .", // Interval
					startSlide:0, //Set starting Slide (0 index)";
		if ($navigation=="Y")
			$append .= "directionNav:true, //Next & Prev
			";
		else
			$append .= "directionNav:false,
			";
/*
		if ($navhover=="Y")
			$append .= "directionNavHide:true, //Only show on hover
				   ";
		else
			$append .= "directionNavHide:false,
				   ";
*/
		if ($navhover=="Y")
			$append .= "afterLoad: function(){
									// return the useful on-hover display of nav arrows
									jQuery('.nivo-directionNav', jQuery('#ngslideshow-".$combo_id."')).hide();
									jQuery('#ngslideshow-".$combo_id."').hover(function(){ jQuery('.nivo-directionNav', jQuery(this)).show(); }, function(){ jQuery('.nivo-directionNav', jQuery(this)).hide(); });
									},";
		else
			$append .= 	"
			afterLoad: function(){}, //Triggers when slider has loaded
			";
			
		if ($controlnav=="Y" || $thumbnails == "Y")
			$append .= "controlNav:true, //1,2,3...
			";
		else
			$append .= "controlNav:false,
			";
		if ($thumbnails == "Y")
			$append .= "controlNavThumbs:true,
			controlNavThumbsFromRel:true, //Use image rel for thumbs
			";
		else
			$append .= "controlNavThumbs:false, //Use thumbnails for Control Nav
			controlNavThumbsFromRel:false, //Use image rel for thumbs
			";

			$append .= "controlNavThumbsSearch: '.jpg', //Replace this with...
			controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
			";
		if ($keyboardnav=="Y")
			$append .= "keyboardNav:true, //Use left & right arrows
			";
		else
			$append .= "keyboardNav:false,
			";

		if ($pausehover=="Y")
			$append .= "pauseOnHover:true, //Stop animation while hovering
			";
		else
			$append .= "pauseOnHover:false,
			";

		if ($autoslide=="Y")
			$append .= "manualAdvance:false, //Force manual transitions
			";
		else
			$append .= "manualAdvance:true,
			";

			$append .= "captionOpacity:".round(($captionopacity/100), 1).", // Universal caption opacity
					beforeChange: function(){},
					afterChange: function(){},
					slideshowEnd: function(){}, //Triggers after all slides have been shown
					lastSlide: function(){}, //Triggers when last slide is shown
				});
			});
			";
		if (isset($params['frompost']) && $params['frompost'] == true && $attachments)
			$append .= "jQuery('#ngslideshow-".$combo_id."').width(".$width.");";
		if ($thumbnails=="Y"||$thumbnails_temp == "Y")
			$append .= "jQuery('#ngslideshow-".$combo_id."').addClass('controlnav-thumbs');
					jQuery('#ngslideshow-".$combo_id." .nivo-controlNav').css('overflow-x','hidden');
					var thumbcw".$combo_id." = jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').width();
				    if(thumbcw".$combo_id.">".$width.") {
					jQuery.fn.loopMove = function(direction, props, dur, eas){
					    if( this.data('loop') == true ){
						if((parseInt(jQuery(this).css('left').replace('px',''))>-thumbcw".$combo_id."+".$width." && direction == true) || (direction == false && parseInt(jQuery(this).css('left').replace('px',''))<=0))
							jQuery(this).animate( props, dur, eas, function(){
						           if( jQuery(this).data('loop') == true ) jQuery(this).loopMove(direction, props, dur, eas);
							});
					    }
					    return this; // Don't break the chain
					}
					jQuery('#ngslideshow-".$combo_id." .nivo-directionNav a.nivo-nextNav').hover(function() {
						if(parseInt(jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').css('left').replace('px',''))>-thumbcw".$combo_id."+".$width." )
								jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').data('loop', true).stop().loopMove(true, {left: '-=5px'}, 10);
					     }, function() {
						jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').data('loop', false).stop();
					});
					jQuery('#ngslideshow-".$combo_id." .nivo-directionNav a.nivo-prevNav').hover(function() {
						if(parseInt(jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').css('left').replace('px',''))<=0)
								jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').data('loop', true).stop().loopMove(false, { left: '+=5px'}, 10);
					     }, function() {
						jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').data('loop', false).stop();
					});
					
					jQuery('#ngslideshow-".$combo_id." .nivo-directionNav a').click(function() {
						jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').stop();
						var thumbOffset".$combo_id." = thumbcw".$combo_id."-".$width.";
						var currentPos".$combo_id." = parseInt(jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').css('left').replace('px',''));
						var next = jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll a.active').next();
						var prev = jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll a.active').prev();
						if(jQuery(this).hasClass('nivo-nextNav')){
							if(jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll a.active').next().length != 0)
								var active".$combo_id." = jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll a.active').next().position().left;
							else
								var active".$combo_id." = jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll a').first().position().left;

						}else if(jQuery(this).hasClass('nivo-prevNav')){
							if(jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll a.active').prev().length != 0)
								var active".$combo_id." = jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll a.active').prev().position().left;
							else
								var active".$combo_id." = jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll a').last().position().left;

						}
						if(active".$combo_id." < thumbOffset".$combo_id."){
							jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').animate({
								left: - active".$combo_id."
							}, 2*(Math.abs(currentPos".$combo_id."-active".$combo_id.")));
						}else {
							jQuery('#ngslideshow-".$combo_id." .nivo-controlNavScroll').animate({
								left: - thumbOffset".$combo_id."
							}, 2*(Math.abs(currentPos".$combo_id."-thumbOffset".$combo_id.")));
						}
					});
				      }
				   ";
			if ($combo_id == "custom")
				$append .= "jQuery('#ngslideshow-".$combo_id." a.nivo-imageLink').each(function(){
						if (this.href.indexOf(location.hostname) == -1){
							jQuery(this).addClass('external').attr({ 'rel':'external' }).click(function(e){
								e.preventDefault();
								window.open(this.href);
							});
						}
					});";
			$append .= "</script>
				   ";
?>