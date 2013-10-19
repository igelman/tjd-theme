<?php
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 300, false );

function makeAnchor($url, $innerText, $attributeArray=array()) {
	$attributes = "";
/*	foreach($attributeArray as $attribute => $value) {
		$attributes .= "$attribute='$value' "
	}*/
	return "<a href='$url' $attributes>$innerText</a>";
}
?>