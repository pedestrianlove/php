<?php
/**
 * Simple count number rule
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CountNumberRule.php 5 2011-12-18 11:33:40Z cku $
 */

class CountNumberRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		$this->name = __CLASS__;
		$this->text = "";
		$this->answer = "";
		$this->countNumbers = 0;
	}

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
		
		$note = $this->getLang("series");
		
		$randForMethod = mt_rand(0,1);
		if ($randForMethod == 1) {
			$this->forward();
		} else {
			$this->reverse();
		}
		
		$text = $this->text;
		
		$countOrSerie = mt_rand(0,1);
		if ($countOrSerie == 1) {
			$answer = $this->answer;
		} else {
			$note = $this->getLang("count.number");
			$answer = $this->countNumbers + 1;
		}
		
		$img = new CaptchaImage();
		
		$textline1 = $img->getTextLine();
		$c1 = $img->getText($note);
		$textline1->addText($c1);
		
		$textline2 = $img->getTextLine();
		$char2 = $img->getText($text);
		$textline2->addText($char2);
		
		$randLine = mt_rand(0,1);
		if ($randLine == 1) {
			$img->addTextLine($textline1);
			$img->addTextLine($textline2);
		} else {
			$img->addTextLine($textline2);
			$img->addTextLine($textline1);
		}
		
		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
	
	protected function forward() {
		$randomStart = mt_rand(0,990);
		$this->countNumbers = mt_rand(1,4);
		$end = $randomStart + $this->countNumbers;
		
		$values = array();
		for ($i=$randomStart; $i<=$end; $i++) {
			$values[] = $i;
		}
		
		$this->text = implode(", ", $values);
		$this->answer = $end + 1;
	}
	
	protected function reverse() {
		$randomStart = mt_rand(5,999);
		$this->countNumbers = mt_rand(1,4);
		$end = $randomStart - $this->countNumbers;
		
		$values = array();
		for ($i=$randomStart; $i>=$end; $i--) {
			$values[] = $i;
		}
		
		$this->text = implode(", ", $values);
		$this->answer = $end - 1;
	}
		
}

