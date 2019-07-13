<?php
header("Access-Control-Allow-Origin:*");
/*星号表示所有的域都可以接受，*/
header("Access-Control-Allow-Methods:GET,POST");
require 'dbconfig.php';


if (isset($_GET["mid"])   && isset($_GET["money"])) {

	$pay_record = R::dispense('payrecord');
	$pay_record->mid = $_GET["mid"];
	$pay_record->money = $_GET["money"];
	$pay_record->datenow = $_GET["date"];
	$pay_record->appid = $_GET["appid"];
	// $pay_record->order_number="" ;

	$siteuser_obj = R::findOne('siteuser', ' appid = ? ', [$_REQUEST['appid']]);
	// echo 'appkey:'.$siteuser_obj['appkey'].'<br>';

	$token = $_REQUEST['token'];
	$token_local = client_sign($_REQUEST["appid"], $siteuser_obj['appkey'], $_REQUEST["date"]);
	if ($token_local == $token) {
		$id = R::store($pay_record);
		echo json_encode(array('state' => '1'));
	} else {
		echo json_encode(array('error' => 'token no match,maybe appkey error', 'state' => '0'));
	}
} else {
	echo json_encode(array('error' => 'querys no match', 'state' => '0'));
}
