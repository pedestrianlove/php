<?php
	// line
	
	// header
	header ("Content-type:image/png");
	
	// init image
	$image = ImageCreate (100, 50);
	
	// assign color
	$bgcolor = ImageColorAllocate ($image, 0, 0, 0);
	$textcolor = ImageColorAllocate ($image, 255, 255, 255);
	

	// draw graph
	$word = "105021226";
	ImageFill ($image, 0, 0, $bgcolor);
	$font_path = "Consolas.ttf";
	ImageTTFtext ($image, 32, 0, 0, 50, $textcolor, $font_path, $word);

	// show image && destroy
	Imagepng ($image);
	ImageDestroy ($image);
?>
