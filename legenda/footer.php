<script type="text/javascript">
   (function($) {

	// the class name or ID of your element you wish to scale up
	var zoomSelector = '.zoom-this',

	// CSS transformOrigin: http://www.w3schools.com/cssref/css3_pr_transform-origin.asp
	scaleFrom = 'left top',

	// if slider is scaled below "firstScaleCheck" value, 
	// and above "secondScaleCheck" value, 
	// zoom element by "firstScaleAmount" value
	firstScaleCheck = 0.5, 
	firstScaleAmount = 0.35,

	// if slider is scaled below "secondScaleCheck" number, 
	// zoom element by "secondScaleAmount" value
	secondScaleCheck = 0.25,
	secondScaleAmount = 0.75,

	transform, 
	slider,
	width, 
	items,
	plus;

	$(document).ready(function() {

		// Change "revapi9" in the two places below to your slider's unique "API" variable:
		// http://www.themepunch.com/home/plugins/wordpress-plugins/revolution-slider-wordpress/api-tutorial/
		if(typeof revapi1 === 'undefined') return;
		var api = revapi1;

		slider = $('.rev_slider_wrapper');
		if(!slider.length) return;
		var temp = slider[0].style,

		origin = 'transformOrigin' in temp ? 'transformOrigin' : 
					 'WebkitTransformOrigin' in temp ? 'WebkitTransformOrigin' : 
					 'MozTransformOrigin' in temp ? 'MozTransformOrigin' : 
					 'msTransformOrigin' in temp ? 'msTransformOrigin' : 
					 'OTransformOrigin' in temp ? 'OTransformOrigin' : null;

		transform = 'transform' in temp ? 'transform' : 
					'WebkitTransform' in temp ? 'WebkitTransform' : 
					'MozTransform' in temp ? 'MozTransform' : 
					'msTransform' in temp ? 'msTransform' : 
					'OTransform' in temp ? 'OTransform' : null;

		if(!transform) return;
		var script = slider.next('script').text();

		width = parseInt(script.split('startwidth:')[1].split(',')[0], 10);
		items = slider.find(zoomSelector).each(function() {this.style[origin] = scaleFrom;});

		api.on('revolution.slide.onloaded', function() {

			sizer();
			$(window).on('resize', sizer);

		});

	});

	function sizer() {

		var scaled = Math.min(slider.width() / width, 1).toFixed(2);
		plus = scaled < 1 ? (1 - parseFloat(scaled)) + 1 : 1;

		if(scaled < firstScaleCheck) {
			plus = scaled > secondScaleCheck ? plus + firstScaleAmount : plus + secondScaleAmount;
		}

		items.each(sizeEach);

	}

	function sizeEach() {

		this.style.display = 'inline-block';
		this.style[transform] = 'scale(' + plus + ', ' + plus + ')';

	}

})(jQuery);

</script>
	
<?php $fd = etheme_get_option('footer_demo'); ?>	
	<?php $ft = ''; $ft = apply_filters('custom_footer_filter',$ft); ?>
    <?php global $etheme_responsive; ?>

	<?php if(is_active_sidebar('prefooter')): ?>
		<div class="prefooter prefooter-<?php echo $ft; ?>">
			<div class="container">
				<div class="double-border">
	                <?php if ( !is_active_sidebar( 'prefooter' ) ) : ?>
	               		<?php //if($fd) etheme_footer_demo('prefooter'); ?>
	                <?php else: ?>
	                    <?php dynamic_sidebar( 'prefooter' ); ?>
	                <?php endif; ?>   
				</div>
			</div>
		</div>
	<?php endif; ?>


	<?php if(is_active_sidebar('footer1') ): ?>
		<div class="footer-top footer-top-<?php echo $ft; ?>">
			<div class="container">
				<div class="double-border">
	                <?php if ( !is_active_sidebar( 'footer1' ) ) : ?>
	               		<?php if($fd) etheme_footer_demo('footer1'); ?>
	                <?php else: ?>
	                    <?php dynamic_sidebar( 'footer1' ); ?>
	                <?php endif; ?>   
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(is_active_sidebar('footer2') || $fd): ?>
		<footer class="footer footer-bottom-<?php echo $ft; ?>">
			<div class="container">
                <?php if ( !is_active_sidebar( 'footer2' ) ) : ?>
               		<?php if($fd) etheme_footer_demo('footer2'); ?>
                <?php else: ?>
                    <?php dynamic_sidebar( 'footer2' ); ?>
                <?php endif; ?> 
			</div>
		</footer>
	<?php endif; ?>

	<div class="copyright copyright-<?php echo $ft; ?>">
		<div class="container">
			<div class="row-fluid">
				<div class="span6">
					<?php if(is_active_sidebar('footer9')): ?> 
						<?php dynamic_sidebar('footer9'); ?>	
					<?php else: ?>
						<?php if($fd) etheme_footer_demo('footer9'); ?>
					<?php endif; ?>
				</div>

				<div class="span6 a-right">
					<?php if(is_active_sidebar('footer10')): ?> 
						<?php dynamic_sidebar('footer10'); ?>	
					<?php else: ?>
						<?php if($fd) etheme_footer_demo('footer10'); ?>
					<?php endif; ?>
				</div>
			</div>
            <div class="row-fluid">
                <?php if(etheme_get_option('responsive')): ?>
                	<div class="span12 responsive-switcher a-center visible-phone visible-tablet <?php if(!$etheme_responsive) echo 'visible-desktop'; ?>">
                    	<?php if($etheme_responsive): ?>
                    		<a href="<?php echo home_url(); ?>/?responsive=off"><i class="icon-mobile-phone"></i></a> <?php _e('Mobile version',  ETHEME_DOMAIN) ?>: 
                    		<a href="<?php echo home_url(); ?>/?responsive=off"><?php _e('Enabled',  ETHEME_DOMAIN) ?></a>
                    	<?php else: ?>
                    		<a href="<?php echo home_url(); ?>/?responsive=on"><i class="icon-mobile-phone"></i></a> <?php _e('Mobile version',  ETHEME_DOMAIN) ?>: 
                    		<a href="<?php echo home_url(); ?>/?responsive=on"><?php _e('Disabled',  ETHEME_DOMAIN) ?></a>
                    	<?php endif; ?>
                	</div>
                <?php endif; ?>  
            </div>
		</div>
	</div>
	</div> <!-- page wrapper -->
	<?php if (etheme_get_option('to_top')): ?>
		<div class="back-to-top hidden-phone hidden-tablet">
			<span><?php _e('Back to top', ETHEME_DOMAIN) ?></span>
		</div>
	<?php endif ?>

	<?php do_action('after_page_wrapper'); ?>

	<?php
		/* Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */

		wp_footer();
	?>
</body>


</html>