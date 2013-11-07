<?php
/**
 * Alec Rust functions and definitions
 *
 * Information on hooks, actions, and filters: http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Alec_Rust
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

    // This theme uses a custom image size for featured images, displayed on "standard" posts
    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'alecrust_setup' );

/**
 * Enqueues scripts and styles for front-end
 */
function alecrust_scripts_styles() {
    global $wp_styles;

    // Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'alecrust_scripts_styles' );

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

/*
 * Given a file, i.e. /alec-rust/style.css, replace it with a string containing the
 * file's mtime, i.e. /alec-rust/style.1221534296.css
 *
 * @param $file  The file to be loaded. Must be an absolute path (i.e. starting with slash)
 */
function auto_version($file) {
    if ( strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file) ) {
        return $file;
    }

    $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
    return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
}

/**
 * Registers sidebar and widgetized areas
 */
function sidebar_widgets_init() {
    register_sidebar( array(
        'name' => 'Widgets',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'sidebar_widgets_init' );

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

    // Retrieve category name
    function parent_cat_names( $sep = '|' )
    {
        if ( ! is_single() or array() === $categories = get_the_category() )
            return '';
        $parents = array ();
        foreach ( $categories as $category )
        {
            $parent = end( get_ancestors( $category->term_id, 'category' ) );
            if ( ! empty ( $parent ) )
                $top = get_category( $parent );
            else
                $top = $category;
            $parents[ $top->term_id ] = $top;
        }
        return esc_html( join( $sep, wp_list_pluck( $parents, 'name' ) ) );
    }

    // Adds the parent category
    if ( '' !== $parent_cats = parent_cat_names( $sep ) )
        $title .= "$parent_cats $sep ";

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
    if ( in_category( array( 'work', 'projects' ) )) {
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
        $date
    );
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

    if( $terms ){
        foreach( $terms as $t ) {
            if( $t->parent && !in_array(  $t->parent, $terms_with_children ) ){
                $terms_with_children[] = $t->parent;
            }
        }
    }

    return $terms_with_children ;
}

/**
 * Adds Google Analytics JS snippet to footer
 */
add_action('wp_footer', 'add_google_analytics');
function add_google_analytics() { ?>
    <script>(function(G,o,O,g,l){G.GoogleAnalyticsObject=O;G[O]||(G[O]=function(){(G[O].q=G[O].q||[]).push(arguments)});G[O].l=+new Date;g=o.createElement('script'),l=o.scripts[0];g.src='//www.google-analytics.com/analytics.js';l.parentNode.insertBefore(g,l)}(this,document,'ga'));ga('create','UA-3217267-26');ga('send','pageview')</script>
<?php } ?>
