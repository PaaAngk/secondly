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
      <?php the_title() ?>
    </h2>
    <div class="postcontentmeta"> <i class="fa fa-calendar"></i>
      <?php the_time( 'F j, Y' ) ?>
      <i class="fa fa-comment"></i>
      <?php comments_popup_link( esc_html__( 'Leave a comment', 'framer' ), esc_html__( '1 Comment', 'framer' ), esc_html__( '% Comments', 'framer' ) ); ?>
      <i class="fa fa-folder-open"></i>
      <?php the_category( ', ' ) ?>
    </div>
    <div class="herobuttons">
      <?php the_tags( esc_html__( '', 'framer' ), ' ', '' ); ?>
    </div>
  </div>
  <!-- End Wrapper --> 
</div>
<!-- End Hero --> 