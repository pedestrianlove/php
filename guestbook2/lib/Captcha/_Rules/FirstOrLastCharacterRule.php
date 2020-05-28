<?php
/**
 * Simple character rule
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: FirstOrLastCharacterRule.php 5 2011-12-18 11:33:40Z cku $
 */

class FirstOrLastCharacterRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);

		$chars = mt_rand(2,4);

		$randomText = TextHelper::getRandomAlphaNumText(8, 20);
		$length = strlen($randomText);

		$firstOnly = mt_rand(0,1);

		if ($firstOnly == 1) {
			$note = $this->getLang("first");
			$answer = substr($randomText, 0, $chars);
		} else {
			$note = $this->getLang("last");
			$answer = substr($randomText, -$chars);
		}
		$note = str_replace("{count}", $chars, $note);

		$img = new CaptchaImage();

		$textline = $img->getTextLine();
		$textline->addText($img->getText($randomText));
		$img->addTextLine($textline);

		$textline = $img->getTextLine();
		$textline->addText($img->getText($note));
		$img->addTextLine($textline);

		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}

}

