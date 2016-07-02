<?php
namespace moreco\searchlib;

require 'SplitEngine.php';
require 'SplitEngineEnglish.php';

$splitEn = new SplitEngineEnglish();
$en1 = "Today is Saturday";
$en2 = "Today  is  Saturday";

print_r($splitEn->split($en1));
print_r($splitEn->split($en2));

print($splitEn->isUsableWord("aaaa"));
print "\n";
print($splitEn->isUsableWord("an"));
print "\n";
print($splitEn->isUsableWord("a"));
