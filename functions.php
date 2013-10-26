<?php

//require_once ( bloginfo('template_directory') . "classes/date-handler-class.php" );
/*
* static boolean dateInPeriod($date, $startDate, $endDate)
*/

$html5Args = array( 
	'comment-list',
	'comment-form',
	'search-form' 
);
add_theme_support( 'html5', $html5Args );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 300, false );

// http://codex.wordpress.org/TinyMCE_Custom_Styles#Enabling_styleselect
// Callback function to insert 'styleselect' into the $buttons array
// function my_mce_buttons_2( $buttons ) {
// 	array_unshift( $buttons, 'styleselect' );
// 	return $buttons;
// }
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

function getFutureDate($start='today', $interval='1 week') {
	return date_add( date_create($start), date_interval_create_from_date_string($interval) );
}

function composeTaxonomyQueryArg($terms) {
	if ($terms) {
		$term = $terms->slug;
		$taxonomy = $terms->taxonomy;// 'product_type';
		return array(
			'relation'	=> 'AND',
			array(
				'taxonomy'	=> $taxonomy,
				'field'		=> 'slug',
				'terms'		=>	$terms,
			),
		);
	}
	return array();
}

function makeAnchor($url, $innerText, $attributeArray=array()) {
	$attributes = "";
	foreach($attributeArray as $attribute => $value) {
		$attributes .= "$attribute='$value' ";
	}
	return "<a href='$url' $attributes>$innerText</a>";
}

function getPostFields($postId) {
	$post = get_post( $postId, "OBJECT", "raw" ); // filter should probably sanitize ...
	$content = $post->content;
	$url = get_post_meta( $postId, 'merchant', true );
	$logoImage = get_field('logo_image', $postId);
}


?>