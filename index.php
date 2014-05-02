<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * http://kovshenin.com/2013/get_template_part/
 *
 */
 
/**
 * Insert header.php
 * (which includes the <head> and opening <body>)
 * and navbar.php
 * (which calls a bunch of other files:
 * -searchform.php
 * -icontact.php
 * -menu.php
 * )
*/ 
get_header();
get_template_part( 'navbar' );
?>


<div class='content'>
	<section class='jumbotron'>
		<?php get_template_part( 'tiles', 'top') ?>
	</section><!-- section.jumbotron -->
	
	<section class='content-well'>
		<h1>Latest Deals</h1>
		<?php get_template_part( 'deals') ?>
	</section>
	
	<section class='listings'>
		<?php get_template_part( 'listing') ?>
	</section>
	
	<aside class='rail'>
		<?php get_template_part( 'expiring') ?>
	</aside>
</div> <!-- div.content -->


<?php get_footer(); ?>