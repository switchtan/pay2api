<?php
	session_start();
	unset($_SESSION["uid"]);
	// echo $_SESSION["uid"];
	header("Location: ./login.html"); 