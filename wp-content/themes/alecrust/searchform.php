<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */
?>
    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform">
        <h1 class="visuallyhidden"><?php _e( 'Search' ); ?></h1>
        <label for="s" class="visuallyhidden"><?php _e( 'Search' ); ?></label>
        <input type="search" name="s" id="s" class="global-search-input" placeholder="<?php esc_attr_e( 'Search&hellip;' ); ?>" required>
        <button type="submit" name="submit" id="searchsubmit" class="global-search-button"><?php esc_attr_e( 'Go' ); ?></button>
    </form>
