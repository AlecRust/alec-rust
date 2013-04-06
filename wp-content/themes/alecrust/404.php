<?php
/**
 * Template for displaying 404 pages
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <article class="post error404 no-results not-found">

        <header class="entry-header">
            <h1 class="entry-title"><?php _e( 'Something bad happened.' ); ?></h1>
        </header>

        <div class="entry-content">
            <p><?php _e( 'Sorry, the page you&rsquo;re looking for can&rsquo;t be found. Perhaps searching can help?' ); ?></p>
            <?php get_search_form(); ?>
        </div>

    </article>

<?php get_footer(); ?>
