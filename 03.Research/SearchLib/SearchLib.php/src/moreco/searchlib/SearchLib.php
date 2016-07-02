<?php
namespace moreco\searchlib;

require 'SplitWord.php';

class SearchLib {

	public static function search($searchText, $languageCode, $searchDataRecords, $maxResultNum) {
		$searchWords = SplitWord::split($searchText, $languageCode);

		$searchWeight = SearchLib::searchWeight($searchWords, $searchDataRecords, $languageCode);

		$result = SearchLib::getKeySortedByValue($searchWeight);

		if ($maxResultNum > 0) {
			return array_slice($result, 0, $maxResultNum);
		} else {
			return $searchWords;
		}
	}

	protected static function searchWeight($searchWords, $searchDataRecords, $languageCode) {
		$result = array();
		foreach ($searchDataRecords as &$record ) {
			$count = 0;
			foreach ($searchWords as &$searchKey ) {
				if ($languageCode == "ja") {
					$count += mb_substr_count($record, $searchKey);
				} else {
					$count += substr_count($record, $searchKey);
				}
			}
			$result[$record] = $count;
		}

		return $result;
	}

	public static function  getKeySortedByValue($map) {
		arsort($map);
		return $map;
	}
}
