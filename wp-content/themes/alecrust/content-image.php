<?php
/**
 * Template for displaying posts in the "Image" post format
 * TODO: Is this template needed?
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */
?>

    <article <?php post_class(); ?>>

        <div class="entry-content">
            <?php the_content( __( 'Read more' ) ); ?>
        </div>

        <footer class="entry-meta">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ) ); ?>">
                <h1><?php the_title(); ?></h1>
                <h2><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time></h2>
            </a>
            <?php if ( comments_open() ) : ?>
            <div class="comments-link">
                <?php comments_popup_link( __( 'Leave a reply' ), __( '1 Reply' ), __( '% Replies' ) ); ?>
            </div>
            <?php endif; ?>
            <?php edit_post_link( __( 'Edit Image' ), '<aside class="edit-link">', '</aside>' ); ?>
        </footer>

    </article>
