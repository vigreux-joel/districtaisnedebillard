<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package districtBillardAisne
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <script src="<?=get_template_directory_uri().'/js/function.js'?>"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<header>
		<nav>
            <img src="http://districtaisnebillard.fr/wp-content/uploads/2021/10/logo-1.png" alt="logo DAB">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                )

            );
            ?>
            <div id="burger"><div></div></div>
		</nav><!-- #site-navigation -->

        <script src="<?=get_template_directory_uri().'/js/header.min.js'?>"></script>
	</header><!-- #masthead -->
