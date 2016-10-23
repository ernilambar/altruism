<?php
/**
 * The main theme file template.
 *
 * @package Altruism
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body>
		<header id="masthead" class="site-header">
			<div class="container">
				<h1 class="site-title">
					<a id="branding" href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
				</h1>
			</div><!-- .container -->
		</header><!-- #masthead -->
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_id'        => 'primary-menu',
			'fallback_cb'    => false,
			'depth'          => 1,
		) );
		?>

		<div id="wrapper">
			<div id="js-data" class="container" aria-live="assertive">
				<!-- Our collection and single view data will be appended here -->
			</div>
		</div>
		<footer id="colophon" class="site-footer">
			<div class="container">
				<div class="copyright"><?php esc_html_e( 'Copyright &copy; All rights reserved.', 'altruism' ) ?></a></div>
			</div><!-- .container -->
		</footer><!-- #colophon -->
		<?php wp_footer(); ?>
	</body>
</html>
