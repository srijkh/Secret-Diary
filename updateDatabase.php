<?php

	session_start();
	
	if(array_key_exists("content",$_POST)){
	
	$link = mysqli_connect("shareddb-o.hosting.stackcp.net","sqltest-3130392302","srijan1998","sqltest-3130392302");	
		
			if(mysqli_connect_error() != ""){
				
				die("The connection to the database failed");
				
			}
			
			else{
				
				$query = "UPDATE `user` SET `diary` = '".mysqli_real_escape_string($link, $_POST['content'])."' WHERE `id` = '".mysqli_real_escape_string($link,$_SESSION['id']."' LIMIT 1";
				
				mysqli_connect($link, $query);
			}
	}
	
?>