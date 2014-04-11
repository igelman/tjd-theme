<?php
/**
* Tool to generate query: http://generatewp.com/wp_query/
*
* Dependency: ACF, especially get_field()
*  http://www.advancedcustomfields.com/resources/functions/get_field/
* http://old.support.advancedcustomfields.com/discussion/5760/listing-events-posts-with-custom-fields
*/

$endDateObj = new DateTime('next year');
$endDate = $endDateObj->format('Ymd');
$today = date('Ymd');
$meta_query_args = array(
	'relation' => 'AND', // Optional, defaults to "AND"
	array(
		'key'     => 'post_expiration',
		'value'   => $today,
		'compare' => '>='
	),
	array(
		'key'     => 'post_expiration',
		'value'   => $endDate,
		'compare' => '<='
	),
);

$extraArgs = array(
	'meta_query'	=> $meta_query_args,
);
$query = createQuery($wp_query, 'tmt-deal-posts', $extraArgs);

// The Loop
$content = "";//"<div>today: $today</div><div>endDate: $endDate</div>";
if ( $query->have_posts() ) {
	$content .= "<h2 class='expiring-soon'>More Expiring Soon
- Today & This Week -</h2>";
	$content .= "<ul>";
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
		
		$itemDiv = "<li class='deal-row row'>";
		//$itemDiv .= makeAnchor($url, $mainImgTag);
		$itemDiv .= $caption;
		$itemDiv .= "<div>Post Expiration: " . $postExpiration . "</div>";
		$itemDiv .= "</li> <!-- .deal-row .row -->";
		
		$content .= $itemDiv;
	}
}

echo $content;
// Restore original Post Data
wp_reset_postdata();


?>

