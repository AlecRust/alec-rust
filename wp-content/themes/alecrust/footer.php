<?php
/**
 * Template for displaying the footer
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */
?>
        </main>

        <?php if (is_single() ) { ?>
        <nav class="post-navigation">
            <h1 class="visuallyhidden">Post Navigation</h1>
            <ul>
                <li class="prev"><?php previous_post_link('%link', '%title', 'in_same_cat'); ?></li>
                <li class="next"><?php next_post_link('%link', '%title', 'in_same_cat'); ?></li>
            </ul>
        </nav>
        <?php } ?>

        <aside class="global-social-links" role="complementary">
            <h1 class="visuallyhidden">Social Links</h1>
            <ul>
                <li class="github"><a href="https://github.com/AlecRust" title="GitHub">GitHub</a></li>
                <li class="twitter"><a href="https://twitter.com/AlecRust" title="Twitter">Twitter</a></li>
                <li class="linkedin"><a href="http://uk.linkedin.com/in/alecrust/" title="LinkedIn">LinkedIn</a></li>
                <li class="quora"><a href="http://www.quora.com/Alec-Rust" title="Quora">Quora</a></li>
                <li class="facebook"><a href="http://www.facebook.com/alec.rust" title="Facebook">Facebook</a></li>
                <li class="lastfm"><a href="http://www.last.fm/user/ace5p1d0r" title="Last.fm">Last.fm</a></li>
                <li class="email"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Email">Email</a></li>
            </ul>
        </aside>

        <footer class="global-footer" role="contentinfo">
            <p>Copyright <time datetime="<?= date('Y'); ?>"><?= date('Y'); ?></time> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Alec Rust</a></p>
        </footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-2.0.0.min.js"><\/script>')</script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/main.min.js"></script>

        <?php wp_reset_query(); ?>

        <?php if (is_page('home') ) { ?>
        <script src="<?php echo get_template_directory_uri(); ?>/js/cycle-text.min.js"></script>
        <script>
            // Cycle intro text at @tabletLandscape and up
            var mq = window.matchMedia('(min-width: 1024px)');
            if (mq.matches) {
                $('.hero-unit h1 span').cycle([
                    ' specialise in Responsive Web Design and modern web technologies.',
                    ' have industry experience building large-scale websites.',
                    ' have worked with many of the leading tech companies.',
                    '’ve spent the last decade building awesome things on the Internet.'
                ]);
            }
        </script>
        <?php } ?>

        <?php if (is_single() ) { ?>
        <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=desert"></script>
        <?php } ?>

        <?php wp_footer(); ?>

    </body>
</html>
