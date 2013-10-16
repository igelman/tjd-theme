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

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php get_template_part( 'carousel', 'top') ?>
			<?php get_template_part( 'deals') ?>
			<?php get_template_part( 'expiring') ?>
			<?php get_template_part( 'more-deals') ?>
			<?php get_template_part( 'more-tips') ?>
			<?php get_template_part( 'carousel', 'bottom') ?>
			<?php get_template_part( 'listing') ?>

		</div><!-- #content -->
	</div><!-- #primary -->

