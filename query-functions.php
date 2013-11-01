<?php
function createQuery($wp_query, $extraArgs=array()) {
	$taxonomyTerms = getTaxonomyTerms($wp_query);
	
	$args = composeQueryArg($taxonomyTerms, $extraArgs);
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

function composeQueryArg($taxonomyTerms, $extraArgs=array()) {
	return array_merge ( array (
		'post_type'		=> 'tmt-deal-posts',
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