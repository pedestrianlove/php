<?php
	// line
	
	// header
	header ("Content-type:image/png");
	
	// init image
	$image = ImageCreate (600, 600);
	
	// assign color
	$bgcolor = ImageColorAllocate ($image, 0, 0, 0);
	$textcolor = ImageColorAllocate ($image, 0, 255, 0);
	

	// draw graph
	ImageFill ($image, 0, 0, $bgcolor);
	ImageFilledEllipse ($image, 300, 300, 300, 300, $textcolor);


	// show image && destroy
	Imagepng ($image);
	ImageDestroy ($image);
?>
