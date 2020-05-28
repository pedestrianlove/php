<?php
/**
 * Simple text conversion rule
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: ConvertTextRule.php 5 2011-12-18 11:33:40Z cku $
 */

class ConvertTextRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
		
		$count = mt_rand(3,5);
		$words = TextHelper::getRandomMixedText($count, 4, 6);
		$total = count($words);
		$randIndex = mt_rand(0, $total-1);
		
		$randOp = mt_rand(1,3);
		switch ($randOp) {
			case 1:
				$answer = strtoupper($words[$randIndex]);
				$note = $this->getLang("toUppercase");
				break;
			case 2:
				$answer = strtolower($words[$randIndex]);
				$note = $this->getLang("toLowercase");
				break;
			case 3:
				$answer = strrev($words[$randIndex]);
				$note = $this->getLang("reverseOrder");
				break;
		}
		$note = str_replace("{count}", $randIndex+1, $note);

		$img = new CaptchaImage();	
		
		$this->addListing($img, $words, true);
		
		$textline = $img->getTextLine();
		$textline->addText($img->getText($note));
		$img->addTextLine($textline);

		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
		
}

