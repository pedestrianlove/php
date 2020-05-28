<?php
/**
 * Simple if then else statement
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: IfThenElseRule.php 5 2011-12-18 11:33:40Z cku $
 */

class IfThenElseRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
		
		$note = $this->getLang("result");
		
		$answer = "";
		
		$img = new CaptchaImage();
		
		$fixedFonts = $img->getFontDir().'/fixed';
		$font = $img->getNewFont($fixedFonts);
		$img->setFont($font);
		
		$varName = TextHelper::getRandomCharacter();
		$varValue = mt_rand(1, 99);
		$testValue = mt_rand(0,99);
		
		$randText1 = TextHelper::getPhrase(3,5);
		$randText2 = TextHelper::getPhrase(3,5);
		
		$randOp = mt_rand(1,3);
		switch ($randOp) {
			case 1:
				$op = "<";
				$answer = ($varValue < $testValue) ? $randText1 : $randText2;				
				break;
			case 2:
				$op = "==";
				$answer = ($varValue == $testValue) ? $randText1 : $randText2;
				break;
			case 3:
				$op = ">";
				$answer = ($varValue > $testValue) ? $randText1 : $randText2;
				break;
		}
		
		$textline1 = $img->getTextLine();
		$textline2 = $img->getTextLine();
		$textline3 = $img->getTextLine();
		$textline4 = $img->getTextLine();
		$textline5 = $img->getTextLine();
		$textline6 = $img->getTextLine();
		$textline7 = $img->getTextLine();
		
		$textline1->addText($img->getText("\${$varName} = $varValue;"));
		$textline2->addText($img->getText("if (\${$varName} $op $testValue ) {"));
		$textline3->addText($img->getText("   print \"$randText1\";"));
		$textline4->addText($img->getText("} else {"));
		$textline5->addText($img->getText("   print \"$randText2\";"));
		$textline6->addText($img->getText("}"));
		$textline7->addText($img->getText($note));
		
		$img->addTextLine($textline1);
		$img->addTextLine($textline2);
		$img->addTextLine($textline3);
		$img->addTextLine($textline4);
		$img->addTextLine($textline5);
		$img->addTextLine($textline6);
		$img->addTextLine($textline7);
		
		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
		
}

