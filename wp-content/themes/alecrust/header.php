<?php
/**
 * Template for displaying the header
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */
?><!DOCTYPE html>
<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/html5shiv.min.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <?php if(is_page()) { $page_slug = 'page-'.$post->post_name; } ?>
    <body <?php body_class($page_slug); ?>>

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="wrap">

            <header class="global-header" role="banner">
                <h1 class="global-header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Alec Rust Home" rel="home"><span>A</span>lec Rust</a></h1>
                <h2 class="global-header-tagline"><?php bloginfo( 'description' ); ?></h2>
            </header>

            <section class="global-search" role="search">
                <p class="show-search">
                    <a href="#"><?php _e( 'Show Search' ); ?></a>
                </p>
                <?php get_search_form(); ?>
            </section>

            <nav class="global-navigation">
                <h1 class="visuallyhidden"><?php _e( 'Main Navigation' ); ?></h1>
                <p class="show-navigation">
                    <a href="#"><?php _e( 'Show Navigation' ); ?></a>
                </p>
                <?php wp_nav_menu( array(
                    'theme_location'  => 'primary-menu',
                    'menu'            => 'primary-menu',
                    'container'       => false,
                    'items_wrap'      => '<ul>%3$s</ul>'
                ) ); ?>
            </nav>

            <main class="global-content" role="main">

