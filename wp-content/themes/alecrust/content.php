<?php
/**
 * Default template for displaying content. Used for both single and index/archive/search
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
            <?php if ( is_single() ) : ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php else : ?>
            <h1 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a>
            </h1>
            <?php endif; ?>
        </header>

        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'Read more' ) ); ?>
        </div>
        <?php endif; ?>

        <footer class="entry-meta">
            <?php if ( comments_open() ) : ?>
                <p class="comments-link">
                    <?php comments_popup_link( __( 'Leave a reply' ), __( '1 Reply' ), __( '% Replies' ) ); ?>
                </p>
            <?php endif; ?>
            <p class="timestamp">
                <?php alecrust_entry_meta(); ?>
            </p>
        </footer>

        <?php edit_post_link( __( 'Edit' ), '<p class="edit-link">', '</p>' ); ?>

    </article>
