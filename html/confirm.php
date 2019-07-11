<?php	
	require 'dbconfig.php';
		

	if(isset($_GET["order_number"])   && isset($_GET["money"]) ){
		
		$book  = R::findOne( 'payrecord', ' money = ' .$_GET["money"] .' and order_number=""');
		//print_r( $book);
		if($book!=NULL){
			echo MD5(date("Ymd")*2+$book->money+$_GET["order_number"]);
		}else{
			echo "null";
		}
	}else{
		echo "参数不正确";
	}