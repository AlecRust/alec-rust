<?php
/**
 * Template for displaying generic pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

  <?php while ( have_posts() ) : the_post(); ?>

    <article <?php post_class(); ?>>

      <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
      </header>

      <div class="entry-content">
        <?php /* Output Gravatar on About page */ ?>
        <?php if ( is_page('about') ) : ?>
          <figure class="img-polaroid">
            <?php echo get_avatar( $id_or_email = 'me@alecrust.com', $size = '300' ); ?>
            <figcaption class="img-polaroid-caption">
              My current <a href="http://en.gravatar.com/">Gravatar</a>
            </figcaption>
          </figure>
        <?php endif; ?>
        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:' ), 'after' => '</div>' ) ); ?>
      </div>

      <footer class="entry-meta visuallyhidden">
        <p class="timestamp">
          <?php alecrust_entry_meta(); ?>
        </p>
      </footer>

      <?php edit_post_link( __( 'Edit' ), '<aside class="edit-link">', '</aside>' ); ?>

    </article>

  <?php endwhile; ?>

<?php get_footer(); ?>
