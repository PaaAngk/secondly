<?php
/**
 * The template part for displaying sub features section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package framer
 */

?>
<?php 
//Title
$framer_latest_title_l = get_theme_mod( 'framer_latest_title_l' );
//Sub Texts
$framer_latest_text_l = get_theme_mod( 'framer_latest_text_l' );
?>
<div id="introarea">
<div class="wrapper">
<div class="row">

	<h2 class="introtitle"><?php echo $framer_latest_title_l; ?></h2>
    <p class="introtext"><?php echo $framer_latest_text_l; ?></p>

 </div><!-- End row -->
</div><!-- End  wrapper -->
</div><!-- End introarea -->