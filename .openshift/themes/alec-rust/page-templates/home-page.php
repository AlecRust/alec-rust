<?php
/**
 * Template Name: Home Page
 *
 * Description: Home Page template
 *
 * @package alec-rust
 */

get_header(); ?>

  <article class="jumbotron">
    <h1>I&rsquo;m Alec, and I<span>&rsquo;ve spent the last decade building awesome things on the Internet.</span></h1>
    <ul>
      <li class="about"><a href="<?php echo site_url('/about/'); ?>">More about me</a></li>
      <li class="work"><a href="<?php echo site_url('/work/'); ?>">Some of my work</a></li>
    </ul>
  </article>

  <section class="module module-heros">
    <h1><a href="<?php echo site_url('/work/'); ?>">Recent work</a>/<a href="<?php echo site_url('/projects/'); ?>">projects</a></h1>
    <ul>
    <?php query_posts('category_name=work,projects&showposts=3'); ?>
    <?php while (have_posts()) : the_post(); ?>
      <li>
        <a href="<?php the_permalink(); ?>" class="hero">
          <dl>
            <?php if ( has_excerpt() ) : ?>
            <dt class="hero-title"><?php the_title(); ?></dt>
            <?php else : ?>
            <dt class="hero-title no-desc"><?php the_title(); ?></dt>
            <?php endif; ?>
            <?php if ( has_excerpt() ) : ?>
            <dd class="hero-description"><?php echo get_the_excerpt(); ?></dd>
            <?php endif; ?>
            <dd class="hero-thumb"><?php the_post_thumbnail( array(60,60) ); ?></dd>
          </dl>
        </a>
      </li>
    <?php endwhile; ?>
    </ul>
    <p class="view-more"><a href="<?php echo site_url('/work/'); ?>">View my work</a></p>
  </section>

  <section class="module module-list">
    <h1><a href="<?php echo site_url('/blog/'); ?>">Recent blog posts</a></h1>
    <ul>
    <?php query_posts('category_name=blog&showposts=7'); ?>
    <?php while (have_posts()) : the_post(); ?>
      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile; ?>
    </ul>
    <p class="view-more"><a href="<?php echo site_url('/blog/'); ?>">View all posts</a></p>
  </section>

  <section class="module module-thumbs">
    <h1><a href="<?php echo site_url('/work/'); ?>">Companies I&rsquo;ve worked with</a></h1>
    <ul>
      <li><a href="<?php echo site_url('/work/universal-music/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/temp/company-thumb-universal-music.png" width="120" height="60" alt="Universal Music"></a></li>
      <li><a href="<?php echo site_url('/work/bbc/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/temp/company-thumb-bbc.png" width="120" height="60" alt="BBC"></a></li>
      <li><a href="<?php echo site_url('/work/apple/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/temp/company-thumb-apple.png" width="120" height="60" alt="Apple"></a></li>
      <li><a href="<?php echo site_url('/work/disney/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/temp/company-thumb-disney.png" width="120" height="60" alt="Disney"></a></li>
      <li><a href="<?php echo site_url('/work/bbc-worldwide/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/temp/company-thumb-bbc-worldwide.png" width="120" height="60" alt="BBC Worldwide"></a></li>
    </ul>
    <p class="view-more"><a href="<?php echo site_url('/work/'); ?>">View my work</a></p>
  </section>

  <?php include_once('module-github-feed.php'); ?>

  <?php dynamic_sidebar('Home Bottom Right Module'); ?>

<?php get_footer(); ?>
