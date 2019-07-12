<?php	
		require 'dbconfig.php';
	if($_GET['action']=="into"){
		$file = fopen($_GET['file'], "r") or exit("Unable to open file!");
		//Output a line of the file until the end is reached
		//feof() check if file read end EOF
		while(!feof($file))
		{
		 //fgets() Read row by row
		 $test=fgets($file);
		 
		 if(strlen($test)>2){
			//echo strlen($test)."guava<br>";
			//echo $test;
			$arr=explode(",",$test);
			//print_r ($arr);

			$pay_record = R::dispense( 'qrcode' );
			
			$content=$arr[1];
			$content=str_replace("\n","",$content);
			$content=str_replace("\r\n","",$content);
			$content=str_replace("\r","",$content);
			$content=str_replace(" ","",$content);
			$pay_record->money=$arr[0];
			$pay_record->qrcode=$content;
			$pay_record->type=$_GET['type'];
			$pay_record->timeend=time();
			$id = R::store( $pay_record );
			echo $content;
		 }
		}
		fclose($file);
		
	}
	if($_GET['action']=="get"){
		$money=$_GET['money'];
		$money2=$money+1;
		$books = R::findAll( 'qrcode' , 'money>='.$money.' and money<'.$money2 ." ORDER BY money" );
		//print_r($books);
		echo "now:".time()."        add:".(time()+30)."<br>";
		foreach($books as $item){
			//print_r($item);
			//echo $item->timeend < time();
			
			if($item->timeend < time()){
				echo $item->timeend."<br>";
				echo time()."<br>";
				echo $item->id."<br>";
				$item->timeend=time()+30;
				R::store($item);
				break;
			}
		}
	}