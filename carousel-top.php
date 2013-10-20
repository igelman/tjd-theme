<?php
/**
* Tool to generate query: http://generatewp.com/wp_query/
*/


$args = array (
	'post_type'              => 'tmt-deal-posts',
	/*'cat'                    => 'carousel',*/
);
$query = new WP_Query( $args );


// The Loop
$content = "";
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		
		$id = get_the_ID();
		$url = get_post_meta( $id, 'merchant', true ); //"http://localhost/post1";
		$mainImgSrc = get_the_post_thumbnail($id, 'thumbnail'); //"http://placehold.it/150x150&text=post1-150";
		$logoImgSrc = "http://placehold.it/150x50&text=post1-50";
		$caption = get_the_content(); //"Post 1 caption We the people, in order to form a more perfect union. And yet words on a parchment would not.";
		
		$itemDiv = "<div class='carousel-item'>";
		$itemDiv .= "<div class='carousel-image'>";
		$itemDiv .= makeAnchor($url, $mainImgSrc);
		$itemDiv .= "</div> <!-- .carousel-image -->";
		$itemDiv .= "<div class='carousel-logo'>";
		$itemDiv .= makeAnchor($url, "<img src=$logoImgSrc>");
		$itemDiv .= "</div> <!-- .carousel-logo -->";
		$itemDiv .= "<div class='carousel-caption'>";
		$itemDiv .= $caption;
		$itemDiv .= "</div> <!-- .carousel-caption -->";
		$itemDiv .= "</div> <!-- .carousel-item -->";
		
		$content .= $itemDiv;
	}
} else {
	// no posts found
		$content .= "No posts found";
}

	echo $content;
// Restore original Post Data
wp_reset_postdata();

?>

