<?php
/**
 * Template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <?php if ( have_posts() ) : ?>
        <header class="archive-header">
            <h1 class="archive-title"><?php
                if ( is_day() ) :
                    printf( __( 'Daily Archives: %s' ), get_the_date() );
                elseif ( is_month() ) :
                    printf( __( 'Monthly Archives: %s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
                elseif ( is_year() ) :
                    printf( __( 'Yearly Archives: %s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
                elseif ( in_category( 'blog' ) ) :
                    _e( 'Blog' );
                else :
                    _e( 'Archives' );
                endif;
            ?></h1>
        </header>

        <?php
        while ( have_posts() ) : the_post();

            /* Include the post format-specific template for the content. If you want to
             * this in a child theme then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead
             */
            get_template_part( 'content', get_post_format() );

        endwhile;

        alecrust_content_nav( 'nav-below' );
        ?>

    <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>

<?php get_footer(); ?>
