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
            <p>Choose a company below to browse some of my past work.</p>
        </div>
    </article>

    <section class="post work-list">
        <h2>Large Corporations</h2>
        <ul>
        <?php query_posts( array( 'category_name' => 'large-corporations', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => 100 ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <dl>
                        <dt><?php the_title(); ?></dt>
                        <dd><?php the_post_thumbnail( 'single-post-thumbnail' ); ?></dd>
                    </dl>
                </a>
            </li>
        <?php endwhile; ?>
        </ul>
    </section>

    <section class="post work-list">
        <h2>Small Businesses</h2>
        <ul>
        <?php query_posts( array( 'category_name' => 'small-businesses', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => 100 ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <dl>
                        <dt><?php the_title(); ?></dt>
                        <dd><?php the_post_thumbnail( 'single-post-thumbnail' ); ?></dd>
                    </dl>
                </a>
            </li>
        <?php endwhile; ?>
        </ul>
    </section>

<?php get_footer(); ?>
