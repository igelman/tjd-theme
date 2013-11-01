<?php
/**
* Tool to generate query: http://generatewp.com/wp_query/
*
* Dependency: ACF, especially get_field()
*  http://www.advancedcustomfields.com/resources/functions/get_field/
*/

// taxonomy list settings
$before = "<div class='product-types'>";
$sep = " | ";
$after = "</div>";

$query = createQuery($wp_query);

// The Loop
$content = "";
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		
		$id = get_the_ID();
		$url = get_post_meta( $id, 'url', true );
		$merchant = get_the_term_list( $id, "merchant", $before, $sep, $after ); //get_post_meta( $id, 'merchant', true );
		
		$imgClass = "img-thumbnail img-responsive pull-left";
		$imgAttr = array(
			'class' => $imgClass,
		);
		$mainImgTag = get_the_post_thumbnail($id, 'medium', $imgAttr);
		
		$caption = get_the_content();
		$title = get_the_title();
		
		$itemDiv = "<div class='deal-row row'>";
		$itemDiv .= makeAnchor($url, $mainImgTag);
		$itemDiv .= "<div class='title'>" . makeAnchor($url, $title) . "</div>";
		$itemDiv .= "<div class='caption'>$caption</div>";
		$itemDiv .= "<div class='merchant'>$merchant</div>";
		$itemDiv .= get_the_term_list( $id, "product_type", $before, $sep, $after );
		$itemDiv .= "</div> <!-- .deal-row .row -->";
		
		$content .= $itemDiv;
	}
}

echo $content;
// Restore original Post Data
wp_reset_postdata();


?>

