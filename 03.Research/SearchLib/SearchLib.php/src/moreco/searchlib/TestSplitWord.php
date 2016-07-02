<?php
namespace moreco\searchlib;

require 'SplitWord.php';

print_r(SplitWord::split("I have a dream", "en"));
print_r(SplitWord::split("私は来年に日本へ留学する予定です", "ja"));