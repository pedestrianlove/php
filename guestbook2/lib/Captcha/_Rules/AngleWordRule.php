<?php
/**
 * AngleWordRule
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: AngleWordRule.php 5 2011-12-18 11:33:40Z cku $
 */

class AngleWordRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
		
		$count = mt_rand(3,6);
		$words = TextHelper::getRandomText($count, 3, 4);
		$total = count($words);
		$randIndex = mt_rand(0, $total-1);
		$answer = $words[$randIndex];

		$img = new CaptchaImage();
		
		$color = new CaptchaColor(array("DE0909", "0000FF", "29A829", "A04B20", "964B00", "008000"));
		$angle = new CaptchaAngle(array(5,30));
		
		$textline = $img->getTextLine();
		for ($i=0; $i<$count; $i++) {
			if ($i == $randIndex) {
				$char = $img->getText(" ". $words[$i]." ");
				$char->setColor($color);
				$char->setAngel($angle);
			} else {
				$char = $img->getText($words[$i]." ");
			}
			$textline->addText($char);
		}
		$img->addTextLine($textline);
		
		$lastLine = $img->getTextLine();
		$lastLine->addText($img->getText($this->getLang("angle")));
		$img->addTextLine($lastLine);
		
		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
		
}

