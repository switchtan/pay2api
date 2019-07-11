<?php
header('Content-Type:application/json; charset=utf-8');
require 'dbconfig.php';
//数组拼接为url参数形式
function urlparams($params){
    $sign = '';
    foreach ($params AS $key => $val) {
        if ($val == '') continue;
        if ($key != 'sign') {
            if ($sign != '') {
                $sign .= "&";
                $urls .= "&";
            }
            $sign .= "$key=$val"; //拼接为url参数形式
        }
    }
    return $sign;
}
function callback($money,$url){
	$arr = array('state'=>1,
			'qrcode'=>$url,
			"order"=>md5(date("Y-m-d H:i:s")),
			"data"=>$_REQUEST["data"],
			"money"=>$money,
			"times"=>time(),
			"orderstatus"=>"0",
			"text"=>"10088"
			);

	$pay_record = R::dispense( 'willpay' );
	$pay_record->orderid = $_REQUEST["data"];
	$pay_record->money=$money;
	$pay_record->datenow=date("Y/m/d h:i:s") ;
	$pay_record->oid=$_REQUEST["oid"] ;
	$pay_record->orderidinserver=$arr["order"] ;
	$id = R::store( $pay_record );
	echo json_encode($arr);
}
	//获取到的数据样式
	//Array ( [appid] => 3079566470 [data] => 1542746171 [money] => 10.00
	//[type] => 3 [uip] => 61.146.4.112 [token] => 5fbd2368f1b7f441f8515c68d29542c6 ) 
	//print_r( $_POST );
	//print_r( $_GET );
	//exit();
	
	
	
//test url
//http://ad.czdxksy.com/codepay/codepay.php?data=1542746171&money=10&type=3
$token = array(
  "appid"  =>  $_REQUEST['appid'],//APPID号码
  "data"   =>  $_REQUEST["data"],//数据单号
  "money"  =>  $_REQUEST["money"],//金额
  "type"   =>  $_REQUEST["type"],//类别
  "uip"    =>  $_REQUEST['uip'],  //客户IP
  "appkey" =>  md5("guava1222") 
);


$token3 = md5(urlparams($token));
//echo $token."本地token<br>";

$get_token= $_REQUEST['token'];
//echo $get_token."远程token<br>";

if($token3 == $get_token){
		$type="";
		if($_REQUEST["type"]=="3")$type="wx";
		if($_REQUEST["type"]=="1")$type="ali";
		$money=$_REQUEST['money'];
		$money2=$money+1;
		$money1=$money-1;
		$books = R::findAll( 'qrcode' , 'money>='.$money1.' and money<'.$money2 ." and type='".$type."' ORDER BY money" );
		//print_r($books);
		//exit();
		//echo "now:".time()."        add:".(time()+30)."<br>";
		foreach($books as $item){
			//print_r($item);
			//echo $item->timeend < time();
			
			if($item->timeend < time()){
				//echo $item->timeend."<br>";
				//echo time()."<br>";
				//echo $item->id."<br>";
				$item->timeend=time()+40;
				R::store($item);
				callback($item->money,$item->qrcode);
				
				break;
			}
		}
		
	
}else{
	$arr = array('state'=>0,
			"text"=>$token3."-10088-".$token['appkey']
			);
	echo json_encode($arr);
}