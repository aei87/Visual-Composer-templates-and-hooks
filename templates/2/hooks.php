<?php


function wedding_scripts() {
	wp_enqueue_style( 'wedding-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wedding-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wedding-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (is_front_page()){
		wp_enqueue_style("materialize", get_template_directory_uri().'/css/materialize.css');
		wp_enqueue_script("materialize", get_template_directory_uri().'/js/materialize.min.js',array(),false,true);
	}

}
add_action( 'wp_enqueue_scripts', 'wedding_scripts' );





if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'homepage-thumb', 510, 414, true ); 
	add_image_size( 'cart-thumb', 100, 100, true ); 
}




function shortcode_homepage_gallery_function( $atts ){
	
	?>



	<div class="vc_row wpb_row vc_row-fluid max_1170">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
		
				<?php

					if (isset($atts['upsells'])) {
						
						$current_product = new WC_Product($atts['upsells']);
						$products = $current_product->get_upsells();

						foreach ($products as $key => $post) {
 
							$products[$key] = get_post($post);
						}

					}
					else {

						$args = array( 'post_type' => 'product', 'posts_per_page' => -1);
						$products = get_posts( $args );	
					}

					$ch = 0;
					$ch2 = 0;
					
					
					foreach ($products as $key => $post) {
						
						if (isset($atts['items'])) {
							if ($ch2 == $atts['items']) { break;}
							$ch2++;
						}

						$pro = new WC_Product($post->ID);
						$images =  $pro->get_gallery_attachment_ids();

						$ch++;
						if ($ch == 1) {
			
							?> <div class="vc_row wpb_row vc_inner vc_row-fluid"> <?php
						}

						?>

						<div class="wpb_column vc_column_container vc_col-sm-4">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="wpb_text_column wpb_content_element ">
										<div class="wpb_wrapper">
											
												<div id="id_<?php echo $key; ?>" class="single_image container">
										
													<div class="inner">

														<div class="middle"></div>

														<div class="image_thumb"><?php echo $pro->get_image($size = 'homepage-thumb'); ?></div>
														   
														<a href="<?php echo $pro->get_slug(); ?>"><div class="text">View</div></a>

													
													 	 <!-- Slideshow HTML -->
													  	<!--
													  	<div id="slideshow">
														  	<span class="control" id="leftControl"></span>
													        <div class="slidesContainer">
													      
													      	<?php
													      	/*
														      	foreach( $images as $image_id ) 
																{
																 
																  $url = wp_get_attachment_image_src( $image_id, 'homepage-thumb' );
												
																  ?>
																   <div class="slide">
															        <img src="<?php echo $url[0] ?>" class="image">
															      </div>
																  <?php

																}
															*/
													      	?>
													      	<!--
													    	</div>
													  		<span class="control" id="rightControl"></span>
													  	</div>
													 	-->

														</div>

														<a href="<?php echo $pro->get_slug(); ?>">
															<div class="rooftop_price">
																<div class="rooftop_price_left">
																	<?php 
																		echo $pro->get_name();
																	?>
																</div>
																<div class="rooftop_price_right">
																	<?php 
																		echo '$'.$pro->get_price();  
																	?>
																</div>
															</div>
														</a>

													</div>


										</div>
									</div>
								</div>
							</div>
						</div>

						<?php


						if ($ch == 3) {
							?> </div> <?php
							$ch = 0;
						}


					}

					if (($ch < 3) && ($ch > 0)) {
						?> </div> <?php
					}

				?>


				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
/*
		jQuery(document).ready(function(){
		    


			jQuery('.single_image').each(function (index, value) { 

				jQuery(this).find('.text').click(function() {
				
					jQuery('.single_image').each(function (index, value) { 
						jQuery(this).find('.text').css('display','block');
						jQuery(this).find('.middle').css('display','block');
						jQuery(this).find('.image_thumb').css('display','block');	
						jQuery(this).find('#slideshow').css('display','none');	
						jQuery(this).find('#slideshow').find('#leftControl').unbind('click');
						jQuery(this).find('#slideshow').find('#rightControl').unbind('click');
					});


					var currentPosition = 0;
					var slideWidth = 357;	

					id = '#'+jQuery(this).parent().parent().attr('id');


					jQuery(this).parent().find('.text').css('display','none');
					jQuery(this).parent().find('.middle').css('display','none');
					jQuery(this).parent().find('.image_thumb').css('display','none');
					jQuery(this).parent().find('#slideshow').css('display','block');

					
					var slides = jQuery(id+' .slide');
					var numberOfSlides = slides.length; 

					// manageControls: Hides and Shows controls depending on currentPosition
					function manageControls(id, position){ //alert(position);
						// Hide left arrow if position is first slide
						if(position==0){ jQuery(id+' #leftControl').hide() } else{ jQuery(id+' #leftControl').show() }
						// Hide right arrow if position is last slide
						if(position==numberOfSlides-1){ jQuery(id+' #rightControl').hide() } else{ jQuery(id+' #rightControl').show() }
					}		


					// Remove scrollbar in JS
					jQuery(id+' .slidesContainer').css('overflow', 'hidden');

					// Wrap all .slides with #slideInner div
					if (jQuery(id+" .slideInner").length) { 
						slides.unwrap('<div class="slideInner">');
					}
					slides
				    .wrapAll('<div class="slideInner"></div>')
				    // Float left to display horizontally, readjust .slides width
					.css({
				      'float' : 'left',
				      'width' : slideWidth
				    });

					// Set #slideInner width equal to total width of all slides
					jQuery(id+' .slideInner').css('width', slideWidth * numberOfSlides);

					// Hide left arrow control on first load
					manageControls(id, currentPosition);

					// Create event listeners for .controls clicks

					
				    jQuery(id+' .control').bind('click', function(){ 

					    // Determine new position
						currentPosition = (jQuery(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;
					
						// Hide / show controls
					    manageControls(id, currentPosition);
					    // Move slideInner using margin-left
					    jQuery(id+' .slideInner').animate({
					      'marginLeft' : slideWidth*(-currentPosition)
					    });

				    });

				});

			});


		});

*/



		


	</script>

	

<?php

}

