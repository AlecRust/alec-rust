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
        <h1><?php _e( 'Work' ); ?></h1>
        <p><?php _e( 'Choose a company below to browse some of my past work.' ); ?></p>
    </article>

    <section class="post work-list">
        <h2><?php _e( 'Large Corporations' ); ?></h2>
        <ul>
            <?php query_posts('category_name=large-corporations'); ?>
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
        <h2><?php _e( 'Small Businesses' ); ?></h2>
        <ul>
            <?php query_posts('category_name=small-businesses'); ?>
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
