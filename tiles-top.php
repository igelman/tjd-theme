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
$content = "<ul>";

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
		$title = get_the_title();
		$caption = get_the_content();		
		
		$imgClass = "main img-responsive";
		$imgAttr = array(
			'class' => $imgClass,
		);
		// $mainImgTag = get_the_post_thumbnail($id, 'thumbnail', $imgAttr);
		$mainImgTag = "<img class='$imgClass' src='http://placehold.it/300'>";
		
		$imgClass = "logo img-responsive";
		//$logoImage = get_field('logo_image');
		//$logoImgTag = "<img class='" . $imgClass . "src='" . $logoImage['url'] . "'>"; 
		$logoImgTag = "<img class='$imgClass' src='http://placehold.it/150x50'>";
		
		$listItem = <<<LI
			<li class='tile'>
				<figure class='featured'>
					<a href='$url'>
						$mainImgTag $logoImage
					</a>
					<figcaption>
						<a href='$url'>
							$title
						</a>$caption $id
					</figcaption>
				</figure>
			</li> <!-- li.tile -->
LI;

		$content .= $listItem;
		$tilesCount++;
	}
}
$content .= "</ul>";

echo $content;
// Restore original Post Data
wp_reset_postdata();


?>

