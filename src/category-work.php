<?php
/**
 * Template Name: Work Index
 *
 * Description: Work Index page template
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

  <article class="post">
    <header class="entry-header">
      <h1 class="entry-title">Work</h1>
    </header>
    <div class="entry-content">
      <?php echo category_description( get_category_by_slug('work')->term_id ); ?>
    </div>
  </article>

  <?php query_posts( array( 'category_name' => 'large-corporations', 'orderby' => 'date', 'posts_per_page' => 100 ) ); ?>
  <?php if (have_posts()) : ?>
    <?php
      $category_id = get_cat_ID( 'Large Corporations' );
      $category_link = get_category_link( $category_id );
    ?>
    <section class="post work-list">
      <h2><a href="<?php echo esc_url( $category_link ); ?>">Large Corporations</a></h2>
      <ul>
      <?php while (have_posts()) : the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <dl>
              <dt><?php the_title(); ?></dt>
              <dd><?php the_post_thumbnail( array(60,60) ); ?></dd>
            </dl>
          </a>
        </li>
      <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; ?>

  <?php query_posts( array( 'category_name' => 'small-businesses', 'orderby' => 'date', 'posts_per_page' => 100 ) ); ?>
  <?php if (have_posts()) : ?>
    <?php
      $category_id = get_cat_ID( 'Small Businesses' );
      $category_link = get_category_link( $category_id );
    ?>
    <section class="post work-list">
      <h2><a href="<?php echo esc_url( $category_link ); ?>">Small Businesses</a></h2>
      <ul>
      <?php while (have_posts()) : the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <dl>
              <dt><?php the_title(); ?></dt>
              <dd><?php the_post_thumbnail( array(60,60) ); ?></dd>
            </dl>
          </a>
        </li>
      <?php endwhile; ?>
      </ul>
    </section>
  <?php endif; ?>

<?php get_footer(); ?>
