<?php
/**
 * Home page GitHub feed module
 *
 * @package alec-rust
 */
?>

<section class="module module-activity">
  <h1><a href="https://github.com/AlecRust">Recent GitHub activity</a></h1>
  <?php
    include_once(ABSPATH . WPINC . '/feed.php');
    $rss = fetch_feed('https://github.com/AlecRust.atom');
    if ( is_wp_error( $rss ) ) {
      return;
    }
    $maxitems = $rss->get_item_quantity(3);
    $rss_items = $rss->get_items(0, $maxitems);
  ?>
  <?php if ($maxitems == 0) echo '<p class="alert">No activity to display.</p>'; ?>
  <ul>
    <?php
    if (!$maxitems == 0)
      foreach ( $rss_items as $item ) : ?>
        <li>
          <?php echo $item->get_title(); ?>
          <a href="<?php echo $item->get_permalink(); ?>">
            <time datetime="<?php echo $item->get_local_date('%Y-%m-%d %H:%M'); ?>" class="timestamp">
              <?php echo $item->get_local_date('%A %d %b %H:%M'); ?>
            </time>
          </a>
        </li>
      <?php endforeach; ?>
  </ul>
  <p class="view-more"><a href="https://github.com/AlecRust">View my GitHub profile</a></p>
</section>
