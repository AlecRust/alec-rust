<?php
/**
 * Custom template tags.
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

if ( ! function_exists( 'alecrust_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and tags.
 */
function alecrust_posted_on() {
  // Translators: used between list items, there is a space after the comma
  $categories_list = get_the_category_list( __( ', ' ) );

  // Use tag list component for skills
  $tag_list = get_the_tag_list('<h2>Skills Used</h2><ul class="tag-list"><li class="tag-list-item">','</li><li class="tag-list-item">','</li></ul>');

  // If Work or Project post
  // TODO: Add facility to output years range
  if ( in_category( array( 'work', 'projects' ) )) {
    $date = sprintf( '<a href="%1$s"><time class="entry-date published updated" datetime="%2$s">Year %2$s</time></a>',
      esc_url( get_permalink() ),
      esc_attr( get_the_date( 'Y' ) )
    );
  } else {
    $date = sprintf( '<a href="%1$s" title="%2$s"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() )
    );
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $date = sprintf('<a href="%1$s" title="%2$s"><time class="entry-date published" datetime="%3$s">%4$s</time> <span class="visuallyhidden">Updated <time class="updated" datetime="%5$s">%6$s</time></span>',
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
      );
    }
  }

  // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name
  if ( $tag_list ) {
    $utility_text = __( '%3$s %2$s' );
  } elseif ( $categories_list ) {
    $utility_text = __( '%3$s' );
  } else {
    $utility_text = __( '%3$s' );
  }

  printf(
    $utility_text,
    $categories_list,
    $tag_list,
    $date
  );
}
endif;
