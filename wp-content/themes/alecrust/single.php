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

        <nav class="post-navigation">
            <h1 class="visuallyhidden"><?php _e( 'Post Navigation' ); ?></h1>
            <ul>
                <li class="prev"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link' ) . '</span> %title' ); ?></li>
                <li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link' ) . '</span>' ); ?></li>
            </ul>
        </nav>

        <?php comments_template( '', true ); ?>

    <?php endwhile; ?>

<?php get_footer(); ?>
