<?php
/**
 * FontFaceTextRule
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: FontFaceTextRule.php 5 2011-12-18 11:33:40Z cku $
 */

class FontFaceTextRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
		
		$count = mt_rand(4,6);
		$words = TextHelper::getRandomText($count, 4, 5);
		$total = count($words);
		$randIndex = mt_rand(0, $total-1);
		$answer = $words[$randIndex];
		
		$img = new CaptchaImage();
		
		$italic = mt_rand(0,1);
		if ($italic == 1) {
			$fontDir = $img->getFontDir().'/italic';
			$note = $this->getLang("italic");
		} else {
			$fontDir = $img->getFontDir().'/bold';
			$note = $this->getLang("bold");
		}
		$font = $img->getNewFont($fontDir);
		
		$textline = $img->getTextLine();
		for ($i=0; $i<$count; $i++) {
			$char = $img->getText($words[$i]." ");
			if ($i == $randIndex) {
				$char->setFont($font);
			}
			$textline->addText($char);
		}
		$img->addTextLine($textline);
		
		$lastLine = $img->getTextLine();
		$char = $img->getText($note);
		$lastLine->addText($char);
		$img->addTextLine($lastLine);
		
		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
		
}

