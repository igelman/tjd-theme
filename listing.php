<?php

$extraArgs = array();
$query = createQuery($wp_query, "tmt-coupon-posts", $extraArgs);

$before = "";
$sep = "";
$after = "";

// The Loop
$content = "";
if ( $query->have_posts() ) {
	$content .= "<table id='listings'>";
	while ( $query->have_posts() ) {
		$query->the_post();
		
		$id = get_the_ID();
		$title = get_the_title();
		$merchant = get_the_term_list( $id, "merchant", $before, $sep, $after );
		$code = get_field("code");
		$expires = get_field("expires");
		
		$content .= "<tr>";
		$content .= "<td class='coupon-merchant-cell'>$merchant</td>";
		$content .= "<td class='coupon-title-cell'>$title</td>";
		$content .= "<td class='coupon-code-cell'>$code</td>";
		$content .= "<td class='coupon-expiration-date-cell'>$expires</td>";
		$content .= "</tr>";
	}
	$content .= "</table>";
}

echo $content;
// Restore original Post Data
wp_reset_postdata();

?>