<?php
/**
 * Template for displaying the footer
 *
 * @package alec-rust
 */
?>
    </main>

    <?php if ( is_single() && !is_attachment() ) {
      $all_term_ids = get_terms( 'category', array( 'fields' => 'ids' ) );
      $post_terms = get_the_terms( get_the_ID(), 'category' );
      $post_terms = wp_list_pluck( $post_terms, 'term_id' );
      $parent_post_terms = get_parent_terms();
      $child_terms = array_diff( $post_terms, $parent_post_terms );
      // Exclude terms not associated with post, or that have a child who do
      $exclude_these = array_diff( $all_term_ids, $child_terms );
    ?>
    <nav class="post-navigation" role="navigation">
      <h1 class="visuallyhidden">Post Navigation</h1>
      <ul>
        <li class="prev"><?php previous_post_link( '%link', '%title', false, $exclude_these ); ?></li>
        <li class="next"><?php next_post_link( '%link', '%title', false, $exclude_these ); ?></li>
      </ul>
    </nav>

    <? } elseif ( is_archive() ) { ?>
      <?php alecrust_content_nav( 'nav-below' ); ?>
    <?php } ?>

    <?php // Widgets sidebar on Blog posts ?>
    <?php if ( is_single() && in_category( 'Blog' ) ) { ?>
      <?php dynamic_sidebar( 'Blog Sidebar' ); ?>
    <?php } ?>

    <aside class="global-social-links">
      <h1 class="visuallyhidden">Social Links</h1>
      <ul>
        <li class="github"><a href="https://github.com/AlecRust" title="GitHub">GitHub</a></li>
        <li class="twitter"><a href="https://twitter.com/AlecRust" title="Twitter">Twitter</a></li>
        <li class="linkedin"><a href="https://www.linkedin.com/in/alecrust/" title="LinkedIn">LinkedIn</a></li>
        <li class="googleplus"><a href="https://plus.google.com/+AlecRust" title="Google+">Google+</a></li>
        <li class="quora"><a href="https://www.quora.com/profile/Alec-Rust" title="Quora">Quora</a></li>
        <li class="facebook"><a href="https://www.facebook.com/alecrust" title="Facebook">Facebook</a></li>
        <li class="lastfm"><a href="http://www.last.fm/user/ace5p1d0r" title="Last.fm">Last.fm</a></li>
        <li class="email"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Email">Email</a></li>
      </ul>
    </aside>

    <footer class="global-footer">
      <p>
        Copyright <time datetime="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></time>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Alec Rust</a>
      </p>
    </footer>

    <?php wp_reset_query(); ?>
    <?php wp_footer(); ?>

    <?php if ( is_page('home') ) { ?>
      <script>
        (function ($) {
          // Cycle intro text at @tabletLandscape and up
          var mq = window.matchMedia('(min-width: 1024px)');
          if (mq.matches) {
            $('.jumbotron h1 span').cycle([
              ' specialise in Responsive Web Design and modern web technologies.',
              ' have industry experience building large-scale websites.',
              ' have worked with many of the leading tech companies.',
              '’ve spent over a decade building awesome things on the Internet.'
            ]);
          }
        }(jQuery));
      </script>
    <?php } ?>

    <?php if ( is_single() ) { ?>
      <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=desert"></script>
    <?php } ?>

  </body>
</html>
