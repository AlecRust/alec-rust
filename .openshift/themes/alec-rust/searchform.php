<?php
/**
 * Template for displaying search forms
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */
?>
  <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <h1 class="visuallyhidden">Search</h1>
    <label for="s" class="visuallyhidden">Search</label>
    <input type="search" name="s" id="s" class="global-search-input" placeholder="<?php esc_attr_e( 'Search&hellip;' ); ?>" required>
    <button type="submit" name="submit" class="global-search-button"><?php esc_attr_e( 'Go' ); ?></button>
  </form>
