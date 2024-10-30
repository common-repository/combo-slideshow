<?php
	$slideshow_id = get_the_ID();
			$append .= "<script type='text/javascript'>
			      document.addEvent('domready', function(){
			      ";
		if ($controlnav=="Y" || $thumbnails=="Y" || $thumbnails_temp=="Y" ){
			$append .= "var navItems = $('ngslideshow-".$slideshow_id."').getElements('.nivo-controlNav a.nivo-control');
				    var navMenu = $('ngslideshow-".$slideshow_id."').getElement('div.nivo-controlNav');
				    navMenu.inject($('ngslideshow-".$slideshow_id."'),'after');
				    //navMenu.setStyle('bottom',0);
				    navItems[0].addClass('active');
				    ";
		}
			$append .= "$('ngslideshow-".$slideshow_id."').addClass('nivoSlider');
				    $('ngslideshow-".$slideshow_id."').setStyle('overflow','hidden');
				    $$('.slider-wrapper .nivoSlider img').setStyle('display','block');
				    $('ngslideshow-".$slideshow_id."').getParent().setStyle('position','relative');
				    ";
		if ($navigation=="Y"){
			    $append .= "var directionNav = $('ngslideshow-".$slideshow_id."').getElement('div.nivo-directionNav');
					directionNav.inject($('ngslideshow-".$slideshow_id."'),'after').setStyle('display','none').getElements().setStyles({display:'block', 'z-index':9});
				    ";
		    if ($navhover=="Y"){
			    $append .= "directionNav.setStyle('display','none');
					$('ngslideshow-".$slideshow_id."').getParent().addEvents({
					  mouseover: function(){
					      this.getElements('div.nivo-directionNav').setStyle('display','block');";
				if ($pausehover=="Y")
					      $append .= "comboSlideShow.pause();";
			    $append .= 	  "},
					  mouseout: function(){
					      this.getParent().getElements('div.nivo-directionNav').setStyle('display','none');";
				if ($pausehover=="Y")
					      $append .= "comboSlideShow.play();";
			    $append .= 	  "},
					});
				      ";
		    }else{
			    $append .= "directionNav.setStyle('display','block');
				      ";
			    if ($pausehover=="Y")
				$append .= "$('ngslideshow-".$slideshow_id."').getParent().addEvents({
						mouseover: function(){
						    comboSlideShow.pause();
						},
						mouseout: function(){
						    comboSlideShow.play();
						}
					    });
					   ";
		    }
		}
		if ($information == "Y"){
			$append .= "var capWrap = $('ngslideshow-".$slideshow_id."').getElement('div.nivo-caption');
				    capWrap.setStyles({ width: $('ngslideshow-".$slideshow_id."').getSize().x,
					    display: 'block',
					    // height: '1.6em',
					    // margin: $('ngslideshow-".$slideshow_id."').getStyle('margin'),
					    bottom: 0
				    });
				    capWrap.inject($('ngslideshow-".$slideshow_id."'),'after');
				    var slideCaptions = $$('div.nivo-html-caption').setStyles({display: 'block',
					    opacity: 0,
					    visibility: 'hidden',
					    position:'absolute',
					    'z-index': 9,
					    top:0,
					    left:0,
					    width: $('ngslideshow-".$slideshow_id."').getSize().x
					    // width: '". $styles['width'] ."px'
				    });
				    slideCaptions.inject(capWrap,'inside');
				    slideCaptions[0].fade('in');
				    ";
		} elseif ($information == "N"){
			$append .= "var slideCaptions = $$('div.nivo-html-caption').setStyle('display','none');
				   ";
		}
			$append .= "var slideItems = $('ngslideshow-".$slideshow_id."').getElements('a').setStyle('position','absolute');
				    var comboSlideShow = new SlideShow($('ngslideshow-".$slideshow_id."'),  {
					";
		if ($csstransform!="Y")
			$append .= "transition: '".$wprfss_effect."',";
		else
			$append .= "transition: '".$wprfss_cssfx."',";
			$append .= "delay: '".$autospeed."',
				    duration: '".$fadespeed."',";
		if ($autoslide=="Y")
			$append .= "autoplay: true,";
		else
			$append .= "autoplay: false,";
			$append .= "initialSlideIndex: 0,";
		if ($controlnav=="Y" || $information == "Y" || $information_temp == "Y"){
			$append .= "onShow: function(data){
				   ";
		  if ($information == "Y" || $information_temp == "Y"){
			$append .= "	slideCaptions[data.previous.index].removeClass('active');
					slideCaptions[data.next.index].addClass('active');
					slideCaptions[data.previous.index].fade('out');
					slideCaptions[data.next.index].fade('in');
					";
		  }
		  if ($controlnav == "Y"){
			$append .= "navItems[data.previous.index].removeClass('active');
					navItems[data.next.index].addClass('active');
					";
		  }
			$append .= "},
				   ";
		}
			$append .= "	selector: 'a'
				    });
				   $('ngslideshow-".$slideshow_id."').setStyle('background-image','none');
				   ";
		if ($csstransform=="Y")
			$append .= "comboSlideShow.useCSS();
				   ";
		if ($navigation=="Y")
			    $append .= "directionNav.getElement('.nivo-prevNav').addEvent('click', function(event){
									event.stop();
									comboSlideShow.show('previous');
								    });
					directionNav.getElement('.nivo-nextNav').addEvent('click', function(event){
									event.stop();
									comboSlideShow.show('next');
								    });
				    ";
		if ($controlnav == "Y"){
			$append .= "navItems.each(function(item, index){";
		    if ($styles['controlnumbers']=="Y"){
			$append .= "item.set('text',index+1);
				    item.set('rel',index+1);";
		    }
				// click a nav item ...
			$append .= "item.addEvent('click', function(event){
				    event.stop();
				    // var transition = (comboSlideShow.index < index) ? 'pushLeft' : 'pushRight';
				    // comboSlideShow.show(index, {transition: transition});
				    comboSlideShow.show(index);
				});
			});
			";
		    if ($wprfss_tips=="Y"){
			$append .= "new Tips(navItems, {
				      fixed: true,
				      text: '',
				      offset: {
					x: -100,
					y: 20
				      }
				    });";
		    }
		    
		}
		$append .= "});
			</script>";
?>