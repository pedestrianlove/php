<?php
	// header
	header("Content-type: image/jpg");
	
	// init const
	$width=800;  // Width of the Image Canvas
	$height=600; // Height of the canvas 
	$steps=2;     // The Jump in value of X - Axis for each loop. 
	$x1=0;
	
	// create image
	$im = ImageCreate ($width, $height);

	// assign color
	$bg_color = ImageColorAllocate ($im, 0, 0, 0); 
	$text_color = ImageColorAllocate ($im, 255, 255, 255); 

	
	// draw
	ImageFill ($im, 0, 0, $bg_color);
	ImageLine ($im, 0 , $height/2, $width, $height/2, $text_color); // X axis 
	ImageLine ($im, $width/2-38, 0, $width/2-38, $height, $text_color); // Y axis
	for($i=1;$i<=($width/$steps);$i++){

		$y1=($height/2)-number_format(sin(deg2rad($x1))*90,0);
		$x2=$x1+$steps;

		$y2=($height/2)-number_format(sin(deg2rad($x2))*90,0);

		imageline ( $im , $x1 , $y1 , $x2 , $y2 , $text_color );

		$x1=$x2;
	}
	
	// draw font
	$word = "y = sin x";
	ImageFill ($image, 0, 0, $bgcolor);
	$font_path = "Consolas.ttf";
	ImageTTFtext ($image, 32, 0, 50, 50, $textcolor, $font_path, $word);

	// show image and destroy
	Imagepng ($im);
	ImageDestroy ($im);
?>
