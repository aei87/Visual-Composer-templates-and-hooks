
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/frontpage.css">


<?php

/* ed_open */

/* Reviews owl */

function frontpage_reviews( $atts ){
	?>

    <script type="text/javascript">
    		
	    (function($) {
		    $(document).ready(function() {
		            

		          var owl = $('#reviews_carousel');
			      owl.owlCarousel({
			        margin: 30,
			        loop: true,
			        merge:true,
			        nav : true,
			        responsive: {
			          0: {
			            items: 1
			          },
			          600: {
			            items: 3
			          },
			          1000: {
			            items: 4
			          }
			        }
			      })


					$('.reviews_carousel_next').click(function(){
					    $( "#reviews_carousel .owl-next" ).click();
					})


					$('.reviews_carousel_prev').click(function(){
					    $( "#reviews_carousel .owl-prev" ).click();
					})

		    });
		}) (jQuery);

     </script>

    <div id="reviews_carousel" class="owl-carousel">

		<?php

		$args = array(
			'post_type' => 'post',
			'cat' => '28'
		);

		$query_reviews = new WP_Query;
		$reviews_entries = $query_reviews->query($args); 

		global $post; 
		$i = 1;

		foreach( $reviews_entries as $review ){

			$post = $review;
			setup_postdata($post);
			
			$i++; 

			if ($i % 3 == 0) {
				$merge = 2;
				$thumb = 'frontpage_thumb_0';
			} else {
				$merge = 1;
				$thumb = 'frontpage_thumb_0';
			}

			ob_start();
			the_excerpt();
			$excerpt = ob_get_contents();
			ob_end_clean();
			$excerpt = preg_replace('/\s+?(\S+)?$/', '', substr($excerpt, 0, 150));

			?> 
			<div class="item" style="background-image: url('<?php echo get_the_post_thumbnail_url($review->ID, $thumb) ?>');" data-merge="<?php echo $merge; ?>">
								
				<a href="<?php echo get_the_permalink(); ?>">
					<div class="inner">
						<div class="owl_title"><a href="<?php echo get_the_permalink(); ?>"><?php echo substr($review->post_title, 0, 50); ?></a> </div> 		
						<div class="owl_excerpt"><?php echo $excerpt; ?></div>
					</div>
				</a>
										
			</div>
			<?php
		}

		wp_reset_postdata();

		?>

	</div>

  	<?php
}

add_shortcode('frontpage_reviews', 'frontpage_reviews');







/* Blog owl */

function frontpage_blog_scroll( $atts ){

	?>

    <script type="text/javascript">
    		
	    (function($) {
		    $(document).ready(function() {
		            

		          var owl = $('#blog_carousel');
			      owl.owlCarousel({
			        margin: 30,
			        loop: true,
			        nav : true,
			        responsive: {
			          0: {
			            items: 1
			          },
			          600: {
			            items: 2
			          },
			          1000: {
			            items: 3
			          }
			        }
			      })


					$('.blog_carousel_next').click(function(){
					    $( "#blog_carousel .owl-next" ).click();
					})


					$('.blog_carousel_prev').click(function(){
					    $( "#blog_carousel .owl-prev" ).click();
					})

		    });
		}) (jQuery);

     </script>

    <div id="blog_carousel" class="owl-carousel">

		<?php

		$args = array(
			'post_type' => 'post'
		);

		$query_blog = new WP_Query;
		$blog_entries = $query_blog->query($args); 

		global $post; 

		foreach( $blog_entries as $blog_entry ){

			$post = $blog_entry;
			setup_postdata($post);

			?> 
			<div class="item">
				
					<div class="owl_thumb"><a href="<?php echo get_the_permalink(); ?>"><?php  echo get_the_post_thumbnail($blog_entry->ID, 'frontpage_thumb_1'); ?></a></div>
					<div class="inner">
						<div class="owl_title"><a href="<?php echo get_the_permalink(); ?>"><?php echo $blog_entry->post_title; ?></a> </div> 		
						<div class="owl_excerpt"><?php the_excerpt(); ?></div>
					</div>
			</div>
			<?php
		}

		wp_reset_postdata();

		?>

	</div>

  	<?php
}

add_shortcode('frontpage_blog_scroll', 'frontpage_blog_scroll');







/* Blog divs */

function frontpage_blog_divs( $atts ){

	?>

   
    <div id="blog_divs">

		<?php

		$args = array(
			'post_type' => 'post'
		);

		$query_blog = new WP_Query;
		$blog_entries = $query_blog->query($args); 

		global $post; 
		$i = 0;
		
		foreach( $blog_entries as $blog_entry ){

			if ($i == 0) {

				$padding = 'padding_left';
				$i++;

			} else if ($i == 1) {

				$padding = 'padding_center';
				$i++; 

			} else {

				$padding = 'padding_right';
				$i = 0;
			}

			$post = $blog_entry;
			setup_postdata($post);

			?> 
			<div class="item <?php echo $padding; ?>">
				
					<div class="owl_thumb"><a href="<?php echo get_the_permalink(); ?>"><?php  echo get_the_post_thumbnail($blog_entry->ID, 'frontpage_thumb_1'); ?></a></div>
					<div class="inner">
						<div class="owl_title"><a href="<?php echo get_the_permalink(); ?>"><?php echo $blog_entry->post_title; ?></a> </div> 		
						<div class="owl_excerpt"><?php the_excerpt(); ?></div>
					</div>
			</div>
			<?php
		}

		wp_reset_postdata();

		?>

	</div>

  	<?php
}

add_shortcode('frontpage_blog_divs', 'frontpage_blog_divs');












/* Blog divs */

function frontpage_proposals( $atts ){

	?>

   
    <div id="proposal_divs">

		<?php

		$args = array(
			'post_type' => 'post'
		);

		$query_proposal = new WP_Query;
		$proposal_entries = $query_proposal->query($args); 

		global $post; 
		$i = 0;
		
		foreach( $proposal_entries as $proposal_entry ){

			if ($i == 0) {

				$padding = 'padding_left';
				$i++;

			} else if (($i == 1) || ($i == 2)) {

				$padding = 'padding_center';
				$i++; 

			} else {

				$padding = 'padding_right';
				$i = 0;
			}

			$post = $proposal_entry;
			setup_postdata($post);

			?> 
			<div class="item <?php echo $padding; ?>">
				
					<div class="owl_thumb"><a href="<?php echo get_the_permalink(); ?>"><?php  echo get_the_post_thumbnail($proposal_entry->ID, 'frontpage_thumb_1'); ?></a>
						<div class="inner">
							<a class="btn buy_now" href="<?php echo get_the_permalink(); ?>">Buy now</a>
						</div>
					</div>
			</div>
			<?php
		}

		wp_reset_postdata();

		?>

	</div>

  	<?php
}

add_shortcode('frontpage_proposals', 'frontpage_proposals');







/* Blog divs */

function frontpage_offers( $atts ){

	?>

		<div>
			
			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/img/offer1.png">
			</div>

			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/img/offer2.png">
			</div>

			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/img/offer3.png">
			</div>

			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/img/offer4.png">
			</div>

			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/img/offer5.png">
			</div>

		</div>


	<?php

}

add_shortcode('frontpage_offers', 'frontpage_offers');






add_theme_support( 'post-thumbnails' );
add_image_size( 'frontpage_thumb_0', 600, 600, true);
add_image_size( 'frontpage_thumb_1', 400, 400, true);

add_image_size( 'frontpage_thumb_2', 530, 380, true);
add_image_size( 'frontpage_thumb_3', 285, 380, true);

/* ed_close */




?>