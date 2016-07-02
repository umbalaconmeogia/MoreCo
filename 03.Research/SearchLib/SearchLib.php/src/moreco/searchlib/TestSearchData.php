<?php
namespace moreco\searchlib;

require 'SearchDataRecord.php';

class TestSearchData implements SearchDataRecord {
	private $text = "";

	public function setSearchData($param) {
		$this->text = $param;
	}

	public function getSearchData() {
		return $this->text;
	}
}