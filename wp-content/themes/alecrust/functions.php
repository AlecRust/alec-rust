<?php
/**
 * Alec Rust functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook
 *
 * More information on hooks, actions, and filters: http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

/**
 * Sets up theme defaults and registers the various WordPress features supported
 *
 * @uses add_editor_style() To add a Visual Editor stylesheet
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links and post formats
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size
 */
function alecrust_setup() {
    // This theme styles the visual editor with editor-style.css to match the theme style
    add_editor_style();

    // Adds RSS feed links to <head> for posts and comments
    add_theme_support( 'automatic-feed-links' );

    // This theme supports the "Image" post format
    add_theme_support( 'post-formats', array( 'image' ) );

    // This theme uses a custom image size for featured images, displayed on "standard" posts
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'alecrust_setup' );

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
 * Adds category class to <body> on single post pages
 */
add_filter('body_class','add_category_to_single');
function add_category_to_single($classes, $class) {
    if (is_single() ) {
        global $post;
        foreach((get_the_category($post->ID)) as $category) {
            echo $category->cat_name . ' ';
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
 * Sets up "Attachments" section under post
 */
function post_attachments( $attachments )
{
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
        'button_text'   => __( 'Add Attachment', 'attachments' ),           // text for 'Attach' button in meta box (string)
        'modal_text'    => __( 'Attach', 'attachments' ),                   // text for modal 'Attach' button (string)
        'router'        => 'browse',                                        // which tab should be the default in the modal (string) (browse|upload)
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
 * Enqueues scripts and styles for front-end
 */
function alecrust_scripts_styles() {
    global $wp_styles;

    // Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Loads the main stylesheet
    wp_enqueue_style( 'alecrust-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'alecrust_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view
 *
 * @param string $title Default title text for current view
 * @param string $sep Optional separator
 * @return string Filtered title
 */
function alecrust_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Adds the site name
    $title .= get_bloginfo( 'name' );

    // Adds the site description for the front page
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_front_page() ) )
        $title = "$title $sep $site_description";

    // Adds a page number if necessary
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'alecrust_wp_title', 10, 2 );

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
        <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
            <h3 class="visuallyhidden"><?php _e( 'Post navigation' ); ?></h3>
            <div class="nav-previous alignleft"><?php next_posts_link( __( 'Older posts' ) ); ?></div>
            <div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts' ) ); ?></div>
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
 * Prints HTML with meta information for current post
 */
if ( ! function_exists( 'alecrust_entry_meta' ) ) :
function alecrust_entry_meta() {
    // Translators: used between list items, there is a space after the comma
    $categories_list = get_the_category_list( __( ', ' ) );

    // Translators: used between list items, there is a space after the comma
    $tag_list = get_the_tag_list( '', __( ', ' ) );

    // If Work or Project post
    // TODO: Add facility to output years range
    if ( in_category( 'work' && 'projects' )) {
        $date = sprintf( '<a href="%1$s"><time class="entry-date" datetime="%2$s">Year %2$s</time></a>',
            esc_url( get_permalink() ),
            esc_attr( get_the_date( 'Y' ) )
        );
    } else {
        $date = sprintf( '<a href="%1$s" title="%2$s"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
            esc_url( get_permalink() ),
            esc_attr( get_the_time() ),
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() )
        );
    }

    $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s' ), get_the_author() ) ),
        get_the_author()
    );

    // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name
    if ( $tag_list ) {
        $utility_text = __( 'Tagged %2$s on %3$s' );
    } elseif ( $categories_list ) {
        $utility_text = __( '%3$s' );
    } else {
        $utility_text = __( '%3$s' );
    }

    printf(
        $utility_text,
        $categories_list,
        $tag_list,
        $date,
        $author
    );
}
endif;

/**
 * Adds Google Analytics JS snippet to footer
 */
add_action('wp_footer', 'add_google_analytics');
function add_google_analytics() { ?>
    <script>
        var _gaq=[['_setAccount','UA-3217267-1'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src='//www.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
<?php } ?>
