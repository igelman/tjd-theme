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

$query = createQuery($wp_query, 'tmt-deal-posts', array());

// The Loop
$content = "";
if ( $query->have_posts() ) {
	$content .= "<h2 class='todays-tips'>Today's Tips</h2>";
	while ( $query->have_posts() ) {
		$query->the_post();
		
		$id = get_the_ID();
		$url = get_post_meta( $id, 'url', true );
		$merchant = "Merchant1";// get_the_term_list( $id, "merchant", $before, $sep, $after ); //get_post_meta( $id, 'merchant', true );
		
		$imgClass = "product-image img-responsive";
		$imgAttr = array(
			'class' => $imgClass,
		);
		$mainImgTag = "<img src='http://placehold.it/300' class='product-image img-responsive'>";// get_the_post_thumbnail($id, 'medium', $imgAttr);
		
		$caption = get_the_content();
		$title = get_the_title();
		
		$couponP = "";
		//$couponDiv = "";
		if (get_field("coupon_codes", $id) ) {
			$couponP .= "<p class='code'>";
			while ( has_sub_field("coupon_codes") ) {
				$code = get_sub_field("code");
				$description = get_sub_field("description");
				$expirationDate = get_sub_field("expiration_date");
				$couponP .= "<li><span class='coupon-code'>$code</span><span class='coupon-description'>$description</span><span class='coupon-expiration'>$expirationDate</span></li>";
				//$couponDiv .= "<div class='coupon-code'>$code</div><div class='coupon-description'>$description</div><div class='coupon-expiration'>$expirationDate</div>";
			}
			$couponP .= "</p>";
		}
		
		$imageAnchor = makeAnchor($url, $mainImgTag);
		$titleAnchor = makeAnchor($url, $title);		
		$article = <<<ARTICLE
			<article class='deal'>
				<figure class='featured'>
					$imageAnchor
					<figcaption>
						$id
					</figcaption>
				</figure>
				<h2>$titleAnchor</h2>
				$couponP
				<p class='description'>
					$caption
				</p>
				<ul class='links'>
					<li><a>link</a></li>
					<li><a>link</a></li>
				</ul>
				<p class='more'>
					View more in: <a>link</a>, <a>link</a>, <a>link</a>
				</p>
			</article> <!-- article.deal -->
ARTICLE;

		$content .= $divItem;
		
/*
		$itemDiv = "<div class='deal-row row'>";
		$itemDiv .= makeAnchor($url, $mainImgTag);
		$itemDiv .= "<div class='title'>" . makeAnchor($url, $title) . "</div>";
		$itemDiv .= "<div class='caption'>$couponDiv $caption</div>";
		$itemDiv .= "<div class='merchant'>$merchant</div>";
		$itemDiv .= "<div class='product-types'> Category1 | Category2</div>";//get_the_term_list( $id, "product_type", $before, $sep, $after );
		$itemDiv .= "</div> <!-- .deal-row .row -->";
		
		$content .= $itemDiv;
*/
	}
}

echo $content;
// Restore original Post Data
wp_reset_postdata();


?>

