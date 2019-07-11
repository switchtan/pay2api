<?php
	include_once('../dbconfig.php');
	$username = $_REQUEST['email'];
	$password =$_REQUEST['password'];
	// echo $password;
	function addUser($username,$password){
		$w = R::dispense( 'siteuser' );
		$w->username = $username;
		$w->password = $password;
		$id = R::store( $w );
		die( "OK.\n" );
	}
	
	// addUser('guava@11',"guavaguava00");
	function isUser($username, $password){
		// $books = R::find( 'siteuser', ' username = ? ', [ $password ] );
		$books = R::findOne( 'siteuser', ' username = ? ', [ $username] );
		// print_r($books);
		if($books['password'] == $password){
			return $books['id'];
		}else{
			return False;
		}

	}
	$v=isUser($username,$password);
	if($v== False){
		echo "密码错误,请重新<a href=./login.html>登录</a>";
		
	}else{
		session_start();
		$_SESSION["username"] = $username;
		echo $v;
		$_SESSION["uid"] = $v;
		header("Location: ./index.php"); 
	}
	