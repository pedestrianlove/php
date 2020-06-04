<?php
	// axis
	
	// header
	header ("Content-type:image/png");
	
	// init image
	$image = ImageCreate (100, 100);
	
	// allocate color
	$bgcolor = ImageColorAllocate ($image, 0, 0, 0);
	$textcolor = ImageColorAllocate ($image, 0, 255, 0);
	
	// draw graph
	for ($i = 0; $i < 100; $i++) {
		ImageSetPixel ($image, $i, 50, $textcolor);
		ImageSetPixel ($image, 50, $i, $textcolor);
	}

	// show graph
	Imagepng ($image);
	ImageDestroy ($image);
?>
