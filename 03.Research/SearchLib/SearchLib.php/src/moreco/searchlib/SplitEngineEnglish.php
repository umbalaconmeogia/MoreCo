<?php
namespace moreco\searchlib;

/**
 *
 * @author PhuongTrang
 *
 */
class SplitEngineEnglish implements SplitEngine {
	public function split($text) {
		$pattern = '/(\s+)/i';
		$replacement = ' ';
		return explode(" ", preg_replace($pattern, $replacement, $text));
	}

	public function isUsableWord($word) {
		return strlen(trim($word)) > 2;
	}


}