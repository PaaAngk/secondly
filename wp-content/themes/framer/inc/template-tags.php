<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package framer
 */

if ( !function_exists( 'framer_the_posts_navigation' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function framer_the_posts_navigation()
	{
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation posts-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'framer' ); ?></h2>

			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'framer' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'framer' ) ); ?></div>
				<?php endif; ?>

			</div>
			<!-- .nav-links -->
		</nav><!-- .navigation -->
	<?php
	}
endif;

if ( !function_exists( 'framer_the_post_navigation' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function framer_the_post_navigation()
	{
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( !$next && !$previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'framer' ); ?></h2>

			<div class="nav-links">
				<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
				?>
			</div>
			<!-- .nav-links -->
		</nav><!-- .navigation -->
	<?php
	}
endif;

if ( !function_exists( 'framer_the_archive_title' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after Optional. Content to append to the title. Default empty.
	 */
	function framer_the_archive_title( $before = '', $after = '' )
	{
		if ( is_category() ) {
			$title = sprintf( esc_html__( 'Category: %s', 'framer' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( esc_html__( 'Tag: %s', 'framer' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( esc_html__( 'Author: %s', 'framer' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( esc_html__( 'Year: %s', 'framer' ), get_the_date( _x( 'Y', 'yearly archives date format', 'framer' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( esc_html__( 'Month: %s', 'framer' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'framer' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( esc_html__( 'Day: %s', 'framer' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'framer' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'framer' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'framer' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'framer' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'framer' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'framer' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'framer' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'framer' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'framer' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'framer' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( esc_html__( 'Archives: %s', 'framer' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s: %2$s', 'framer' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = esc_html__( 'Archives', 'framer' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( !empty( $title ) ) {
			echo $before . $title . $after;
		}
	}
endif;

if ( !function_exists( 'framer_the_archive_description' ) ) :
	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after Optional. Content to append to the description. Default empty.
	 */
	function framer_the_archive_description( $before = '', $after = '' )
	{
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( !empty( $description ) ) {
			/**
			 * Filter the archive description.
			 *
			 * @see term_description()
			 *
			 * @param string $description Archive description to be displayed.
			 */
			echo $before . $description . $after;
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function framer_categorized_blog()
{
	if ( false === ( $all_the_cool_cats = get_transient( 'framer_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'framer_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so framer_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so framer_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in framer_categorized_blog.
 */
function framer_category_transient_flusher()
{
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'framer_categories' );
}

add_action( 'edit_category', 'framer_category_transient_flusher' );
add_action( 'save_post', 'framer_category_transient_flusher' );
