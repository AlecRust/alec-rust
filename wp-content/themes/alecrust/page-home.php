<?php
/**
 * The template for displaying the Home page
 *
 * @package WordPress
 * @subpackage Alec_Rust
 * @since Alec Rust 1.0
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
            <li>
                <a href="#" class="hero">
                    <dl>
                        <dt class="hero-title">Rebel CMS</dt>
                        <dd class="hero-description">Open-source ASP.NET CMS</dd>
                        <dd class="hero-thumb"><img src="images/temp/project-thumb-rebel-cms.png" width="60" height="60" alt="Rebel CMS"></dd>
                    </dl>
                </a>
            </li>
            <li>
                <a href="#" class="hero">
                    <dl>
                        <dt class="hero-title">Rusty Rambles</dt>
                        <dd class="hero-description">Ramblings from an Island life</dd>
                        <dd class="hero-thumb"><img src="images/temp/project-thumb-rusty-rambles.png" width="60" height="60" alt="Rusty Rambles"></dd>
                    </dl>
                </a>
            </li>
            <li>
                <a href="#" class="hero">
                    <dl>
                        <dt class="hero-title">Magentapink</dt>
                        <dd class="hero-description">Interior furnishing and sourcing</dd>
                        <dd class="hero-thumb"><img src="images/temp/project-thumb-magentapink.png" width="60" height="60" alt="Magentapink"></dd>
                    </dl>
                </a>
            </li>
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
            <li><a href="#"><img src="images/temp/company-thumb-universal-music.png" width="120" height="60" alt="Universal Music"></a></li>
            <li><a href="#"><img src="images/temp/company-thumb-bbc.png" width="120" height="60" alt="BBC"></a></li>
            <li><a href="#"><img src="images/temp/company-thumb-apple.png" width="120" height="60" alt="Apple"></a></li>
            <li><a href="#"><img src="images/temp/company-thumb-disney.png" width="120" height="60" alt="Disney"></a></li>
            <li><a href="#"><img src="images/temp/company-thumb-bbc-worldwide.png" width="120" height="60" alt="BBC Worldwide"></a></li>
        </ul>
        <p class="view-more"><a href="/work/">See my work</a></p>
    </section>

    <section class="module module-activity">
        <h1>Recent GitHub activity</h1>
        <ul id="github-activity"></ul>
    </section>

    <section class="module module-tweets">
        <h1>Recent tweets</h1>
        <ul>
            <li><a href="#">@rustyrambles</a> just because: <a href="#">http://reddit.com/r/pics/comm...</a> <span class="timestamp"><a href="#">2 days ago</a></span></li>
            <li>Some exciting changes over at Rusty Rambles, courtesy of <a href="#">@alecrust</a>: <a href="#">http://www.rustyrambles.com/</a> <span class="timestamp"><a href="#">2 days ago</a></span></li>
        </ul>
    </section>

<?php get_footer(); ?>
