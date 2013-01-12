<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Alec_Rust
 * @since Alec Rust 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'alecrust' ), 'after' => '</div>' ) ); ?>
		</div>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'alecrust' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>

	</article>
