<?php
/**
 * The template for displaying the Home page
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */

get_header(); ?>

    <article class="home-intro">
        <h1>I'm Alec, and I<span>'ve spent the last decade building awesome things on the internet.</span></h1>
        <ul>
            <li class="about"><a href="/about/">More about me</a></li>
            <li class="work"><a href="/work/">Some of my work</a></li>
        </ul>
    </article>

    <section class="module module-heros">
        <h1>Recent work/projects</h1>
        <ul>
            <?php query_posts('category_name=work,projects&showposts=3'); ?>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>" class="hero">
                    <dl>
                        <dt class="hero-title"><?php the_title(); ?></dt>
                        <dd class="hero-description"><?php the_content( 'More', '...' ); ?></dd>
                        <dd class="hero-thumb"><?php the_post_thumbnail( 'single-post-thumbnail' ); ?></dd>
                    </dl>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>
        <p class="view-more"><a href="/work/">See my work</a></p>
    </section>

    <section class="module module-list">
        <h1>Recent blog posts</h1>
        <ul>
            <?php query_posts('category_name=blog&showposts=7'); ?>
            <?php while (have_posts()) : the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
        <p class="view-more"><a href="/blog/">See more posts</a></p>
    </section>

    <section class="module module-thumbs">
        <h1>Companies I've worked with</h1>
        <ul>
            <li><a href="/work/universal-music/"><img src="images/temp/company-thumb-universal-music.png" width="120" height="60" alt="Universal Music"></a></li>
            <li><a href="/work/bbc/"><img src="images/temp/company-thumb-bbc.png" width="120" height="60" alt="BBC"></a></li>
            <li><a href="/work/apple/"><img src="images/temp/company-thumb-apple.png" width="120" height="60" alt="Apple"></a></li>
            <li><a href="/work/disney/"><img src="images/temp/company-thumb-disney.png" width="120" height="60" alt="Disney"></a></li>
            <li><a href="/work/bbc-worldwide/"><img src="images/temp/company-thumb-bbc-worldwide.png" width="120" height="60" alt="BBC Worldwide"></a></li>
        </ul>
        <p class="view-more"><a href="/work/">See my work</a></p>
    </section>

    <section class="module module-activity">
        <h1>Recent GitHub activity</h1>
        <?php
            include_once(ABSPATH . WPINC . '/feed.php');
            $rss = fetch_feed('https://github.com/AlecRust.atom');
            $maxitems = $rss->get_item_quantity(3);
            $rss_items = $rss->get_items(0, $maxitems);
        ?>
        <ul>
        <?php if ($maxitems == 0) echo '<li>No activity to display.</li>';
        else
        foreach ( $rss_items as $item ) : ?>
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
        <h1>Recent tweets</h1>
        <?php
            include_once(ABSPATH . WPINC . '/feed.php');
            $rss = fetch_feed('https://api.twitter.com/1/statuses/user_timeline.rss?screen_name=AlecRust&count=3');
            $maxitems = $rss->get_item_quantity(3);
            $rss_items = $rss->get_items(0, $maxitems);
        ?>
        <ul>
        <?php if ($maxitems == 0) echo '<li>No tweets to display.</li>';
        else
        foreach ( $rss_items as $item ) : ?>
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
        <p class="view-more"><a href="https://twitter.com/AlecRust">View my Twitter profile</a></p>
    </section>

<?php get_footer(); ?>