add_shortcode('shortcode_homepage_gallery', 'shortcode_homepage_gallery_function');







function shortcode_homepage_carousel_function( $atts ){

?>

<?php

	if ($_GET['vc_editable'] == true) {
		return;
	}

?>
   

    <script type="text/javascript">
	   
	    jQuery(document).ready(function(){
	      jQuery('.carousel').carousel({
	          
	            

	      });

	    });

    </script>

    <style type="text/css">

     
    </style>

	<div class="carousel">
		
		<?php

		$args = array(
			'post_type' => 'reviews'
		);
		$query_reviews = new WP_Query;
		$reviews = $query_reviews->query($args);

		foreach( $reviews as $review ){
			
			?>
			<a class="carousel-item" href="#one!">
				<div class="carousel-inner">
					<div class="inner_header"></div> 		
					<div class="inner_content"> <?php echo $review->post_content; ?> </div>
					<div class="inner_person"><?php echo $review->post_title; ?> </div>
					<div class="inner_position"><?php the_field("reviews_position", $review->ID); ?></div>
					<div class="inner_footer"><?php  echo get_the_post_thumbnail($review->ID, 'thumbnail'); ?></div>   
				</div>
			</a>
			<?php
		}


		?>

	</div>


<?php

}
    
add_shortcode('shortcode_homepage_carousel', 'shortcode_homepage_carousel_function');


 



add_filter("woocommerce_checkout_fields", "order_fields");

function order_fields($fields) {

    $order = array(
        "billing_first_name", 
        "billing_last_name",
        "billing_phone",
        "billing_company",
        "billing_email",  
        "billing_country", 
        "billing_city", 
        "billing_address_1", 
        "billing_state", 
        "billing_postcode" 
    );

    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }


    $fields["billing"] = $ordered_fields;
    return $fields;

}


remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action("woocommerce_after_checkout_registration_form", "woocommerce_checkout_payment");

/*
function custom_add_to_cart_redirect() { 
    return 'checkout'; 
}
add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );
*/


add_filter('add_to_cart_redirect', 'themeprefix_add_to_cart_redirect');
function themeprefix_add_to_cart_redirect() {
 global $woocommerce;
 $checkout_url = $woocommerce->cart->get_checkout_url();
 return $checkout_url;
}


add_action('template_redirect', 'redirection_function');
function redirection_function(){
    global $woocommerce;

    if( is_checkout() && 0 == sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count) && !isset($_GET['key']) ) {
        wp_redirect( home_url() ); 
        exit;
    }
}


function my_acf_init() {
	
	acf_update_setting('select2_version', 4);
	
}

add_action('acf/init', 'my_acf_init');



/*
add_filter( 'woocommerce_cart_item_quantity', 'fanatic_add_update_cart_item', 10, 2 );
function fanatic_add_update_cart_item( $product_quantity, $cart_item_key ) {
	global $woocommerce;
	$cart = $woocommerce->cart->get_cart();
	$product = $cart[ $cart_item_key ]['data'];
	$product_id = $product->id;
	if ( $product->is_sold_individually() === false ) {
		$product_quantity .= '<input type="submit" class="update-qty" name="update_cart" value="'.__( 'Update Cart', 'woocommerce' ).'" />';
	}
	return $product_quantity;
}
*/



add_filter( 'woocommerce_checkout_fields' , 'custom_wc_checkout_fields' );
 
function custom_wc_checkout_fields( $fields ) {

	unset($fields['billing']['billing_company']);

	$fields['billing']['billing_proposalday']['label'] = 'Proposal Day';
	$fields['billing']['billing_proposalday']['class'][0] = 'form-row-wide';
	$fields['billing']['billing_proposalday']['priority'] = '30';
	$fields['billing']['billing_proposalday']['autocomplete'] = 'Proposal Day';
	$fields['billing']['billing_proposalday']['required'] = true;

	return $fields;
	
}


function wc_order_item_added($item_id, $item, $order_id) {
	
	$meta_vals = $item->legacy_values['product_meta']['meta_data'][""];
    
    $key = 'Additional options: ';
    $value = implode($meta_vals, '  '); 

    wc_add_order_item_meta($item_id, $key, $value);

}

add_action('woocommerce_new_order_item', 'wc_order_item_added', 10, 2);
