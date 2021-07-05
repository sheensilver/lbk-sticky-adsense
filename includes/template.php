<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if(!function_exists('lbk_sticky_adsense_frontend')) {
	function lbk_sticky_adsense_frontend() {

		if(get_option('display_sticky_adsense') !== 'yes') {
			return;
		}
		
		if(is_single() && get_option('hide_sticky_adsense_on_single') == 'yes') {
			return;
		}
		if(is_single('prduct') && get_option('hide_sticky_adsense_on_product_page') == 'yes') {
			return;
		}
		if(is_page() && get_option('hide_sticky_adsense_on_page') == 'yes') {	
			return;
		}
		?>
		<style>
		#sticky-adsense > div {
			position: fixed;
			overflow: hidden;
		}
		#sticky-adsense .adsbygoogle {
			width: <?php echo esc_attr(get_option('sticky_adsense_col_width')).'px' ?>
		}
		</style>
		<div id = "sticky-adsense">
					<div class = "sticky-adsense__left"><?php echo esc_attr(get_option('sticky_adsense_left_col')); ?></div>
					<div class = "sticky-adsense__right"><?php echo esc_attr(get_option('sticky_adsense_right_col')); ?></div>
				</div>

				<script>
					
					document.addEventListener('DOMContentLoaded', (event) => {
						var stickyAdsenseDiv =  document.querySelector('#sticky-adsense');
						var stickyAdsenseLeftDiv =  document.querySelector('.sticky-adsense__left');
						var stickyAdsenseRightDiv =  document.querySelector('.sticky-adsense__right');
						
						var contentWidth = <?php  echo esc_attr(get_option('main_content_width')); ?>;
						var stickyAdsenseDivWidth = <?php  echo esc_attr(get_option('sticky_adsense_col_width'));?>;
						var adsenseTopSpace = <?php echo esc_attr(get_option('sticky_adsense_top_space')); ?>;
						var adsenseSpace = <?php echo esc_attr(get_option('sticky_adsense_space')); ?>;
						var adsenseArea = window.innerWidth - contentWidth;
	
						if(adsenseArea >= (2*stickyAdsenseDivWidth + 2*adsenseSpace)) {
							stickyAdsenseLeftDiv.style.width  =  stickyAdsenseDivWidth + 'px';
							stickyAdsenseRightDiv.style.width  = stickyAdsenseDivWidth + 'px';
							stickyAdsenseLeftDiv.style.top = adsenseTopSpace + 'px';
							stickyAdsenseRightDiv.style.top  = adsenseTopSpace + 'px';
							
							stickyAdsenseLeftDiv.style.left  = adsenseArea/2 - stickyAdsenseDivWidth - adsenseSpace + 'px';
							stickyAdsenseRightDiv.style.right  = adsenseArea/2 - stickyAdsenseDivWidth - adsenseSpace + 'px';
						}	
					});
				</script>
		<?php
	}
	add_action('wp_footer', 'lbk_sticky_adsense_frontend');
}