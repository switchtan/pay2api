<?php	
	require 'rb.php';

	R::setup( 'mysql:host=127.0.0.1;dbname=wxpay',
        'root', 'guavaguava00' ); //for both mysql or mariaDB

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

    function client_sign($appid,$appkey,$timestamp){
        $request_objs = array(
          "appid"  =>  $appod,//APPID号码
          "appkey" =>  $appke,
          "timestamp"=>$timestamp
        );

        $token3 = md5(urlparams($request_objs));
        return $token3;
    }