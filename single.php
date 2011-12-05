<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<nav id="nav-single">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
						<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
					</nav><!-- #nav-single -->

					<?php get_template_part( 'content', 'single' ); ?>

          <?php
          
            //echo get_post_custom_values('address');
            echo get_post_meta( $post->ID, 'address', true );
            echo get_post_meta( $post->ID, 'Suburb', true );
            echo get_post_meta( $post->ID, 'www', true );
          
          ?>

<div id="map_canvas" style="width:100%; height:500px"></div>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->


    <script type="text/javascript">

              jQuery().ready(function() {

                    var latlng = new google.maps.LatLng(<?php echo get_post_meta( $post->ID, 'latlong', true ); ?>);
                    var myOptions = {
                      zoom: 12,
                      center: latlng,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("map_canvas"),
                        myOptions);
                    var marker = new google.maps.Marker({
                         position: latlng, 
                         map: map
                     });

          });
        </script>


<?php get_footer(); ?>