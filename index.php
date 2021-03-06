<?php
/**
 * Main template file
 *
 * This is the most generic template file in a WordPress theme.
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @package alec-rust
 */

get_header(); ?>

  <?php if ( have_posts() ) : ?>

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
        <p>Apologies, but no results were found. Perhaps searching will help find a related post.</p>
        <?php get_search_form(); ?>
      </div>

    </article>

  <?php endif; ?>

<?php get_footer(); ?>
