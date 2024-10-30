	<script type="text/javascript">
			jQuery(window).load(function() {
				// jQuery('.ngslideshow').nivoSlider({
				 jQuery('#ngslideshow-<?php echo $combo_id; ?>').nivoSlider({
					effect:'<?php echo $wpns_effect; ?>',
					slices:<?php echo $wpns_slices; ?>,
					animSpeed:<?php echo $fadespeed; ?>, // Slide transition speed
					pauseTime:<?php echo $autospeed; ?>, // Interval
					startSlide:0, //Set starting Slide (0 index)
				<?php if ($navigation=="Y") : ?>
					directionNav:true, //Next & Prev
				<?php else : ?>
					directionNav:false,
				<?php endif; ?>
				<?php if ($navhover=="Y") : ?>
					//ex directionNavHide:true, Only show on hover
					afterLoad: function(){
									// return the useful on-hover display of nav arrows
									jQuery(".nivo-directionNav", jQuery("#ngslideshow-<?php echo $combo_id; ?>")).hide();
									jQuery("#ngslideshow-<?php echo $combo_id; ?>").hover(function(){ jQuery(".nivo-directionNav", jQuery(this)).fadeIn(200); }, function(){ jQuery(".nivo-directionNav", jQuery(this)).fadeOut(200); });
									},
				<?php else : ?>
					//ex directionNavHide:false,
					afterLoad: function(){}, //Triggers when slider has loaded
				<?php endif; ?>
				<?php if ($controlnav=="Y" || $thumbnails_temp == "Y") : ?>
					controlNav:true, //1,2,3...
				<?php else : ?>
					controlNav:false,
				<?php endif; ?>
				<?php if ($thumbnails_temp == "Y") : ?>
					controlNavThumbs:true,
					controlNavThumbsFromRel:true, //Use image rel for thumbs
					controlNavThumbsScroll:true,
				<?php else : ?>
					controlNavThumbs:false, //Use thumbnails for Control Nav
					controlNavThumbsFromRel:false, //Use image rel for thumbs
				<?php endif; ?>
					controlNavThumbsSearch: '.jpg', //Replace this with...
					controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
				<?php if ($keyboardnav=="Y") : ?>
					keyboardNav:true, //Use left & right arrows
				<?php else : ?>
					keyboardNav:false,
				<?php endif; ?>
				<?php if ($pausehover=="Y") : ?>
					pauseOnHover:true, //Stop animation while hovering
				<?php else : ?>
					pauseOnHover:false,
				<?php endif; ?>	
				<?php if ($autoslide_temp=="Y") : ?>
					manualAdvance:false, //Force manual transitions
				<?php else : ?>
					manualAdvance:true,
				<?php endif; ?>	
					captionOpacity:<?php echo round(($captionopacity/100), 1); ?>, // Universal caption opacity
					beforeChange: function(){},
					afterChange: function(){},
					slideshowEnd: function(){}, //Triggers after all slides have been shown
					lastSlide: function(){}, //Triggers when last slide is shown
				});
				<?php if (isset($params['frompost']) && $params['frompost'] == true && $attachments) : ?>
					jQuery('#ngslideshow-<?php echo $combo_id; ?>').width(<?php echo $width; ?>);
				<?php endif; ?>

				<?php if ($thumbnails_temp == "Y") : ?>
					jQuery('#ngslideshow-<?php echo $combo_id; ?>').addClass('controlnav-thumbs');
					jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNav').css('overflow-x','hidden');
					var thumbcw<?php echo $combo_id; ?> = jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').width();
					//var thumbtw<?php echo $combo_id; ?> = jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.nivo-control img').width();
					//var margin<?php echo $combo_id; ?> = parseInt(jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.nivo-control img').css('margin-right').replace('px',''));
				    if(thumbcw<?php echo $combo_id; ?>><?php echo $width; ?>) {
					jQuery.fn.loopMove = function(direction, props, dur, eas){
					    if( this.data('loop') == true ){
						//if((parseInt(jQuery(this).css('left').replace('px',''))>-thumbcw<?php echo $combo_id; ?>+thumbtw<?php echo $combo_id; ?>+margin<?php echo $combo_id; ?> && direction == true) || (direction == false && parseInt(jQuery(this).css('left').replace('px',''))<=0))
						if((parseInt(jQuery(this).css('left').replace('px',''))>-thumbcw<?php echo $combo_id; ?>+<?php echo $width; ?> && direction == true) || (direction == false && parseInt(jQuery(this).css('left').replace('px',''))<=0))
							jQuery(this).animate( props, dur, eas, function(){
						           if( jQuery(this).data('loop') == true ) jQuery(this).loopMove(direction, props, dur, eas);
							});
					    }
					    return this; // Don't break the chain
					}
					jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-directionNav a.nivo-nextNav').hover(function() {
						if(parseInt(jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').css('left').replace('px',''))>-thumbcw<?php echo $combo_id; ?>+<?php echo $width; ?> )
								jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').data('loop', true).stop().loopMove(true, {left: '-=5px'}, 10);
					     }, function() {
						jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').data('loop', false).stop();
					});
					jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-directionNav a.nivo-prevNav').hover(function() {
						if(parseInt(jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').css('left').replace('px',''))<=0)
								jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').data('loop', true).stop().loopMove(false, { left: '+=5px'}, 10);
					     }, function() {
						jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').data('loop', false).stop();
					});
					
					jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-directionNav a').click(function() {
						jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').stop();
						var thumbOffset<?php echo $combo_id; ?> = thumbcw<?php echo $combo_id; ?>-<?php echo $width; ?>;
						var currentPos<?php echo $combo_id; ?> = parseInt(jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').css('left').replace('px',''));
						//var thumbSingle = (jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.nivo-control img').width() + parseInt(jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.nivo-control img').css('margin-right').replace('px','')));
						//if(jQuery(this).hasClass('.nivo-nextNav')) active<?php echo $combo_id; ?> += thumbSingle;
						//else if(jQuery(this).hasClass('.nivo-prevNav')) active<?php echo $combo_id; ?> -= thumbSingle;
						var next = jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.active').next();
						var prev = jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.active').prev();
						if(jQuery(this).hasClass('nivo-nextNav')){
							if(jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.active').next().length != 0)
								var active<?php echo $combo_id; ?> = jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.active').next().position().left;
							else
								var active<?php echo $combo_id; ?> = jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a').first().position().left;

						}else if(jQuery(this).hasClass('nivo-prevNav')){
							if(jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.active').prev().length != 0)
								var active<?php echo $combo_id; ?> = jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a.active').prev().position().left;
							else
								var active<?php echo $combo_id; ?> = jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll a').last().position().left;

						}
						if(active<?php echo $combo_id; ?> < thumbOffset<?php echo $combo_id; ?>){
							jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').animate({
								left: - active<?php echo $combo_id; ?>
							}, 2*(Math.abs(currentPos<?php echo $combo_id; ?>-active<?php echo $combo_id; ?>)));
						}else {
							jQuery('#ngslideshow-<?php echo $combo_id; ?> .nivo-controlNavScroll').animate({
								left: - thumbOffset<?php echo $combo_id; ?>
							}, 2*(Math.abs(currentPos<?php echo $combo_id; ?>-thumbOffset<?php echo $combo_id; ?>)));
						}
					});
				      }
				<?php endif; ?>
				<?php if ($combo_id == "custom") : ?>
					jQuery('#ngslideshow-<?php echo $combo_id; ?> a.nivo-imageLink').each(function(){
						if (this.href.indexOf(location.hostname) == -1){
							jQuery(this).addClass('external').attr({ 'rel':'external' }).click(function(e){
								e.preventDefault();
								window.open(this.href);
							});
						}
					});
				<?php endif; ?>
			});
		</script>