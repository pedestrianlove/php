<?php
	// line
	
	// header
	header ("Content-type:image/png");
	
	// init image
	$image = ImageCreate (600, 400);
	
	// assign color
	$bgcolor = ImageColorAllocate ($image, 0, 0, 0);
	$textcolor = ImageColorAllocate ($image, 255, 255, 255);
	

	// draw graph
	$word = iconv ("big5", "UTF-8", "105021226 李智修");
	ImageFill ($image, 0, 0, $bgcolor);
	$font_path = "simsun.ttc";
	ImageTTFtext ($image, 32, 0, 0, 50, $textcolor, $font_path, $word);

	// show image && destroy
	Imagepng ($image);
	ImageDestroy ($image);
?>
