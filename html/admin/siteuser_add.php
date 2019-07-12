<?php
    include_once('./../dbconfig.php');

function siteuser_add($username, $password){
	$w = R::dispense( 'siteuser' );
    $w->username = $username;
	$w->password = $password;
	$w->appid    = md5($username.'2');
	$w->appkey   = md5($password.'2');
	$id = R::store( $w );

	
}
siteuser_add('a2a@222','aaa222');