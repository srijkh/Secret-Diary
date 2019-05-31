<?php
	
	session_start();
	
	$success = "";
	
	if(array_key_exists("id",$_COOKIE) ){
		
		$_SESSION['id'] = $_COOKIE['id'];
	}
	
	if(!array_key_exists("id",$_SESSION)){
		
		header("Location: index.php");
	}
	
	
	else {

		$link = mysqli_connect("shareddb-o.hosting.stackcp.net","sqltest-3130392302","srijan1998","sqltest-3130392302");	
		
			if(mysqli_connect_error() != ""){
				
				die("The connection to the database failed");
				
			}
			
			else {
			
				$query = "SELECT `diary` FROM `user` WHERE `id` = '".mysqli_real_escape_string($link, $_SESSION['id'])."'" ;
			
				$result = mysqli_query($link, $query);
				
				$row = mysqli_fetch_array($result);

				$diary = $row['diary']; 
		
			}
			
	}
	
	if(array_key_exists("logOut",$_POST)){
	
		unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
        
        session_destroy();
		
		header("Location: index.php");
	}
	
	if(array_key_exists("diary",$_POST)){
	
		$success = "Your diary has been updated successfully." ; 

		$diary = $_POST['diary'];

		$query = "UPDATE `user` SET `diary` = '".mysqli_real_escape_string($link, $_POST['diary'])."' WHERE `id` = ".mysqli_real_escape_string($link,$_SESSION['id'])." LIMIT 1";
				
				$link = mysqli_connect("shareddb-o.hosting.stackcp.net","sqltest-3130392302","srijan1998","sqltest-3130392302");	
		
				mysqli_query($link, $query);
}
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Stylish&display=swap" rel="stylesheet">
   
   <title>Hello, world!</title>
  </head>
  <body style="background-image:url('wallpaper.jpg');">

	
	<br>
	<br>
	
	<div class="h1 container"> Secret Diary </div>
	<div class="h2 container"> One place to store all your thoughts </div>
	
	<div class="container">
	<form method="post">
	
		<input type="hidden" name="logOut" >
		<input type="submit" name="submit" id="logout" class="btn btn-primary btn-lg" value= "LogOut">  
		
	</form>
	</div>
	
	<br>
	<div id="container">
	<div id="success">
		<?
				if( $success != ""){

				echo '<div id="success" class="alert alert-success" role="alert" style="border-radius:15px; text-align:center;width:500px; margin:auto;"><strong>'.$success.'</strong></div><br>' ; 
			}
		?>
	</div>
	</div>
	
	<form method ="post" class="container" >
	
		<textarea class="form-control" id="diary" style="text-shadow: 0px 1px 1px rgba(0,0,0,1);box-shadow: 5px 3px 15px 10px #595959; border:1px solid;;border-radius:20px ;width:500px;" name="diary" columns="1" rows="15">
		
			<?php 
				if($row['diary'] == ""){

					echo "              .....Happy Writing.....";
				}
				echo $diary;	
			?>
		
		</textarea>
		<br>
		
		<div style="text-align:center; clear:left;">
		<input type="submit" class="btn btn-success" style="width:500px;border-radius:10px; box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);"  value="Save" name="submit"> 
		</div>
	</form>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	
 </body>
</html>
