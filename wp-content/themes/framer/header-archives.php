<?php
/**
 * @Theme: framer
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="format-detection" content="telephone=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="hero">
  <div class="hero-bg"></div>
  <?php
	$framer_hero_overlay_enabled = get_theme_mod( 'framer_hero_overlay_enabled', 'yes' );
	$hidden = '';
	if ( $framer_hero_overlay_enabled === 'no' ) {
		$hidden = 'hidden';
	}
	echo '<div class="hero-overlay ' . $hidden . '"></div>';
	?>
  <div class="wrapper">
    <header class="clearfix">
      <div class="wrapper">
        <div id="site-branding">
          <?php the_custom_logo(); ?>
          <?php if ( function_exists( 'jetpack_the_site_logo' ) && has_site_logo() ) : ?>
          <?php jetpack_the_site_logo(); ?>
          <?php endif; ?>
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php bloginfo( 'name' ); ?>
            </a></h1>
          <h2 class="site-description">
            <?php bloginfo( 'description' ); ?>
          </h2>
        </div>
        <nav id="primary-navigation" class="main-navigation clearfix" role="navigation">
          <div class="col-width">
            <div class="menu-toggle" data-toggle="#primary-navigation .primary-menu, #primary-navigation .social-menu"> </div>
            <?php if ( has_nav_menu( 'primary' ) ):
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container_class' => 'primary-menu-wrap',
							'menu_class' => 'primary-menu',
							'link_before' => '<span>',
							'link_after' => '</span>'
						) );
					endif; ?>
          </div>
        </nav>
      </div>
      <!-- End Wrapper --> 
      
    </header>
    <h2>
      <?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( esc_html__( 'Author: %s', 'framer' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( esc_html__( 'Day: %s', 'framer' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( esc_html__( 'Month: %s', 'framer' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'framer' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( esc_html__( 'Year: %s', 'framer' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'framer' ) ) . '</span>' );
						else :
							esc_html_e( 'Archives', 'framer' );

						endif;
						?>
    </h2>
    <?php
					// Show an optional term description.
					$term_description = term_description();
					if ( !empty( $term_description ) ) :
						printf( '<p class="herotext"%s</p>', $term_description );
					endif;
					?>
  </div>
  <!-- End Wrapper --> 
</div>
<!-- End Hero --> 