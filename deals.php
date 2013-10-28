<?php
/**
* Tool to generate query: http://generatewp.com/wp_query/
*
* Dependency: ACF, especially get_field()
*  http://www.advancedcustomfields.com/resources/functions/get_field/
*/
//$queried_object = get_queried_object(); print_r( $queried_object );
$taxonomy = "product_type";
$before = "<div class='product-types'>";
$sep = " | ";
$after = "</div>";

$args = array (
	'post_type'              => 'tmt-deal-posts',
);
$query = new WP_Query( $args );
// The Loop
$content = "";
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		
		$id = get_the_ID();
		$url = get_post_meta( $id, 'merchant', true );
		
		$imgClass = "img-thumbnail img-responsive pull-left";
		$imgAttr = array(
			'class' => $imgClass,
		);
		$mainImgTag = get_the_post_thumbnail($id, 'medium', $imgAttr);
		
		$caption = get_the_content();
		
		$itemDiv = "<div class='deal-row row'>";
		$itemDiv .= makeAnchor($url, $mainImgTag);
		$itemDiv .= $caption;
		$itemDiv .= get_the_term_list( $id, $taxonomy, $before, $sep, $after );
		$itemDiv .= "</div> <!-- .deal-row .row -->";
		
		$content .= $itemDiv;
	}
}

echo $content;
// Restore original Post Data
wp_reset_postdata();


?>

