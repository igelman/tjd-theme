<?php
/**
* Tool to generate query: http://generatewp.com/wp_query/
*
* Dependency: ACF, especially get_field()
*  http://www.advancedcustomfields.com/resources/functions/get_field/
* http://old.support.advancedcustomfields.com/discussion/5760/listing-events-posts-with-custom-fields
*/

$endDateObj = new DateTime('next month');
$endDate = $endDateObj->format('Ymd');
$today = date('Ymd');
$meta_query_args = array(
	'relation' => 'AND', // Optional, defaults to "AND"
	array(
		'key'     => 'post_expiration',
		'value'   => $today, //"20131022",
		'compare' => '>='
	),
	array(
		'key'     => 'post_expiration',
		'value'   => $endDate,
		'compare' => '<='
	),
);

$args = array (
	'post_type'		=> 'tmt-deal-posts',
	'meta_query'	=> $meta_query_args,
);
$query = new WP_Query( $args );

// The Loop
$content = "<div>today: $today</div><div>endDate: $endDate</div>";
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		
		$id = get_the_ID();
		$url = get_post_meta( $id, 'merchant', true );
		$postExpiration = get_post_meta( $id, 'post_expiration', true );
		
		$imgClass = "img-thumbnail img-responsive pull-left";
		$imgAttr = array(
			'class' => $imgClass,
		);
		$mainImgTag = get_the_post_thumbnail($id, 'medium', $imgAttr);
		
		$caption = get_the_content();
		
		$itemDiv = "<div class='deal-row row'>";
		$itemDiv .= makeAnchor($url, $mainImgTag);
		$itemDiv .= $caption;
		$itemDiv .= "<div>Post Expiration: " . $postExpiration . "</div>";
		$itemDiv .= "</div> <!-- .deal-row .row -->";
		
		$content .= $itemDiv;
	}
}

echo $content;
// Restore original Post Data
wp_reset_postdata();


?>

