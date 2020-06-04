<?php
	// line
	
	// header
	header ("Content-type:image/png");
	
	// init image
	$image = ImageCreate (100, 50);
	
	// assign color
	$bgcolor = ImageColorAllocate ($image, 0, 0, 0);
	$textcolor = ImageColorAllocate ($image, 0, 255, 0);
	

	// draw graph
	$word = "105021226";
	ImageFill ($image, 0, 0, $bgcolor);
	ImageTTFtext ($image, 32, 0, 0, 50, $textcolor, "FiraCode.ttf", $word);

	// show image && destroy
	Imagepng ($image);
	ImageDestroy ($image);
?>
