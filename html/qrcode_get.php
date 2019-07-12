<?php
header('Access-Control-Allow-Origin:*'); 
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
                // $urls .= "&";
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
			"orderid"=>$_REQUEST["orderid"],
			"money"=>$money,
			"times"=>time(),
			"state"=>"1",
			"text"=>"10088"
			);

	$pay_record = R::dispense( 'willpay' );
	$pay_record->orderid = $_REQUEST["orderid"];
	$pay_record->money=$money;
	$pay_record->datenow=date("Y/m/d h:i:s") ;
	$pay_record->uid=$_REQUEST["uid"] ;
	$pay_record->orderidinserver=$arr["order"] ;
	$id = R::store( $pay_record );
	echo json_encode($arr);
}

//test url
//http://localhost/qrcode_get.php?appid=ee54a1fcc9a31800a95ed8eb2df49d41&orderid=10210&money=10&type=3&uid=22&token=9ad02b468dda0df105820556dbb12c12
$siteuser_obj = R::findOne( 'siteuser', ' appid = ? ', [ $_REQUEST['appid']] );
// echo 'appkey:'.$siteuser_obj['appkey'].'<br>';
$token = array(
  "appid"  =>  $_REQUEST['appid'],//APPID号码
  "orderid"   =>  $_REQUEST["orderid"],//数据单号
  "money"  =>  $_REQUEST["money"],//金额
  "type"   =>  $_REQUEST["type"],//类别
  "uid"    =>  $_REQUEST['uid'],  //客户IP
  "appkey" =>  $siteuser_obj['appkey'] 
);
// echo urlparams($token).'<br>';

$token3 = md5(urlparams($token));
// echo "本地token:".$token3."<br>";

$get_token= $_REQUEST['token'];
// echo "远程token:".$get_token."<br>";


if($token3 == $get_token){
		// echo 'api access<br>';
		$type="";
		if($_REQUEST["type"]=="3")$type="wx";
		if($_REQUEST["type"]=="1")$type="ali";
		$money=$_REQUEST['money'];
		$money2=$money+1;
		$money1=$money-1;
		$books = R::findAll( 'userqrcode' , 'money>='.$money1.' and money<'.$money2 ." and type='".$type."' ORDER BY money" );
		// print_r($books);
		foreach($books as $item){
			if($item->timeend < time()){
				//echo $item->timeend."<br>";
				//echo time()."<br>";
				//echo $item->id."<br>";
				$item->timeend=time()+40;
				R::store($item);
				callback($item->money,$item->qrcode);
				break;
			}else{
				echo json_encode(array('error'=>'the qrcode in using,being locked'));
				break;
			}
		}
}else{
	$arr = array('state'=>0,
			"text"=>'appid or appkey :ERROR'
			);
	echo json_encode($arr);
}