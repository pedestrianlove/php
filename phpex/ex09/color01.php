<?php
	// point
	
	// header
	header ("Content-type:image/png");
	
	// init image
	$image = ImageCreate (100, 50);
	$bgcolor = ImageColorAllocate ($image, 255, 255, 255);
	
	$textcolor = ImageColorAllocate ($image, 0, 255, 0);
	ImageSetPixel ($image, 90, 40, $textcolor);

	Imagepng ($image);
	ImageDestroy ($image);
?>
