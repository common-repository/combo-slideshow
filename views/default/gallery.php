<?php if (!empty($slides)) : ?>
<?php 	if($params['custom'] == false && $custom == false){
		$combo_id = get_the_ID();		
	} else {
		$combo_id = 'custom';
		if(is_numeric($params['custom']))
			$combo_id .= $params['custom'];
		elseif(is_numeric($custom))
			$combo_id .= $custom;
	}
	
	$general = $this -> get_option('general');
	$slideopts	= $this -> get_option('slides');
	$styles	= $this -> get_option('styles');
	$links = $this -> get_option('links');
	
	if ($links['imagesbox_temp'] == "T") 
		$imgbox = "thickbox";
	elseif ($links['imagesbox_temp'] == "S") 
		$imgbox = "shadowbox";
	elseif ($links['imagesbox_temp'] == "P") 
		$imgbox = "prettyphoto";
	elseif ($links['imagesbox_temp'] == "L") 
		$imgbox = "lightbox";
	elseif ($links['imagesbox_temp'] == "F")
		$imgbox = "fancybox";
	elseif ($links['imagesbox_temp'] == "M")
		$imgbox = "multibox";
	elseif ($links['imagesbox_temp'] == "custom")
		$imgbox = $links['custombox'];
	elseif ($links['imagesbox_temp'] == "N") 
		$imgbox = "nolink";
	else 
		$imgbox = "window";

	$jsframe = $general['jsframe'];
	$wpns_effect = $slideopts['wpns_effect'];
	$wpns_slices = $slideopts['wpns_slices'];
	$fadespeed = $slideopts['fadespeed'];
	$autospeed = $slideopts['autospeed'];
	$navigation = $slideopts['navigation'];

	$navhover = $slideopts['navhover'];
	$controlnav = $slideopts['controlnav'];
	$thumbnails_temp = $slideopts['thumbnails_temp'];

	$keyboardnav = $slideopts['keyboardnav'];
	$pausehover = $slideopts['pausehover'];
	$autoslide_temp = $slideopts['autoslide_temp'];
	$captionopacity = $slideopts['captionopacity'];

	$information_temp = $slideopts['information_temp'];
	$csstransform = $slideopts['csstransform'];
	$wprfss_effect = $slideopts['wprfss_effect'];
	$wprfss_cssfx = $slideopts['wprfss_cssfx'];
	$wprfss_tips = $slideopts['wprfss_tips'];
	$slide_theme = $general['slide_theme'];

	if(empty($size))
		$size = $params['size'];
	if(empty($size))
		$size = 'comboslide';
	$totalwidth = (count($slides) * (get_option( 'thumbnail_size_w' ) + 10) + 2);
	$additional_style = '<style type="text/css">';
	if(empty($width))
		$width 	= $params['width'];
	if(empty($height))
		$height = $params['height'];
	if(!empty($width) || !empty($height)){
		$additional_style .= '
			#ngslideshow-'.$combo_id.' {';
	if(!empty($width))
		$additional_style .= '
			width:'.$width.'px;';
	if(!empty($height))
		$additional_style .= '
			height:'.$height.'px;';
		$additional_style .= '
			margin: 0 auto;
			overflow: hidden;
		  }';
	}
	if(empty($width))
		$width 	= $styles['width'];
	if(empty($height))
		$height = $styles['height'];

	if ((!empty($styles['resizeimages']) && $styles['resizeimages'] == "Y") || (!empty($styles['resizeimages2']) && $styles['resizeimages2'] == "Y")){
	}
	if (!empty($styles['resizeimages']) && $styles['resizeimages'] == "Y")
		  $additional_style .= '
		  #ngslideshow-'.$combo_id.' img { width:'.$width.'px;} ';
	if (!empty($styles['resizeimages2']) && $styles['resizeimages2'] == "Y")
		  $additional_style .= '
		  #ngslideshow-'.$combo_id.' img { height:'.$height.'px;} ';
	if (empty($styles['resizeimages']) || $styles['resizeimages'] == "Y")
		  $additional_style .= '
		  #ngslideshow-'.$combo_id.' .nivo-controlNav { width:'.$width.'px;} ';
	if ($thumbnails_temp == "Y"){
		$additional_style .= '
			#ngslideshow-'.$combo_id.' .nivo-controlNav, .nivo-controlNav {
			position: relative;
			//margin: 0 auto;
			//bottom: '.(int)$styles['offsetnav'].'px;
			top:'.$height.'px;
			text-align:center;
			float:left;
			}
			#ngslideshow-'.$combo_id.'.controlnav-thumbs .nivo-controlNav .nivo-controlNavScroll{ width:'.$totalwidth.'px; position:relative; margin:0 auto;}
			#ngslideshow-'.$combo_id.' .nivo-controlNav img, .nivo-controlNav img  {
				display:inline; /* Unhide the thumbnails */
				position:relative;
				margin-right:6px;
				height: auto;
				width: auto;
			}
			#ngslideshow-'.$combo_id.' .nivo-controlNav a.active img {
				border: 2px solid #000;
			}
			#ngslideshow-'.$combo_id.' .nivo-controlNav a, .nivo-controlNav a {';
		if (empty($styles['controlnumbers']) || $styles['controlnumbers'] == "N")
				$additional_style .= '
				font-size: 0;
				line-height: 0;
				text-indent:-9999px;';
		$additional_style .= '
				display:inline;
				margin-right:0;
			  }';
	}
	if($additional_style != '<style type="text/css">')
		echo $additional_style.'</style>';
	echo '<!--[if lte IE 7]>
		<style type="text/css">
		.nivo-directionNav{ width:100%; }
		a.nivo-prevNav{ float:left; }
		a.nivo-nextNav{ float:right; }
		</style>
		<![endif]-->';

