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
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:' ), 'after' => '</div>' ) ); ?>
            </div>

            <footer class="entry-meta">
                <?php edit_post_link( __( 'Edit Page' ), '<p class="edit-link">', '</p>' ); ?>
            </footer>

        </article>

        <?php comments_template( '', true ); ?>

    <?php endwhile; ?>

<?php get_footer(); ?>
