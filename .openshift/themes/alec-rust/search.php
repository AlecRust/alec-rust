<?php
/**
 * Template for displaying Search Results pages
 *
 * @package alec-rust
 */

get_header(); ?>

  <?php if ( have_posts() ) : ?>

    <header class="archive-header">
      <h1 class="archive-title"><?php printf( __( 'Search Results for "%s"' ), get_search_query() ); ?></h1>
    </header>

    <?php alecrust_content_nav( 'nav-above' ); ?>

    <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'content', get_post_format() ); ?>
    <?php endwhile; ?>

    <?php alecrust_content_nav( 'nav-below' ); ?>

  <?php else : ?>

    <article class="post no-results not-found">
      <header class="entry-header">
        <h1 class="entry-title">Nothing Found</h1>
      </header>

      <div class="entry-content">
        <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
        <?php get_search_form(); ?>
      </div>
    </article>

  <?php endif; ?>

<?php get_footer(); ?>
