<?php
// Returns menu as ul
// See http://codex.wordpress.org/Function_Reference/wp_nav_menu

$menuArgs = array(
	'theme_location'  => 'main_nav', // location in the theme to be used--must be registered with register_nav_menu()
	'menu'            => '', // menu that is desired; accepts (matching in order) id, slug, name. Default: None
	'container'       => FALSE, // how to wrap the ul. Allows false or div or nav. Default: div
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'nav navbar-nav', // class that is applied to the ul element default menu
	'menu_id'         => 'main_nav_ul', // ID that is applied to the ul element  default none
	'echo'            => true, // Whether to echo the menu or return it. For returning menu use '0'Default: true
	'fallback_cb'     => FALSE, // If the menu doesn't exist, the fallback function to use. Set to false for no fallback. Note: Passes $args to the custom function. Default: wp_page_menu
	'before'          => '', // before <a>
	'after'           => '', // after <a>
	'link_before'     => '', // before <a> innertext
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => '' // Custom walker object to use (Note: You must pass an actual object to use, not a string) Default: new Walker_Nav_Menu

);

wp_nav_menu( $menuArgs );
?>