<?php
namespace moreco\searchlib;

// use net\moraleboost\tinysegmenter\TinySegmenter;
require 'TinySegmenter.php';

/**
 *
 * @author PhuongTrang
 *
 */
class SplitEngineJapanese implements SplitEngine {
	public function split($text) {
		$segmenter = new TinySegmenter();
		$result = $segmenter->segment($text, 'UTF-8');
		return $result;
	}

	public function isUsableWord($word) {
		$excludeArray = array("が", "に", "は", "を", "へ", "で");
		return (mb_strlen(trim($word), "UTF-8") > 1) || !in_array($word, $excludeArray);
	}
}