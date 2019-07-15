<?php
require 'dbconfig.php';
require 'config.php';


$orderid= $_REQUEST["uid"];

    
//http://ad.czdxksy.com/index.php/index/pay/duishu?uid=219
$book  = R::getAll( 'SELECT * FROM payrecord' );
$a=array();
foreach($book as $item){
	$a[$item['order_number']]=$item['money'];
}


$sourceURL = $back_website."/index.php/index/pay/duishu?uid=".$orderid;
$html = file_get_contents($sourceURL);
$html2=json_decode($html);
//print_r($html2);
foreach($html2 as $item2){
	//print_r($item2->order_id);
	if (array_key_exists($item2->order_id,$a))
	  {
	  //echo "键存在！";
	  }
	else
	  {
	  //echo "键不存在！";
	  //echo "fail";
	  break;
	  }
	echo "ok";
}

