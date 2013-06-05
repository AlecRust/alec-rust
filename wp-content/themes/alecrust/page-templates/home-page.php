<?php
/**
 * Template Name: Home Page
 *
 * Description: Home Page template
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <article class="hero-unit">
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
        <p class="view-more"><a href="<?php echo site_url('/blog/'); ?>">View more posts</a></p>
    </section>

    <section class="module module-thumbs">
        <h1><a href="<?php echo site_url('/work/'); ?>">Companies I&rsquo;ve worked with</a></h1>
        <ul>
            <li><a href="<?php echo site_url('/work/unicef/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/temp/company-thumb-unicef.png" width="120" height="60" alt="Unicef"></a></li>
            <li><a href="<?php echo site_url('/work/bbc/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/temp/company-thumb-bbc.png" width="120" height="60" alt="BBC"></a></li>
            <li><a href="<?php echo site_url('/work/apple/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/temp/company-thumb-apple.png" width="120" height="60" alt="Apple"></a></li>
            <li><a href="<?php echo site_url('/work/disney/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/temp/company-thumb-disney.png" width="120" height="60" alt="Disney"></a></li>
            <li><a href="<?php echo site_url('/work/bbc-worldwide/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/temp/company-thumb-bbc-worldwide.png" width="120" height="60" alt="BBC Worldwide"></a></li>
        </ul>
        <p class="view-more"><a href="<?php echo site_url('/work/'); ?>">View my work</a></p>
    </section>

    <section class="module module-activity">
        <h1><a href="https://github.com/AlecRust">Recent GitHub activity</a></h1>
        <?php
            include_once(ABSPATH . WPINC . '/feed.php');
            $github_rss = fetch_feed('https://github.com/AlecRust.atom');
            $github_maxitems = $github_rss->get_item_quantity(3);
            $github_rss_items = $github_rss->get_items(0, $github_maxitems);
        ?>
        <?php if ($github_maxitems == 0) echo '<p class="alert">No activity to display.</p>'; ?>
        <ul>
        <?php
            if (!$github_maxitems == 0)
            foreach ( $github_rss_items as $item ) : ?>
                <li>
                    <a href="<?php echo $item->get_permalink(); ?>">
                        <?php echo $item->get_title(); ?>
                        <time datetime="<?php echo $item->get_local_date('%Y-%m-%d %H:%M'); ?>" class="timestamp">
                            <?php echo $item->get_local_date('%A %d %b %H:%M'); ?>
                        </time>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="view-more"><a href="https://github.com/AlecRust">View my GitHub profile</a></p>
    </section>

    <section class="module module-tweets">
        <h1><a href="https://twitter.com/AlecRust"><?php _e( 'Recent tweets' ); ?></a></h1>
        <?php
            include_once(ABSPATH . WPINC . '/feed.php');
            $twitter_rss = fetch_feed('https://api.twitter.com/1/statuses/user_timeline.rss?screen_name=AlecRust');
            $twitter_maxitems = $twitter_rss->get_item_quantity(3);
            $twitter_rss_items = $twitter_rss->get_items(0, $twitter_maxitems);
        ?>
        <?php if ($twitter_maxitems == 0) echo '<p class="alert">No tweets to display.</p>'; ?>
        <ul>
        <?php
            if (!$twitter_maxitems == 0)
            foreach ( $twitter_rss_items as $item ) : ?>
                <li>
                    <a href="<?php echo $item->get_permalink(); ?>">
                        <?php echo $item->get_title(); ?>
                        <time datetime="<?php echo $item->get_local_date('%Y-%m-%d %H:%M'); ?>" class="timestamp">
                            <?php echo $item->get_local_date('%A %d %b %H:%M'); ?>
                        </time>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="view-more"><a href="https://twitter.com/AlecRust"><?php _e( 'View my Twitter profile' ); ?></a></p>
    </section>

<?php get_footer(); ?>
