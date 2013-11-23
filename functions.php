<?php
$html5Args = array( 
	'comment-list',
	'comment-form',
	'search-form' 
);
add_theme_support( 'html5', $html5Args );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 300, false );

// Register Navigation Menus
function custom_navigation_menus() {
	$locations = array(
		'main_nav' => __( 'Main Navigation Menu', 'text_domain' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'custom_navigation_menus' );

// Register widget areas
$navbarWidgetArgs = array(
	'name'          => __( 'Navbar Widgets', 'text_domain' ),
	'id'            => 'navbar-widgets',
	'description'   => 'Widget aread for main nav',
    'class'         => 'navbar-widget',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '',
	'after_title'   => '' );
register_sidebar( $navbarWidgetArgs );

function getFutureDate($start='today', $interval='1 week') {
	return date_add( date_create($start), date_interval_create_from_date_string( $interval ) );
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

function createQuery($wp_query, $postType, $extraArgs=array()) {
	$taxonomyTerms = getTaxonomyTerms($wp_query);
	
	$args = composeQueryArg($postType, $taxonomyTerms, $extraArgs);
	$query = new WP_Query($args);
	return $query;
}

/**
* Returns value tax_query for WP_Query args.
* Restricts WP_Query results to selected taxonomy.
*/
function composeTaxonomyQueryArg($terms) {
	if ($terms) {
		$term = $terms->slug;
		$taxonomy = $terms->taxonomy;
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

function composeQueryArg($postType, $taxonomyTerms, $extraArgs=array()) {
	return array_merge ( array (
		'post_type'		=> $postType, //'tmt-deal-posts',
		'tax_query'		=> composeTaxonomyQueryArg($taxonomyTerms),
	), $extraArgs );
}

function getTaxonomyTerms($wp_query) {
	$field = 'slug';
	$value = $wp_query->get('term');
	$taxonomy = $wp_query->get('taxonomy');
	return get_term_by( $field, $value, $taxonomy );

}

?>