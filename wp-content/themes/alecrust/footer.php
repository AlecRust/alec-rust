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
                <li class="prev"><?php previous_post_link( '%link' ); ?></li>
                <li class="next"><?php next_post_link( '%link' ); ?></li>
            </ul>
        </nav>
        <?php } ?>

        <aside class="global-social-links" role="complementary">
            <h1 class="visuallyhidden">Social Links</h1>
            <?php wp_nav_menu( array(
                'theme_location'  => 'social-menu',
                'menu'            => 'social-menu',
                'container'       => false,
                'items_wrap'      => '<ul>%3$s</ul>'
            ) ); ?>
        </aside>

        <footer class="global-footer" role="contentinfo">
            <p>Copyright <time datetime="<?= date('Y'); ?>"><?= date('Y'); ?></time> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Alec Rust</a></p>
        </footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/main.min.js"></script>

        <?php wp_reset_query(); ?>

        <?php if (is_page('home') ) { ?>
        <script src="<?php echo get_template_directory_uri(); ?>/js/cycle-text.min.js"></script>
        <script>
            // Cycle intro text at @tabletLandscape and up
            var mq = window.matchMedia('(min-width: 1024px)');
            if (mq.matches) {
                $('.home-intro h1 span').cycle([
                    ' specialise in Responsive Web Design and modern web technologies.',
                    ' have industry experience building large-scale websites.',
                    ' have worked with many of the leading tech companies.',
                    '’ve spent the last decade building awesome things on the internet.'
                ]);
            }
        </script>
        <?php } ?>

        <?php if (is_single() ) { ?>
        <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=desert"></script>
        <?php } ?>

        <?php if (is_404() ) { ?>
        <script>
            var GOOG_FIXURL_LANG = (navigator.language || '').slice(0,2),GOOG_FIXURL_SITE = location.host;
        </script>
        <script src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>
        <?php } ?>

        <?php wp_footer(); ?>

    </body>
</html>
