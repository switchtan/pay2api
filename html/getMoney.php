<?php	
	header("Access-Control-Allow-Origin:*");
	/*星号表示所有的域都可以接受，*/
	header("Access-Control-Allow-Methods:GET,POST");
 	require 'dbconfig.php';
		

	if(isset($_GET["mid"])   && isset($_GET["money"]) ){
		
		$pay_record = R::dispense( 'payrecord' );
		$pay_record->mid = $_GET["mid"];
		$pay_record->money=$_GET["money"];
		$pay_record->datenow=$_GET["date"];
		// $pay_record->order_number="" ;
		
		$id = R::store( $pay_record );
		echo "ok";
	}else{
		echo "参数不正确";
	}
	?>