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
        <header class="entry-header">
            <h1 class="entry-title">Projects</h1>
        </header>
        <div class="entry-content">
            <p>Browse the personal and open-source projects I&rsquo;ve been involved in below.</p>
        </div>
    </article>

    <?php query_posts( array( 'category_name' => 'personal-projects', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => 100 ) ); ?>
    <?php if (have_posts()) : ?>
    <section class="post work-list">
        <h2>Personal Projects</h2>
        <ul>
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
    <?php endif; ?>

    <?php query_posts( array( 'category_name' => 'open-source-projects', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => 100 ) ); ?>
    <?php if (have_posts()) : ?>
    <section class="post work-list">
        <h2>Open-source Projects</h2>
        <ul>
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
    <?php endif; ?>

<?php get_footer(); ?>
