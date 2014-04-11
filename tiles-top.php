<?php
/**
* Tool to generate query: http://generatewp.com/wp_query/
*
* Dependency: ACF, especially get_field()
*  http://www.advancedcustomfields.com/resources/functions/get_field/
*/

$extraArgs = array(
	'category_name'	=> 'tiles',
);
$query = createQuery($wp_query, 'tmt-deal-posts', $extraArgs);

// The Loop
$content = "";

// $content .= "taxonomyTerms: <PRE>" . print_r($taxonomyTerms, TRUE) . "</PRE>";
// $content .= "composeTaxnomyQueryArg: <PRE>" . print_r(composeTaxonomyQueryArg($taxonomyTerms), TRUE) . "</PRE>";
// $content .= "args: <PRE>" . print_r($args, TRUE) . "</PRE>";

$maxTiles = 4;
$tilesCount = 0;
if ( $query->have_posts() ) {
	while ( $query->have_posts() && $tilesCount < $maxTiles) {
		$query->the_post();
		
		$id = get_the_ID();
		$url = get_post_meta( $id, 'merchant', true );
		
		$imgClass = "img-thumbnail img-responsive";
		$imgAttr = array(
			'class' => $imgClass,
		);
		//$mainImgTag = get_the_post_thumbnail($id, 'thumbnail', $imgAttr);
		$mainImgTag = "<img src='http://placehold.it/300'>";
		
		$logoImage = get_field('logo_image');
		//$logoImgTag = "<img src=" . $logoImage['url'] . " class='" . $imgClass . "'>";
		$logoImgTag = "<img src='http://placehold.it/150x50' class='" . $imgClass . "'>";
		$title = get_the_title();
		$caption = get_the_content();
		
		$itemDiv = "<div class='tile col-md-3'>";
		$itemDiv .= "<div class='tile-image'>";
		$itemDiv .= makeAnchor($url, $mainImgTag);
		$itemDiv .= "</div> <!-- .tile-image -->";
		$itemDiv .= "<div class='tile-logo thumbnail'>";
		$itemDiv .= makeAnchor($url, $logoImgTag);
		$itemDiv .= "</div> <!-- .tile-logo -->";
		$itemDiv .= "<div class='tile-title'>";
		$itemDiv .= makeAnchor($url, $title);
		$itemDiv .= "</div> <!-- .tile-title -->";
		$itemDiv .= "<div class='tile-caption'>";
		$itemDiv .= $caption;
		$itemDiv .= "</div> <!-- .tile-caption -->";
		$itemDiv .= "</div> <!-- .tile -->";
		
		$content .= $itemDiv;
		$tilesCount++;
	}
}

echo $content;
// Restore original Post Data
wp_reset_postdata();


?>

