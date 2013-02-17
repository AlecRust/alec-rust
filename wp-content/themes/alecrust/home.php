<?php
/**
 * Template for displaying the Blog Index
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <?php /* Display posts only from the "Blog" category */ ?>
    <?php query_posts('cat=2'); if ( have_posts() ) : ?>

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
                <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.' ); ?></p>
                <?php get_search_form(); ?>
            </div>

        </article>

    <?php endif; ?>

<?php get_footer(); ?>
