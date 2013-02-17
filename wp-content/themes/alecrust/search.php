<?php
/**
 * Template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <h1 class="page-title"><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        </header>

        <?php alecrust_content_nav( 'nav-above' ); ?>

        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', get_post_format() ); ?>
        <?php endwhile; ?>

        <?php alecrust_content_nav( 'nav-below' ); ?>

    <?php else : ?>

        <article class="post no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title"><?php _e( 'Nothing Found' ); ?></h1>
            </header>

            <div class="entry-content">
                <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        </article>

    <?php endif; ?>

<?php get_footer(); ?>
