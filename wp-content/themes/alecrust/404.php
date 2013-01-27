<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Alec_Rust
 * @since Alec Rust 1.0
 */

get_header(); ?>

    <article class="post error404 no-results not-found">
        <header class="entry-header">
            <h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?' ); ?></h1>
        </header>

        <div class="entry-content">
            <p><?php _e( 'It seems what you&rsquo;re looking for can&rsquo;t be found. Perhaps searching can help.' ); ?></p>
            <?php get_search_form(); ?>
        </div>
    </article>

<?php get_footer(); ?>
