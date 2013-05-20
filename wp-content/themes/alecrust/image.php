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
            </header>

            <div class="entry-content">

                <div class="entry-attachment">

                    <div class="attachment">
                        <a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
                        $attachment_size = apply_filters( 'alecrust_attachment_size', array( 960, 960 ) );
                        echo wp_get_attachment_image( $post->ID, $attachment_size );
                        ?></a>

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
                <p class="timestamp">
                    <?php alecrust_entry_meta(); ?>
                </p>
            </footer>

        </article>

    <?php endwhile; ?>

<?php get_footer(); ?>
