<?php
/**
 * Simple odd and even rule
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: OddAndEvenRule.php 5 2011-12-18 11:33:40Z cku $
 */

class OddAndEvenRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
		
		$numbers = array();
		$odd = mt_rand(0,1);
		
		if ($odd == 1) {
			$num1 = mt_rand(1,999);
			if (($num1 % 2) != 0) {
				$num1++;
			}
			$num2 = mt_rand(1,999);
			if (($num2 % 2) != 0) {
				$num2++;
			}
			$num3 = mt_rand(1,999);
			if (($num3 % 2) == 0) {
				$num3++;
			}
			$note = $this->getLang("odd");
		} else {
			$num1 = mt_rand(1,999);
			if (($num1 % 2) == 0) {
				$num1++;
			}
			$num2 = mt_rand(1,999);
			if (($num2 % 2) == 0) {
				$num2++;
			}
			$num3 = mt_rand(1,999);
			if (($num3 % 2) != 0) {
				$num3++;
			}
			$note = $this->getLang("even");
		}
		$numbers[] = $num1;
		$numbers[] = $num2;
		$numbers[] = $num3;
		$answer = $num3;
		shuffle($numbers);

		$img = new CaptchaImage();	
		
		$this->addListing($img, $numbers, true);
		
		$textline = $img->getTextLine();
		$textline->addText($img->getText($note));
		$img->addTextLine($textline);

		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
		
}

