<?php
namespace moreco\searchlib;

interface SplitEngine {
	public function split($text);

	public function isUsableWord($word);
}