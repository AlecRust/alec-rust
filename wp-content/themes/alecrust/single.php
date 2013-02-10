<?php
/**
 * Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', get_post_format() ); ?>

        <nav class="nav-single">
            <h3 class="assistive-text"><?php _e( 'Post navigation' ); ?></h3>
            <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link' ) . '</span> %title' ); ?></span>
            <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link' ) . '</span>' ); ?></span>
        </nav>

        <?php comments_template( '', true ); ?>

    <?php endwhile; ?>

<?php get_footer(); ?>
