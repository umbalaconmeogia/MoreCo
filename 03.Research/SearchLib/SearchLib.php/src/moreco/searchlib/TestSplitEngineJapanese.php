<?php
namespace moreco\searchlib;

require 'SplitEngine.php';
require 'SplitEngineJapanese.php';

$splitJa = new SplitEngineJapanese();

print "で:";
print_r($splitJa->isUsableWord("で"));
print "\n日本:";
print_r($splitJa->isUsableWord("日本"));
print "\nへ:";
print_r($splitJa->isUsableWord("へ"));

// $ja1 = "私はベトナム人です";
// $ja2 = "日本はきれいな国です";

// print_r($splitJa->split($ja1));
// print_r($splitJa->split($ja2));
