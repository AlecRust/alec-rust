<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Alec_Rust
 * @since Alec Rust 1.0
 */
?>
            </div>

            <aside class="global-social-links" role="complementary">
                <h1 class="visuallyhidden">Social Links</h1>
                <ul>
                    <li class="github"><a href="#">GitHub</a></li>
                    <li class="twitter"><a href="#">Twitter</a></li>
                    <li class="linkedin"><a href="#">LinkedIn</a></li>
                    <li class="quora"><a href="#">Quora</a></li>
                    <li class="facebook"><a href="#">Facebook</a></li>
                    <li class="lastfm"><a href="#">Last.fm</a></li>
                    <li class="email"><a href="#">Email</a></li>
                </ul>
            </aside>

        </div>

        <footer class="global-footer" role="contentinfo">
            <p>Copyright <time datetime="<?= date('Y'); ?>"><?= date('Y'); ?></time> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        </footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/plugins.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/cycle-text.js"></script>

        <script>
            // Cycle intro text at @tabletLandscape and up
            var mq = window.matchMedia('(min-width: 1024px)');
            if (mq.matches) {
                $('.home-intro h1 span').cycle([
                    ' specialise in Responsive Web Design and modern web technologies.',
                    ' have industry experience building large-scale websites.',
                    ' have worked with many of the leading tech companies.',
                    '\'ve spent a decade building awesome things on the internet.'
                ]);
            }
        </script>

        <script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

        <?php wp_footer(); ?>

    </body>
</html>
