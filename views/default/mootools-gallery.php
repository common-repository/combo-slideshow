	<script type="text/javascript">
		    document.addEvent('domready', function(){
			<?php if ($controlnav=="Y" || $thumbnails_temp=="Y" ) : ?>
				var navItems = $('ngslideshow-<?php echo $combo_id; ?>').getElements('.nivo-controlNav a.nivo-control');
	//alert(navItems[0].get('title'));
				var navMenu = $('ngslideshow-<?php echo $combo_id; ?>').getElement('div.nivo-controlNav');
				navMenu.inject($('ngslideshow-<?php echo $combo_id; ?>'),'after');
				//navMenu.addClass('ngslideshow');
				//navMenu.setStyle('margin-top','-'+$('ngslideshow-<?php echo $combo_id; ?>').getSize().y+'px');
				//navMenu.setStyle('top','10px');
				navMenu.setStyle('bottom',0);
				navItems[0].addClass('active');
			<?php endif; ?>
			$('ngslideshow-<?php echo $combo_id; ?>').addClass('nivoSlider');
			$('ngslideshow-<?php echo $combo_id; ?>').setStyle('overflow','hidden');
			$$('.slider-wrapper .nivoSlider img').setStyle('display','block');
			$('ngslideshow-<?php echo $combo_id; ?>').getParent().setStyle('position','relative');
			<?php if ($navigation=="Y") : ?>
				var directionNav = $('ngslideshow-<?php echo $combo_id; ?>').getElement('div.nivo-directionNav');
				directionNav.inject($('ngslideshow-<?php echo $combo_id; ?>'),'after').setStyle('display','none').getElements().setStyles({display:'block', 'z-index':9});
				<?php if ($navhover=="Y") : ?>
					directionNav.setStyle('display','none');
					$('ngslideshow-<?php echo $combo_id; ?>').getParent().addEvents({
						mouseover: function(){
						this.getElements('div.nivo-directionNav').setStyle('display','block');
					<?php if ($pausehover=="Y") : ?>
						comboSlideShow.pause();
					<?php endif; ?>
						},
						mouseout: function(){
						this.getParent().getElements('div.nivo-directionNav').setStyle('display','none');
					<?php if ($pausehover=="Y") : ?>
						comboSlideShow.play();
					<?php endif; ?>
						}
					});
				<?php else: ?>
					directionNav.setStyle('display','block');
					<?php if ($pausehover=="Y") : ?>
						comboSlideShow.play();
						$('ngslideshow-<?php echo $combo_id; ?>').getParent().addEvents({
							mouseover: function(){
							comboSlideShow.pause();
							},
							mouseout: function(){
							comboSlideShow.play();
							}
						});
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($information_temp == "Y") : ?>
			//var capWrap = new Element('div', {class: 'nivo-caption'});
			var capWrap = $('ngslideshow-<?php echo $combo_id; ?>').getElement('div.nivo-caption');
			capWrap.setStyles({ width: $('ngslideshow-<?php echo $combo_id; ?>').getSize().x,
					    display: 'block',
					    // height: '1.6em',
					    //margin: $('ngslideshow-<?php echo $combo_id; ?>').getStyle('margin'),
					    bottom: 0
				});
			capWrap.inject($('ngslideshow-<?php echo $combo_id; ?>'),'after');
			var slideCaptions = $$('div.nivo-html-caption').setStyles({display: 'block',
									opacity: 0,
									visibility: 'hidden',
									position:'absolute',
									'z-index': 9,
									top:0,
									left:0,
									width: $('ngslideshow-<?php echo $combo_id; ?>').getSize().x
									// width: '<?php echo $width;?>px'
									});
			slideCaptions.inject(capWrap,'inside');
			slideCaptions[0].fade('in');
			//capWrap.wraps(slideCaptions);
			<?php elseif ($information_temp == "N") : ?>
			var slideCaptions = $$('div.nivo-html-caption').setStyle('display','none');
			<?php endif; ?>
/*
		var capFade = new Fx.Tween(el, {
			link: 'chain',
			duration: <?php echo $fadespeed; ?> // Interval
		});
*/
			var slideItems = $('ngslideshow-<?php echo $combo_id; ?>').getElements('a').setStyle('position','absolute');
			var comboSlideShow = new SlideShow($('ngslideshow-<?php echo $combo_id; ?>'),  {
			<?php if ($csstransform!="Y") : ?>
				transition:  '<?php echo $wprfss_effect; ?>',
			<?php else : ?>
				transition:  '<?php echo $wprfss_cssfx; ?>',
			<?php endif; ?>
				delay: <?php echo $autospeed; ?>, // Slide transition speed
				duration: <?php echo $fadespeed; ?>, // Interval
			<?php if ($autoslide_temp=="Y") : ?>
				autoplay: true, //Force manual transitions
			<?php else : ?>
				autoplay: false,
			<?php endif; ?>
				initialSlideIndex:0,
				/*
				onShow: function(){},
				onShowComplete: function(){},
				onPlay: function(){},
				onPause: function(){},
				onReverse: function(){},
				*/
			<?php if ($controlnav=="Y" || $information_temp == "Y") : ?>
				onShow: function(data){
			    <?php if ($information_temp == "Y") : ?>
//alert(slideCaptions.length);
//alert(data.next.index);
					slideCaptions[data.previous.index].removeClass('active');
					slideCaptions[data.next.index].addClass('active');
					slideCaptions[data.previous.index].fade('out');
					slideCaptions[data.next.index].fade('in');
					// hide captions except active
			    <?php endif; ?>
//alert(data.next.index);
//alert(navItems[data.previous.index].get('title'));
					// update navigation elements' class depending upon the current slide
// cycle problem => if next defined, naviItems.length - data.previous.index
// only for auto slideshow?
			    <?php if ($controlnav=="Y") : ?>
					navItems[data.previous.index].removeClass('active');
					//initial slide index

					//if (navItems[data.next.index] === undefined)
					//  navItems[(navItems.length - data.previous.index)].addClass('active');
					//else
					navItems[data.next.index].addClass('active');
			    <?php endif; ?>
				},
			<?php endif; ?>
				selector: 'a'
			});
			$('ngslideshow-<?php echo $combo_id; ?>').setStyle('background-image','none');
			<?php if ($csstransform=="Y") : ?>
			      //if (Modernizr.csstransitions && Modernizr.csstransforms){
				      comboSlideShow.useCSS();
			      //}
			<?php endif; ?>
			<?php if ($navigation=="Y") : ?>
				directionNav.getElement('.nivo-prevNav').addEvent('click', function(event){
					event.stop();
					comboSlideShow.show('previous');
				});
				directionNav.getElement('.nivo-nextNav').addEvent('click', function(event){
					event.stop();
					comboSlideShow.show('next');
				});
			<?php endif; ?>

		<?php if ($controlnav=="Y") : ?>

			navItems.each(function(item, index){
			<?php if ($styles['controlnumbers']=="Y") : ?>
				item.set('text',index+1);
				item.set('rel',index+1);
			<?php endif; ?>
				// click a nav item ...
				item.addEvent('click', function(event){
				    event.stop();
				    // pushLeft or pushRight, depending upon where
				    // the slideshow already is, and where it's going
				    var transition = (comboSlideShow.index < index) ? 'pushLeft' : 'pushRight';
				    // call show method, index of the navigation element matches the slide index
				    // on-the-fly transition option
				    comboSlideShow.show(index, {transition: transition});
				});
			});
		    <?php if ($wprfss_tips=="Y") : ?>
			new Tips(navItems, {
				fixed: true,
				text: '',
				offset: {
					x: -100,
					y: 20
				}
			});
		    <?php endif; ?>
		<?php endif; ?>
		    });
		</script>