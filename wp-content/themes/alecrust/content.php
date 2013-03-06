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
            <?php /* Render "Websites Developed" section if attached to post */ ?>
            <?php $attachments = new Attachments( 'websites_developed' ); ?>
            <?php if( $attachments->exist() ) : ?>
                <h2>Websites Developed</h2>
                <ul class="work-heros">
                    <?php while( $attachments->get() ) : ?>
                        <li>
                            <a href="<?php echo $attachments->field( 'website_url' ); ?>">
                                <h3><?php echo $attachments->field( 'website_name' ); ?></h3>
                                <img src="<?php echo $attachments->url(); ?>" width="325" height="425" alt="<?php echo $attachments->field( 'website_name' ); ?>">
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
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

        <?php edit_post_link( __( 'Edit' ), '<aside class="edit-link">', '</aside>' ); ?>

    </article>
