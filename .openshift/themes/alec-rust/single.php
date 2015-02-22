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

        <?php comments_template( '', true ); ?>

    <?php endwhile; ?>

<?php get_footer(); ?>
