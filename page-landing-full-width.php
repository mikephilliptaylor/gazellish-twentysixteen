<?php
/**
 * The template for displaying full-width landing pages
 *
 * Template Name: Landing Page (Full-Width)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<?php if ( get_field('landing_top_section_text',$post->ID) || get_field('landing_top_background_image',$post->ID) ): ?>

	<div class="landing-top" style="background: url(<?php the_field('landing_top_background_image',$post->ID);?>) no-repeat center;">
		<div class="landing-top-inner">
			<?php the_field('landing_top_section_text',$post->ID);?>
		</div>
		<div class="top-overlay" style="background-color: <?php the_field('landing_top_background_color',$post->ID);?>; <?php if ( get_field('landing_top_background_image',$post->ID) ): ?>opacity: 0.7;<?php endif; ?>"></div>
	</div>

<?php endif; ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
