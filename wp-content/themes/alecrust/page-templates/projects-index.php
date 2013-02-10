<?php
/**
 * Template Name: Projects Index
 *
 * Description: Projects Index page template
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <article class="post">
        <h1>Projects</h1>
        <p>Browse the personal and open-source projects I've been involved in below.</p>
    </article>

    <section class="post work-list">
        <h2>Personal Projects</h2>
        <ul>
            <?php query_posts('category_name=personal-projects'); ?>
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
        <h2>Open-source Projects</h2>
        <ul>
            <?php query_posts('category_name=open-source-projects'); ?>
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
