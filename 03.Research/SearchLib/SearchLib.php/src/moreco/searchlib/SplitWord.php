<?php
namespace moreco\searchlib;

require 'SplitEngine.php';
require 'SplitEngineEnglish.php';
require 'SplitEngineJapanese.php';
require 'SplitEngineVietnamese.php';

class SplitWord {
	public static function split($text, $languageCode) {
        $splitEngine = SplitWord::getSplitEngine($languageCode);
        $words = $splitEngine->split($text);
        $result = array();

        if (sizeof($words) >= 1) {
        	foreach ($words as &$word ) {
        		if ($splitEngine->isUsableWord($word)) {
        			array_push($result, $word);
        		}
			}
        }

		return $result;
    }

    /**
     * Create a SplitEngline object for specified language code.
     * @param languageCode "en", "ja", "vi"...
     * @return
     */
    protected static function  getSplitEngine($languageCode) {
        $result = null;

        // Create result (SearchEngline) by languageCode.
        if (isset($languageCode)) {
            if ($languageCode == "en") {
                $result = new SplitEngineEnglish();
            } else if ($languageCode == "ja") {
                $result = new SplitEngineJapanese();
            } else if ($languageCode == "vi") {
                $result = new SplitEngineVietnamese();
            }
        }

        // If languageCode is not compatible, then return SearchEngineEnglish by default.
        if (!isset($result)) {
            $result = new SplitEngineEnglish();
        }

        return $result;
    }
}