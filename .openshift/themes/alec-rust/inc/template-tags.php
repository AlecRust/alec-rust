<?php
/**
 * Custom template tags.
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

if ( ! function_exists( 'alecrust_posted_on' ) ) :
/**
* Prints HTML with meta information for the current post-date/time and author.
*/
function alecrust_posted_on() {
  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <span class="visuallyhidden">Updated <time class="updated" datetime="%3$s">%4$s</time></span>';
  }
  if ( in_category( array( 'work', 'projects' ) )) {
    $time_string = '<time class="entry-date published updated" datetime="%5$s">%5$s</time>';
  }

  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( 'c' ) ),
    esc_html( get_the_modified_date() ),
    esc_attr( get_the_date( 'Y' ) )
  );

  $posted_on = sprintf(
    esc_html_x( '%s', 'post date', 'ar' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );

  $byline = sprintf(
    esc_html_x( 'by %s', 'post author', 'ar' ),
    '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
  );

  if ( in_category( array( 'work', 'projects' ) )) {
    echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">Year ' . $time_string . '</a>';
  } else {
    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline visuallyhidden"> ' . $byline . '</span>';
  }

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
