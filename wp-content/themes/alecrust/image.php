<?php
/**
 * Template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <article <?php post_class( 'post' ); ?>>

            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <p class="entry-meta attachment-meta">
                    <?php
                    $metadata = wp_get_attachment_metadata();
                    printf( __( 'Published at <a href="%3$s" title="Full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s">%8$s</a>' ),
                        esc_attr( get_the_time() ),
                        get_the_date(),
                        esc_url( wp_get_attachment_url() ),
                        $metadata['width'],
                        $metadata['height'],
                        esc_url( get_permalink( $post->post_parent ) ),
                        esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
                        get_the_title( $post->post_parent )
                    );
                    ?>
                </p>
            </header>

            <div class="entry-content">

                <div class="entry-attachment">

                    <div class="attachment">
                        <?php
                        $attachment_size = apply_filters( 'alecrust_attachment_size', array( 960, 960 ) );
                        echo wp_get_attachment_image( $post->ID, $attachment_size );
                        ?>

                        <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                        <div class="entry-caption">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="entry-description">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:' ), 'after' => '</div>' ) ); ?>
                </div>

            </div>

            <footer class="entry-meta">
                <?php edit_post_link( __( 'Edit' ), '<aside class="edit-link">', '</aside>' ); ?>
                <p class="timestamp visuallyhidden">
                    <?php alecrust_entry_meta(); ?>
                </p>
            </footer>

        </article>

    <?php endwhile; ?>

<?php get_footer(); ?>
