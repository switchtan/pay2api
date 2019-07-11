<?php


//header('Content-Type:application/json; charset=utf-8');
//数组拼接为url参数形式
require 'config.php';
require 'dbconfig.php';

function urlparams2($params){
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

	//获取到的数据样式
	//Array ( [appid] => 3079566470 [data] => 1542746171 [money] => 10.00
	//[type] => 3 [uip] => 61.146.4.112 [token] => 5fbd2368f1b7f441f8515c68d29542c6 ) 
	//print_r( $_POST );
	//print_r( $_GET );
	//exit();
	
	
	
//test url
/*
挂账号
https://wx2.qq.com/?&lang=zh_CN

http://ad.czdxksy.com/codepay/codepay.php?data=1542746171&money=10&type=3&oid=sksjsjsjsj

http://103.55.25.13/wxpay/getMoney.php?mid=kakaka&money=10

直接充值
http://ad.czdxksy.com/index.php/index/pay/notify_url?ddh=0&name=1543348561&money=10&key=bf3f8d3guava
*/
//echo "远程token1<br>";
//require_once("config.php"); 
//echo "远程token2<br>";
$token = array(
  "appid"  =>  $congig['appid'],//APPID号码
  "type"   =>  $_REQUEST["type"],//类别
  "uip"    =>  $_REQUEST['uip'],//客户IP
  "appkey" =>  $congig['appkey']//appkey密匙
);

//echo "远程token<br>";


$token = md5(urlparams($token));
//echo $token."本地token<br>";
$orderid= $_REQUEST["order"];
//echo $orderid;
//$get_token= $_REQUEST['token'];
//echo "远程token<br>";

/*
json 返回的几个状态
完整输出JSON例子  {"code":"0","msg":"\u5f85\u4ed8\u6b3e"}
code = 0  等待付款
code = 1  付款完成
code = 2  订单超时
code = 3  订单不存在或者超时被删除
code = 4  token错误
*/

/*
http://103.55.25.13/wxpay/orderajax.php?type=3&order=1542686488
http://ad.czdxksy.com/index.php/index/pay/notify_url?ddh=3079566470&name=1542686488&money=0.01&key=bf3f8d3guava
http://ad.czdxksy.com/index.php/index/pay/notify_url?ddh=0&name=1542686488&money=0.01&key=bf3f8d3guava
*/
//if($token == $get_token){
if(1==1){
	$book  = R::findOne( 'willpay', 'orderid ='.$orderid.'');
	//print_r($book);
	//echo "guava1";
	if($book!=null){
		//echo "into";
		//echo $book->money;
		$payrecord  = R::findOne( 'payrecord', 'money ='.$book->money.' and order_number=""');
		//print_r($payrecord);
		if($payrecord!=null){
				$yundata = array(
				  "ddh"  =>  $congig['appid'],//APPID号码
				  "name"   =>  $orderid,//类别
				  "money"    =>  $book->money
				);
				$token2="bf3f8d3guava";
			
				$postdata = urlparams($yundata).'&key='.$token2;
				//echo $back_website."guava";
				$url=$back_website."/index.php/index/pay/notify_url?";
				//echo "3";
				//print_r($postdata);
				
				$url=$url.$postdata;
				//echo $url;
				//exit();
				$html = file_get_contents($url);
				//echo $html;
				//echo "4";
				if($html=="ok"){
					$result = array(
					  "code"  => "1",//APPID号码
					  "msg"   => "test"
					);
					$payrecord->order_number=$orderid;
					$id = R::store( $payrecord );
					echo json_encode($result);
				}else{
					$result = array(
						  "code"  => "0",//APPID号码
						  "msg"   => "test"
						);
					echo json_encode($result);
				}	
		}else{
					$result = array(
						  "code"  => "0",//APPID号码
						  "msg"   => "wait payed"
						);
					echo json_encode($result);
				}	
	}else{
			$result = array(
						  "code"  => "12",//APPID号码
						  "msg"   => "no order"
						);
					echo json_encode($result);
				}
				
	
}else{
	$result = array(
	  "code"  => "4",//APPID号码
	  "msg"   => "test"
	);
	echo json_encode($result);
	}