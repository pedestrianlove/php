<?php
/**
 * Simple upper and lower case 
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: UpperAndLowerCaseRule.php 5 2011-12-18 11:33:40Z cku $
 */

class UpperAndLowerCaseRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
		
		$count = mt_rand(2,5);
		$words = TextHelper::getRandomText($count, 3, 5);
		$total = count($words);
		$randIndex = mt_rand(0, $total-1);
		$answer = $words[$randIndex];
		
		$randForMethod = mt_rand(0,1);
		if ($randForMethod == 1) {
			$words[$randIndex] = strtoupper($words[$randIndex]);
			$note = $this->getLang("uppercase");
			$answer = strtoupper($answer);
		} else {
			$note = $this->getLang("lowercase");
			for ($i=0; $i<$total; $i++) {
				if ($i != $randIndex) {
					$words[$i] = strtoupper($words[$i]);
				}
			}
		}

		$img = new CaptchaImage();
		
		$color = new CaptchaColor(array("DE0909", "0000FF", "29A829", "A04B20"));
		
		$randShow = mt_rand(0,1);
		if ($randShow == 1) {
			$randListing = mt_rand(0,1);
			$decimalList = ($randListing == 1) ? true : false;
			$this->addListing($img, $words, $decimalList);
			$textline = $img->getTextLine();
			$textline->addText($img->getText($note));
			$img->addTextLine($textline);
		} else {
			$text = implode(" ", $words);
			$textline1 = $img->getTextLine();
			$c1 = $img->getText($note);
			$textline1->addText($c1);
			
			$textline2 = $img->getTextLine();
			$char2 = $img->getText($text);
			$char2->setColor($color);
			$textline2->addText($char2);
			
			$randLine = mt_rand(0,1);
			if ($randLine == 1) {
				$img->addTextLine($textline1);
				$img->addTextLine($textline2);
			} else {
				$img->addTextLine($textline2);
				$img->addTextLine($textline1);
			}
		}

		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
		
}

