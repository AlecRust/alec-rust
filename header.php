<?php
/**
 * Template for displaying the header
 *
 * @package alec-rust
 */
?><!doctype html>
<html lang="en-GB">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/favicon.ico'; ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
  </head>
  <?php if(is_page()) { $page_slug = 'page-'.$post->post_name; } ?>
  <body <?php if (is_page()) body_class($page_slug); ?>>

    <!--[if lt IE 9]>
      <p class="browsehappy">
        You're using an outdated browser that I choose not to support.
        <a href="http://browsehappy.com/">Upgrade your browser</a> to improve your experience.
      </p>
    <![endif]-->

    <header class="global-header">
      <h1 class="global-header-logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Alec Rust Home" rel="home">
          <span>A</span>lec Rust
        </a>
      </h1>
      <p class="global-header-tagline"><?php bloginfo( 'description' ); ?></p>
    </header>

    <section class="global-search" role="search">
      <p class="show-search">
        <a href="#">Show Search</a>
      </p>
      <?php get_search_form(); ?>
    </section>

    <nav class="global-navigation">
      <h1 class="visuallyhidden">Main Navigation</h1>
      <p class="show-navigation">
        <a href="#">Show Navigation</a>
      </p>
      <?php wp_nav_menu( array(
        'theme_location'  => 'primary-menu',
        'menu'            => 'primary-menu',
        'container'       => false,
        'items_wrap'      => '<ul>%3$s</ul>'
      ) ); ?>
    </nav>

    <main class="global-content">