?>
	<?php if($slide_theme != '0') : ?>
		<?php $use_themes = $slide_theme; ?>
		<div class="slider-wrapper theme-<?php echo $use_themes; ?>">
			<div class="ribbon"></div>
	<?php else : ?>
		<div class="slider-wrapper">
	<?php endif; ?>
	<?php $append=''; ?>
	<?php if ($jsframe == 'jquery') : ?>
		<?php require CMBSLD_PLUGIN_DIR . 'views/default/jquery-script.php'; ?>
	<?php elseif ($jsframe == 'mootools') : ?>
		<?php require CMBSLD_PLUGIN_DIR . 'views/default/mootools-script.php'; ?>
	<?php endif; // END MOOTOOLS ?>
	<?php echo $append; ?>
		<div id="ngslideshow-<?php echo $combo_id; ?>" class="ngslideshow">
			<?php foreach ($slides as $slide) : ?>
				<?php
				//echo '<pre>'; print_r($slide); echo '</pre>';
				if(!is_object($slide))
					echo 'stocazzo'.$slide;
				$full_image_href = wp_get_attachment_image_src($slide -> ID, $size, false);
				$full_slide_href = wp_get_attachment_image_src($slide -> ID, 'full', false);
				$thumbnail_link = wp_get_attachment_image_src($slide -> ID, 'thumbnail', false);
				if ($thumbnails_temp == "Y") {
					$thumbrel = 'rel="'. $thumbnail_link[0] .'" ';
				} else
					$thumbrel = '';
				if ($information_temp == "Y") {
					$captitle = 'title="slide_caption-'. $slide -> ID .'"';
				} else
					$captitle = '';
				$resize = '';
				if ($jsframe == 'jquery'){
				    if( !empty($styles['resizeimages']) && $styles['resizeimages'] == "Y") {
					$resize .= ' width="'. $styles['wpns_width'] .'"';
				    }
				    if( !empty($styles['resizeimages2']) && $styles['resizeimages2'] == "Y") {
					$resize .= ' height="'. $styles['wpns_height'] .'"';
				    }
				}
				?>
				<?php if ($imgbox != "nolink") : ?>
					<?php if ($params['custom'] == false && $custom == false) : ?>
						<a href="<?php echo $full_slide_href[0]; ?>" class="<?php echo $imgbox; ?>">
					<?php else: ?>
						<a href="<?php echo get_post_meta($slide -> ID, '_comboslide_link', true); //echo get_attachment_link($slide -> ID); ?>">
					<?php endif; ?>
				<?php endif; ?>
						<img id="slide-<?php echo $slide -> ID; ?>" src="<?php echo $full_image_href[0]; ?>" alt="<?php echo sanitize_title($slide -> post_title); ?>" <?php echo $thumbrel.$captitle; ?> />
				<?php if ($imgbox != "nolink") : ?>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php if ($jsframe == 'mootools' && $information_temp == "Y") : ?>
				<div class="nivo-caption" style="opacity:<?php round(($captionopacity/100), 1) ?>;">
				</div>
			<?php endif; ?>
			<?php if ($jsframe == 'mootools' && $navigation == "Y") : ?>
				<div class='nivo-directionNav' style='display:none'>
					    <a class='nivo-prevNav'><?php _e('Prev', $this -> plugin_name); ?></a>
					    <a class='nivo-nextNav'><?php _e('Next', $this -> plugin_name); ?></a>
				</div>
			<?php endif; ?>
			<?php if ($jsframe == 'mootools' && ($controlnav == "Y" || $thumbnails_temp == "Y")) : ?>
					<div class="nivo-controlNav">
				<?php foreach ($slides as $index => $slide) : ?>
						<a class="nivo-control" href="#slide-<?php echo $slide -> ID; ?>" title="<?php echo sanitize_title($slide -> post_title) ?>">
						<?php if ($thumbnails_temp == "Y") : ?>
						      <?php $thumbnail_link = wp_get_attachment_image_src($slide -> ID, 'thumbnail', false); ?>
						      <img src="<?php echo $thumbnail_link[0]; ?>" alt="slideshow-thumbnail-<?php echo $index+1; ?>" />
						<?php else : ?>
						      <?php echo $index+1; ?>
						<?php endif; ?></a>
				<?php endforeach; ?>
					</div>
			<?php endif; ?>
				</div>
			<?php if ($information_temp == "Y") : ?>
			    <?php foreach ($slides as $slide) : ?>
				<div id="slide_caption-<?php echo ($slide -> ID); ?>" class="nivo-html-caption">
					<a href="<?php echo get_permalink($slide -> ID); ?>" title="<?php echo sanitize_title($slide -> post_title); ?>"><?php echo sanitize_title($slide -> post_title); ?></a>
				</div>
			    <?php endforeach; ?>
			<?php endif; ?>
			</div>
<?php endif; // END SLIDES?>