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

  printf(
    $date
  );
}
endif;

if ( ! function_exists( 'alecrust_skills_used' ) ) :
/**
 * Prints skills using tag list
 */
function alecrust_skills_used() {
  $tag_list = get_the_tag_list('<h2>Skills Used</h2><ul class="tag-list"><li class="tag-list-item">', '</li><li class="tag-list-item">', '</li></ul>');
  echo $tag_list;
}
endif;
