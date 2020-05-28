<?php
/**
 * Simple text color rule
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: TextColorRule.php 5 2011-12-18 11:33:40Z cku $
 */

class TextColorRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		$this->name = __CLASS__;
		$this->colorDef = array(
			'black'		=> '000000',
			'blue'		=> '0000FF',
			'brown'		=> '964B00',
			'green'		=> '008000',
			'gray'		=> '808080',
			'orange'	=> 'FF7F00',
			'pink'		=> 'FF7FFF',
			'red'		=> 'FF0000',
			'yellow'	=> 'FFFF00',
			'white'		=> 'FFFFFF'
		);
	}

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
			
		$colors = $this->colorDef;
		shuffle($colors);
		
		$count = mt_rand(2,4);
		$words = TextHelper::getRandomText($count, 3, 5);
		
		$img = new CaptchaImage();
		$img->setBackgroundColor(new CaptchaColor(array("D4D4FF")));
		
		for ($i=0; $i<$count; $i++) {
			$textline = $img->getTextLine();
			$color = new CaptchaColor(array($colors[$i]));
			$fontsize = new CaptchaFontsize(array(15,15));
			$text = "- " . $words[$i];
			$char = $img->getText($text);
			$char->setColor($color);
			$char->setFontSize($fontsize);
			$textline->addText($char);
			$img->addTextLine($textline);
		}
		
		$answerIndex = mt_rand(0, $count-1);
		
		$note = $this->getLang("result.color");
		
		$colorName = $this->findKey($this->colorDef, $colors[$answerIndex]);
		$colorLang =  $this->getLang($colorName);
		$note = str_replace("{color}", $colorLang, $note);
		
		$answer = $words[$answerIndex];
		
		$textline = $img->getTextLine();
		$c1 = $img->getText($note);
		$textline->addText($c1);
		$img->addTextLine($textline);
		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
	
	protected function findKey(&$arr, $value) {
		$ret = null;
		foreach ($arr as $key => $val) {
			if ($val == $value) {
				$ret = $key;
				break;
			}
		}
		return $ret;
	}
	
		
}

