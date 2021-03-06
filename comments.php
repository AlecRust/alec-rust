<?php
/**
 * Template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to alecrust_comment() which is
 * located in functions.php
 *
 * @package alec-rust
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments
 */
if ( post_password_required() ) {
  return;
}
?>

<div id="comments" class="comments-area">

  <?php if ( have_comments() ) : ?>

    <h2 class="comments-title">
      <?php
        printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number() ),
          number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
      ?>
    </h2>

    <ol class="commentlist">
      <?php wp_list_comments( array( 'callback' => 'alecrust_comment', 'style' => 'ol' ) ); ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-below" class="navigation" role="navigation">
      <h1 class="visuallyhidden section-heading"><?php _e( 'Comment navigation' ); ?></h1>
      <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( __( 'Newer Comments' ) ); ?></div>
    </nav>
    <?php endif; // check for comment navigation ?>

    <?php
    /* If there are no comments and comments are closed, let's leave a note
     * But we only want the note on posts and pages that had comments in the first place
     */
    if ( ! comments_open() && get_comments_number() ) : ?>
      <p class="nocomments"><?php _e( 'Comments are closed.' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php comment_form(array('comment_notes_after' => '')); ?>

</div>
