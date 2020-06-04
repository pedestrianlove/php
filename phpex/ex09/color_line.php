<?php
	// line
	
	// header
	header ("Content-type:image/png");
	
	// init image
	$image = ImageCreate (600, 400);
	
	// assign color
	$bgcolor = ImageColorAllocate ($image, 0, 0, 0);
	$textcolor = ImageColorAllocate ($image, 0, 255, 0);
	

	// draw graph
	ImageFill ($image, 0, 0, $bgcolor);
	ImageLine ($image, 0, 0, 600, 400, $textcolor);


	// show image && destroy
	Imagepng ($image);
	ImageDestroy ($image);
?>
