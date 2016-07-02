<?php
namespace moreco\searchlib;

require 'SearchLib.php';
require 'TestSearchData.php';

function createDataTest($testData) {
	$result = array();
	foreach ($testData as $data) {
		$temp = new TestSearchData();
		$temp->setSearchData($data);
		array_push($result, $temp);
	}

	return $result;
}

$dataEn = array("I'd like to check in. My name is {0}.",
                "This is a confirmation slip.",
                "I have no reservation. Do you have a room available?",
                "One single room for 2 nights.",
                "One double room for 1 night.",
                "One twin room for 3 nights.",
                "Is this room with a bath / shower?",
                "Mr (Ms){0}. Yes, we have your reservation.",
                "We have a room available. We can provide a room for you.",
                "Unfortunately, we have no rooms available.",
                "Please fill out this form.",
                "Will you make payment by credit card?",
                "OK, can I have your credit card, please.",
                "Thank you very much. (returning the credit card.)",
                "We may ask you for a prepayment. The amount is {0} Dollars.",
                "Thank you very much. This is the receipt.",
                "Your room number is {0}. This is the room key.",
                "Your room is on second floor.",
                "Your room in on third floor.",
                "Please wait one minute. We will take you to the room now.",
                "Please leave your key at the front desk when you go out.",
                "You can have breakfast at the cafeteria.",
                "Breakfast is included in the room rate.",
                "The cafeteria is on the ground (first) floor. It is over there. (pointing in the direction)");


$dataJa = array( "チェックインをお願いします。名前は{0}です。",
                "これが予約確認書です。",
                "予約してません。空いている部屋はありますか？",
                "シングル１部屋で、２泊です。",
                "ダブルルーム１部屋で１泊です。",
                "ツインルーム１部屋で３泊です。",
                "バスルーム/シャワーつきの部屋ですか？",
                "ご予約頂いている{0}様ですね。",
                "空いている部屋はございます。どうぞ、お泊まり下さい。",
                "あいにく、空いている部屋はございません。",
                "こちらのフォームにご記入下さい。",
                "お支払はクレジットカードですか？",
                "では、クレジットカードをお願い致します。",
                "有難うございました。（カードを返す。）",
                "料金は前払いとなっております。{0}ドルをお願い致します。",
                "有難うございました。こちらが領収書です。",
                "お部屋の番号は{0}になります。こちらが鍵です。",
                "お部屋は２階です。",
                "お部屋は３階です。",
                "今、係りの者がお部屋までご案内いたします。",
                "外出の際は、鍵をフロントにお預け下さい。",
                "朝食はカフェテリアでお取り頂けます。",
                "朝食は料金に含まれています。",
                "カフェテリアは１階、あちらにございます。 (方向を手で示しながら。）");

$enSearchText = "have key room you";
$jaSearchText = "私は部屋の鍵でルームに";

// $dataTestEn = createDataTest($dataEn);
print_r(SearchLib::search($enSearchText, "en", $dataEn, 5));
print_r(SearchLib::search($jaSearchText, "ja", $dataJa, 5));







