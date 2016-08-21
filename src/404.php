<?php
/**
 * Template for displaying 404 pages
 *
 * @package alec-rust
 */

get_header(); ?>

  <article class="post error404 no-results not-found">

    <header class="entry-header">
      <h1 class="entry-title">Sorry, that page doesn’t exist!</h1>
    </header>

    <div class="entry-content">
      <p>You can search this site using the box below, or <a href="<?php echo esc_url( home_url( '/' ) ); ?>">return to the homepage</a>.</p>
      <?php get_search_form(); ?>
    </div>

  </article>

<?php get_footer(); ?>
