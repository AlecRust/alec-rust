<?php
/**
 * Alec Rust functions and definitions
 *
 * Information on hooks, actions, and filters: http://codex.wordpress.org/Plugin_API
 *
 * @package alec-rust
 */

/**
 * Sets up theme defaults and registers the various WordPress features supported
 *
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links and post formats
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size
 */
function alecrust_setup() {
  // Styles the visual editor with editor-style.css to match the theme style
  add_editor_style();

  // Adds RSS feed links to <head> for posts and comments
  add_theme_support( 'automatic-feed-links' );

  // Let WordPress manage the document title
  add_theme_support( 'title-tag' );

  // This theme uses a custom image size for featured images, displayed on "standard" posts
  add_theme_support( 'post-thumbnails' );

  set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'alecrust_setup' );

/**
 * Enqueue scripts and styles.
 */
function alecrust_scripts() {
  wp_enqueue_script( 'jquery' );
  wp_enqueue_style( 'wpg-style', get_stylesheet_uri() );
  wp_enqueue_script( 'wpg-script', get_template_directory_uri() . '/script.js', array(), '1.1.0', true );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'alecrust_scripts' );

/**
 * Removes junk from head
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/**
 * Registers widgetized area and blog sidebar
 */
function sidebar_widgets_init() {
  register_sidebar( array(
    'name' => 'Home Bottom Right Module',
    'id' => 'sidebar-1',
    'before_widget' => '<section class="module module-tweets">',
    'after_widget' => '<p class="view-more"><a href="https://twitter.com/AlecRust">View my Twitter profile</a></p></section>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));

  register_sidebar(array(
    'name' => 'Blog Sidebar',
    'id' => 'sidebar-2',
    'before_widget' => '<aside class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ));
}
add_action( 'widgets_init', 'sidebar_widgets_init' );

/**
 * Registers theme menus
 */
function register_menus() {
  register_nav_menus(
    array(
      'primary-menu' => __( 'Primary Menu' ),
      'social-menu' => __( 'Social Menu' )
    )
  );
}
add_action( 'init', 'register_menus' );

/**
 * Adds category class to <body> on single post pages
 */
add_filter('body_class','add_category_to_single');
function add_category_to_single($classes) {
  if (is_single() ) {
    global $post;
    foreach((get_the_category($post->ID)) as $category) {
      // add category slug to the $classes array
      $classes[] = 'category-'.$category->slug;
    }
  }
  // return the $classes array
  return $classes;
}

/**
 * Removes pages from search results
 */
function pages_search_filter($query) {
  if ($query->is_search) {
    $query->set('post_type', 'post');
  }
  return $query;
}
add_filter('pre_get_posts','pages_search_filter');

/**
 * Sets up "Attachments" section under post content
 */
function post_attachments( $attachments ) {
  $fields = array(
    array(
      'name'      => 'attachment_hero_title',                         // unique field name
      'type'      => 'text',                                          // registered field type
      'label'     => __( 'Attachment Hero Title', 'attachments' ),    // label to display
      'default'   => 'attachment_hero_title',                         // default value upon selection
    ),
    array(
      'name'      => 'attachment_link',                               // unique field name
      'type'      => 'text',                                          // registered field type
      'label'     => __( 'Attachment Link', 'attachments' ),          // label to display
      'default'   => 'attachment_link',                               // default value upon selection
    ),
  );
  $args = array(
    'label'         => 'Screenshots/Links',                             // title of the meta box (string)
    'post_type'     => array( 'post' ),                                 // all post types to utilize (string|array)
    'position'      => 'normal',                                        // meta box position (string) (normal, side or advanced)
    'priority'      => 'high',                                          // meta box priority (string) (high, default, low, core)
    'filetype'      => 'image',                                         // allowed file type(s) (array) (image|video|text|audio|application)
    'button_text'   => __( 'Add attachment', 'attachments' ),           // text for 'Attach' button in meta box (string)
    'modal_text'    => __( 'Add attachment', 'attachments' ),           // text for modal 'Attach' button (string)
    'router'        => 'upload',                                        // which tab should be the default in the modal (string) (browse|upload)
    'fields'        => $fields,                                         // fields array
  );
  $attachments->register( 'post_attachments', $args );                    // unique instance name
}
add_action( 'attachments_register', 'post_attachments' );

/**
 * Switches off the "Attachments" plugin Settings panel
 */
define( 'ATTACHMENTS_SETTINGS_SCREEN', false );

/**
 * Disables the emoji's
 */
function ar_disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'ar_disable_emojis' );

/**
 * Changes the default feed cache recreation period to 2 hours
 */
function filter_handler( $seconds ) {
  return 7200;
}
add_filter( 'wp_feed_cache_transient_lifetime', 'filter_handler' );

/**
 * Adds a class to the "Read more" link wrapper
 */
function add_more_wrapper($link) {
  return "<p class='view-more'>$link</p>";
}
add_filter('the_content_more_link', 'add_more_wrapper');

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link
 */
function alecrust_page_menu_args( $args ) {
  if ( ! isset( $args['show_home'] ) )
    $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'alecrust_page_menu_args' );

/**
 * Displays navigation to next/previous pages when applicable
 */
if ( ! function_exists( 'alecrust_content_nav' ) ) :
function alecrust_content_nav( $html_id ) {
  global $wp_query;
  $html_id = esc_attr( $html_id );
  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav class="post-navigation" id="<?php echo $html_id; ?>" role="navigation">
      <h1 class="visuallyhidden">Post navigation</h1>
      <ul>
        <li class="prev"><?php next_posts_link( __( 'Older posts' ) ); ?></li>
        <li class="next"><?php previous_posts_link( __( 'Newer posts' ) ); ?></li>
      </ul>
    </nav>
  <?php endif;
}
endif;

/**
 * Template for comments and pingbacks
 *
 * Used as a callback by wp_list_comments() for displaying the comments
 */
if ( ! function_exists( 'alecrust_comment' ) ) :
function alecrust_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
    // Display trackbacks differently than normal comments
  ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)' ), '<aside class="edit-link">', '</aside>' ); ?></p>
  <?php
      break;
    default :
    // Proceed with normal comments
    global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <header class="comment-meta comment-author vcard">
        <?php
          echo get_avatar( $comment, 44 );
          printf( '<cite class="fn author">%1$s</cite>',
            get_comment_author_link()
          );
          printf( '<a href="%1$s" title="%2$s" class="timestamp"><time datetime="%2$s">%3$s</time></a>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            get_comment_time( 'c' ),
            /* translators: 1: date, 2: time */
            sprintf( __( '%1$s'), get_comment_date(), get_comment_time() )
          );
        ?>
      </header>

      <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
      <?php endif; ?>

      <section class="comment-content comment">
        <?php comment_text(); ?>
        <?php edit_comment_link( __( 'Edit' ), '<aside class="edit-link">', '</aside>' ); ?>
      </section>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
    </article>
  <?php
    break;
  endswitch; // end comment_type check
}
endif;

/**
 * Returns a term IDs of terms that are associated with a post, and who have
 * child terms also associated with the post.
 *
 * Please note, 'parent' is a slight misnomer. If you have category structure:
 *    Cat A > Sub-Cat B > Sub-Sub-Cat C
 * and a post belongs to A and B, but not C. 'B' is not considered a parent term
 * for this post.
 *
 * @link http://wordpress.stackexchange.com/questions/101633/restrict-post-navigation-to-current-sub-menu/102616#102616
 * @param int $post_id. Optional, defaults to the 'current' post.
 * @return array An array of 'parent' term IDs
 */
function get_parent_terms( $post_id = 0 ) {
  $post_id = ( $post_id ? $post_id : get_the_ID() );
  $terms = get_the_terms( $post_id, 'category' );
  $terms_with_children = array();
  if ( $terms ) {
    foreach( $terms as $t ) {
      if ( $t->parent && !in_array(  $t->parent, $terms_with_children ) ) {
        $terms_with_children[] = $t->parent;
      }
    }
  }
  return $terms_with_children ;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
