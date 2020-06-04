<?php
	// point
	
	// header
	header ("Content-type:image/png");
	
	// init image
	$image = ImageCreate (600, 400);
	$bgcolor = ImageColorAllocate ($image, 0, 0, 0);
	
	$textcolor = ImageColorAllocate ($image, 0, 255, 0);
	ImageSetPixel ($image, 90, 40, $textcolor);

	Imagepng ($image);
	ImageDestroy ($image);
?>
