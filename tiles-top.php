<?php
/**
* Tool to generate query: http://generatewp.com/wp_query/
*
* Dependency: ACF, especially get_field()
*  http://www.advancedcustomfields.com/resources/functions/get_field/
*/


$args = array (
	'post_type'              => 'tmt-deal-posts',
	'category_name'          => 'tiles',
);
$query = new WP_Query( $args );

// The Loop
$content = "";
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		
		$id = get_the_ID();
		$url = get_post_meta( $id, 'merchant', true );
		
		$imgClass = "img-thumbnail img-responsive";
		$imgAttr = array(
			'class' => $imgClass,
		);
		$mainImgTag = get_the_post_thumbnail($id, 'thumbnail', $imgAttr);
		
		$logoImage = get_field('logo_image');
		$logoImgTag = "<img src=" . $logoImage['url'] . " class='" . $imgClass . "'>";
		$caption = get_the_content();
		
		$itemDiv = "<div class='tile col-md-3'>";
		$itemDiv .= "<div class='tile-image'>";
		$itemDiv .= makeAnchor($url, $mainImgTag);
		$itemDiv .= "</div> <!-- .tile-image -->";
		$itemDiv .= "<div class='tile-logo'>";
		$itemDiv .= makeAnchor($url, $logoImgTag);
		$itemDiv .= "</div> <!-- .tile-logo -->";
		$itemDiv .= "<div class='tile-caption'>";
		$itemDiv .= $caption;
		$itemDiv .= "</div> <!-- .tile-caption -->";
		$itemDiv .= "</div> <!-- .tile -->";
		
		$content .= $itemDiv;
	}
}

echo $content;
// Restore original Post Data
wp_reset_postdata();


?>

